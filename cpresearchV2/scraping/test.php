<?php
// ใช้ __DIR__ เพื่อให้ไฟล์อยู่ในโฟลเดอร์ที่ถูกต้อง
$baseDir = __DIR__ . "/googleScholarWebscraping";
$htmlFilePath = "$baseDir/scholar_output.html";
$jsonFilePath = "$baseDir/scholar_data.json";
$urlListFile = "$baseDir/scholar_urls.txt"; // ไฟล์เก็บ URL นักวิจัยที่เคยดึงข้อมูล

// ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
    echo "📂 สร้างโฟลเดอร์: $baseDir\n";
}

// อ่าน URL ที่เคยดึงมาก่อน หรือสร้าง array ว่าง
$previousUrls = file_exists($urlListFile) ? file($urlListFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

$newResearcher = [
    "url" => "https://scholar.google.com/citations?user=E01V5gUAAAAJ&hl=en"
];

// ตรวจสอบว่า URL นี้อยู่ในรายการหรือไม่
$isNewResearcher = !in_array($newResearcher['url'], $previousUrls);
if ($isNewResearcher) {
    echo "🆕 เพิ่มผู้วิจัยใหม่: " . $newResearcher['url'] . "\n";
    file_put_contents($urlListFile, $newResearcher['url'] . PHP_EOL, FILE_APPEND);
    if (file_exists($htmlFilePath)) unlink($htmlFilePath);
}

// 🕒 หน่วงเวลาแบบสุ่ม 3-7 วินาที
$delay = rand(3, 7);
sleep($delay);

// ดึง HTML
$html = file_get_contents($newResearcher['url']);
if (!$html) {
    die("❌ ไม่สามารถโหลดหน้าเว็บของนักวิจัยได้!\n");
}

// โหลด HTML เข้า DOMDocument
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($doc);
$profileNode = $xpath->query('//meta[@property="og:title"]');
$profileName = $profileNode->length > 0 ? $profileNode->item(0)->getAttribute('content') : 'N/A';

// 📊 ดึงจำนวนการอ้างอิงทั้งหมด และ Expertise
$descriptionNode = $xpath->query('//meta[@property="og:description"]');
$totalCitations = 'N/A';
$expertise = [];

if ($descriptionNode->length > 0) {
    $descriptionContent = $descriptionNode->item(0)->getAttribute('content');

    // ดึง Total Citations
    preg_match('/อ้างอิงโดย (\d+)/u', $descriptionContent, $matches);
    $totalCitations = $matches[1] ?? 'N/A';

    // ดึง Expertise (กรอง "อ้างอิงโดย ..." ออก)
    preg_match('/- (.+)$/', $descriptionContent, $expMatches);
    if (!empty($expMatches[1])) {
        $expertise = array_filter(
            array_map('trim', explode(' - ', $expMatches[1])),
            fn($item) => !preg_match('/อ้างอิงโดย \d+ รายการ/u', $item)
        );
    }
}

// 🔹 ดึงข้อมูลบทความ
$articles = $xpath->query('//tr[@class="gsc_a_tr"]');
$newData = [
    'profile' => $profileName,
    'total_citations' => $totalCitations,
    'expertise' => array_values($expertise),
    'papers' => []
];

foreach ($articles as $article) {
    $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article);
    $title = $titleNode->length > 0 ? trim($titleNode->item(0)->textContent) : 'N/A';
    $link = $titleNode->length > 0 ? "https://scholar.google.com" . $titleNode->item(0)->getAttribute('href') : '#';

    $citationsNode = $xpath->query('.//a[contains(@class, "gsc_a_ac")]', $article);
    $citations = $citationsNode->length > 0 ? trim($citationsNode->item(0)->textContent) : '0';

    $yearNode = $xpath->query('.//td[@class="gsc_a_y"]', $article);
    $year = $yearNode->length > 0 ? trim($yearNode->item(0)->textContent) : 'N/A';

    // 🕒 หน่วงเวลาเพิ่ม (สุ่ม 2-5 วินาที)
    $delay = rand(2, 5);
    sleep($delay);

    // ดึงข้อมูล Paper เพิ่มเติมจากหน้าของ Paper
    $paperHtml = file_get_contents($link);
    if (!$paperHtml) {
        echo "⚠️ ไม่สามารถโหลดข้อมูลบทความ: $title\n";
        continue;
    }

    $paperDoc = new DOMDocument();
    libxml_use_internal_errors(true);
    $paperDoc->loadHTML($paperHtml);
    libxml_clear_errors();
    $paperXPath = new DOMXPath($paperDoc);

    // ดึงประเภทเอกสาร (Conference, Journal, Book Chapter)
    $paperTypeField = $paperXPath->query('//div[@class="gsc_oci_field"][text()="Conference" or text()="Journal" or text()="Book Chapter"]');
    if ($paperTypeField->length > 0) {
        $paperType = trim($paperTypeField->item(0)->textContent);
        $paperTypeDetailNode = $paperTypeField->item(0)->parentNode->getElementsByTagName('div')->item(1);
        $paperTypeDetail = $paperTypeDetailNode ? trim($paperTypeDetailNode->textContent) : "Unknown";
    } else {
        $paperType = "Unknown";
        $paperTypeDetail = "Unknown";
    }

    // ดึงคำอธิบายบทความ
    $descriptionNode = $paperXPath->query('//div[contains(@class,"gsh_small") or contains(@class,"gsc_oci_value")]');
    $description = $descriptionNode->length > 0 ? trim($descriptionNode->item(0)->textContent) : "No description available.";

    // เพิ่มข้อมูล Paper
    $newData['papers'][] = [
        'paper' => $title,
        'paperUrl' => $link,
        'citations' => $citations,
        'year' => $year,
        'paper_type' => $paperType,
        'paper_type_detail' => $paperTypeDetail,
        'description' => $description
    ];
}

// 🔥 บันทึก JSON
file_put_contents($jsonFilePath, json_encode($newData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "📂 บันทึกข้อมูล JSON ที่: $jsonFilePath\n";
