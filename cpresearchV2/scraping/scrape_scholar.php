<?php
// ใช้ __DIR__ เพื่อให้ไฟล์อยู่ในโฟลเดอร์ที่ถูกต้อง
$baseDir = __DIR__ . "/googleScholarWebscraping";
$htmlFilePath = "$baseDir/scholar_output.html";
$jsonFilePath = "$baseDir/scholar_data.json";
$urlListFile = "$baseDir/last_used_url.txt"; // เก็บ URL นักวิจัยที่เคยใช้

// 🛠️ ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
    echo "📂 สร้างโฟลเดอร์: $baseDir\n";
}

// 🔗 ตั้งค่า URL ใหม่
$newResearcher = [
    "name" => "Dr. Alice Johnson",
    "url" => "https://scholar.google.com/citations?user=E01V5gUAAAAJ&hl=th"
];

// อ่าน URL ก่อนหน้า
$previousUrls = file_exists($urlListFile) ? file($urlListFile, FILE_IGNORE_NEW_LINES) : [];

// ตรวจสอบว่าเป็นผู้วิจัยใหม่หรือไม่
$isNewResearcher = !in_array($newResearcher['url'], $previousUrls);

if ($isNewResearcher) {
    echo "🆕 เพิ่มผู้วิจัยใหม่: " . $newResearcher['name'] . "\n";
    file_put_contents($urlListFile, $newResearcher['url'] . PHP_EOL, FILE_APPEND);
    if (file_exists($htmlFilePath)) unlink($htmlFilePath);
}

// 🕒 หน่วงเวลาแบบสุ่ม 3-7 วินาที
$delay = rand(3, 7);
echo "⏳ รอ $delay วินาทีก่อนดึงข้อมูล...\n";
sleep($delay);

// 1️⃣ ดึงข้อมูลจาก Google Scholar
$html = file_get_contents($newResearcher['url']);
if ($html === false) {
    die("❌ ไม่สามารถดึงข้อมูลจาก Google Scholar ได้");
}

// บันทึกไฟล์ HTML ใหม่
file_put_contents($htmlFilePath, $html);
echo "✅ บันทึกข้อมูลใหม่ที่: $htmlFilePath\n";

// 2️⃣ อ่านไฟล์ HTML และดึงข้อมูล
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($doc);

// 📌 ดึงชื่อโปรไฟล์
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
    // ดึงชื่อบทความ
    $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article);
    $title = $titleNode->length > 0 ? trim($titleNode->item(0)->textContent) : 'N/A';

    // ดึงลิงก์ของบทความ
    $link = $titleNode->length > 0 ? 'https://scholar.google.com' . $titleNode->item(0)->getAttribute('href') : 'N/A';

    // ดึงจำนวนการอ้างอิง
    $citationsNode = $xpath->query('.//td[@class="gsc_a_c"]', $article);
    $citations = $citationsNode->length > 0 ? trim($citationsNode->item(0)->textContent) : '0';

    // ดึงปีที่ทำวิจัย
    $yearNode = $xpath->query('.//td[@class="gsc_a_y"]', $article);
    $year = $yearNode->length > 0 ? trim($yearNode->item(0)->textContent) : 'N/A';

    // 🕒 หน่วงเวลาเพิ่ม (สุ่ม 2-5 วินาที)
    $delay = rand(2, 5);
    echo "⏳ รอ $delay วินาทีก่อนดึงข้อมูล Paper...\n";
    sleep($delay);

    // ดึงข้อมูล Paper เพิ่มเติมจากหน้าของ Paper
    $paperHtml = file_get_contents($link);
    $paperDoc = new DOMDocument();
    libxml_use_internal_errors(true);
    $paperDoc->loadHTML($paperHtml);
    libxml_clear_errors();
    $paperXPath = new DOMXPath($paperDoc);

    // ดึง Paper Type และรายละเอียด
    $paperTypeField = $paperXPath->query('//div[@class="gsc_oci_field"][text()="Conference" or text()="Journal" or text()="Book Chapter"]');
    if ($paperTypeField->length > 0) {
        $paperType = trim($paperTypeField->item(0)->textContent);
        $paperTypeDetailNode = $paperTypeField->item(0)->parentNode->getElementsByTagName('div')->item(1);
        $paperTypeDetail = $paperTypeDetailNode ? trim($paperTypeDetailNode->textContent) : "Unknown";
    } else {
        $paperType = "Unknown";
        $paperTypeDetail = "Unknown";
    }

    // ดึง Description
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
?>
