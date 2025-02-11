<?php
// ใช้ __DIR__ เพื่อให้ไฟล์ถูกสร้างในโฟลเดอร์ที่เหมาะสม
$baseDir = __DIR__ . "/googleScholarWebscraping";
$htmlFilePath = "$baseDir/scholar_output.html";
$jsonFilePath = "$baseDir/scholar_data.json";
$urlListFile = "$baseDir/last_used_url.txt"; // เก็บ URL นักวิจัยที่เคยใช้

// 🛠️ ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
    echo "📂 สร้างโฟลเดอร์: $baseDir\n";
}

// 🔗 ตั้งค่า URL ใหม่ (เปลี่ยนตรงนี้เมื่อต้องการดึงข้อมูลของคนใหม่)
$newResearcher = [
    "url" => "https://scholar.google.com/citations?hl=th&user=xF4E8-gAAAAJ"
];

// อ่าน URL ก่อนหน้า
$previousUrls = file_exists($urlListFile) ? file($urlListFile, FILE_IGNORE_NEW_LINES) : [];

// ตรวจสอบว่าเป็นผู้วิจัยใหม่หรือไม่
$isNewResearcher = !in_array($newResearcher['url'], $previousUrls);

if ($isNewResearcher) {
    echo "🆕 เพิ่มผู้วิจัยใหม่: " . $newResearcher['name'] . "\n";
    file_put_contents($urlListFile, $newResearcher['url'] . PHP_EOL, FILE_APPEND);
    if (file_exists($htmlFilePath)) unlink($htmlFilePath); // ลบไฟล์เก่าก่อนสร้างใหม่
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

// 📊 ดึงจำนวนการอ้างอิงทั้งหมด
$totalCitationsNode = $xpath->query('//meta[@property="og:description"]');
$totalCitations = 'N/A';
if ($totalCitationsNode->length > 0) {
    preg_match('/อ้างอิงโดย (\d+)/u', $totalCitationsNode->item(0)->getAttribute('content'), $matches);
    $totalCitations = $matches[1] ?? 'N/A';
}

// 🔹 ดึงข้อมูลบทความ
$articles = $xpath->query('//tr[@class="gsc_a_tr"]');

$newData = [
    'profile' => $profileName,
    'total_citations' => $totalCitations,
    'articles' => []
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

    // 🕒 หน่วงเวลาเพิ่ม (สุ่ม 1-3 วินาที)
    $delay = rand(1, 3);
    echo "⏳ รอ $delay วินาทีก่อนดึงบทความต่อไป...\n";
    sleep($delay);

    // เพิ่มข้อมูลบทความใหม่
    $newData['articles'][] = [
        'title' => $title,
        'link' => $link,
        'citations' => $citations,
        'year' => $year // เพิ่มปีที่ทำวิจัย
    ];
}

// 3️⃣ โหลด JSON เก่าถ้ามีอยู่
$existingData = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
if (!is_array($existingData)) $existingData = []; // ป้องกัน JSON เสีย

// 4️⃣ เพิ่มข้อมูลใหม่เข้าไปใน JSON โดยไม่ลบข้อมูลเก่า
$existingData['researchers'][] = $newData;

// 5️⃣ บันทึกข้อมูล JSON อัปเดต
file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "📂 อัปเดตข้อมูล JSON ที่: $jsonFilePath\n";
?>
