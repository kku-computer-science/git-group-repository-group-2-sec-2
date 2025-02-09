<?php

// 📌 ตั้งค่าโฟลเดอร์เก็บไฟล์
$baseDir = __DIR__ . "/googleScholarWebscraping";
$htmlFilePath = "$baseDir/scholar_output.html";
$jsonFilePath = "$baseDir/scholar_data.json";

// ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
    echo "📂 สร้างโฟลเดอร์: $baseDir\n";
}

// 📌 ฟังก์ชันดึงข้อมูลจาก Google Scholar
function fetchScholarData($url) {
    $response = file_get_contents($url);
    return $response ? $response : null;
}

// 📌 ดึงข้อมูลจาก Google Scholar
$researcherUrl = "https://scholar.google.com/citations?hl=en&user=sAp1BWsAAAAJ";
$html = fetchScholarData($researcherUrl);
if (!$html) {
    die("❌ ไม่สามารถดึงข้อมูลจาก Google Scholar ได้");
}

// บันทึก HTML
file_put_contents($htmlFilePath, $html);
echo "✅ ตรวจสอบไฟล์ HTML: $htmlFilePath\n";

// 📌 ใช้ DOMDocument และ XPath เพื่อดึงข้อมูล
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($doc);

// 📌 ดึงชื่อโปรไฟล์
$profileNode = $xpath->query('//meta[@property="og:title"]');
$profileName = $profileNode->length > 0 ? $profileNode->item(0)->getAttribute('content') : 'N/A';

// 📊 ดึงจำนวนการอ้างอิง
$descriptionNode = $xpath->query('//meta[@property="og:description"]');
$totalCitations = 'N/A';
if ($descriptionNode->length > 0) {
    preg_match('/Cited by (\d+)/u', $descriptionNode->item(0)->getAttribute('content'), $matches);
    $totalCitations = $matches[1] ?? 'N/A';
}

// 🔹 ดึงข้อมูลบทความ
$articles = $xpath->query('//tr[@class="gsc_a_tr"]');
$paperCount = 0;
$maxPapers = 5; // จำกัดบทความที่ดึงมา

$newData = [
    'profile' => $profileName,
    'total_citations' => $totalCitations,
    'papers' => []
];

foreach ($articles as $article) {
    if ($maxPapers !== null && $paperCount >= $maxPapers) break;

    // 📌 ดึงชื่อบทความ
    $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article);
    $title = $titleNode->length > 0 ? trim($titleNode->item(0)->textContent) : 'N/A';
    $paperUrl = $titleNode->length > 0 ? 'https://scholar.google.com' . str_replace("hl=th", "hl=en", $titleNode->item(0)->getAttribute('href')) : 'N/A';

    // 📌 ดึงชื่อผู้เขียน
    $authorNode = $xpath->query('.//div[@class="gs_gray"]', $article);
    $authors = $authorNode->length > 0 ? trim($authorNode->item(0)->textContent) : 'N/A';

    // 📌 ดึงจำนวนอ้างอิง
    $citationsNode = $xpath->query('.//td[@class="gsc_a_c"]', $article);
    $citations = $citationsNode->length > 0 ? trim($citationsNode->item(0)->textContent) : '0';

    // 📌 ดึงปีที่ตีพิมพ์
    $yearNode = $xpath->query('.//td[@class="gsc_a_y"]', $article);
    $year = $yearNode->length > 0 ? trim($yearNode->item(0)->textContent) : 'N/A';

    // 📌 ดึงประเภทเอกสาร
    $sourceNode = $xpath->query('.//div[@class="gs_gray"][2]', $article);
    $paper_type_detail = $sourceNode->length > 0 ? trim($sourceNode->item(0)->textContent) : 'N/A';
    $paper_type = strpos(strtolower($paper_type_detail), 'conference') !== false ? 'Conference' : 'Journal';

    // 📌 ดึงคำอธิบาย (description)
    $descriptionNode = $xpath->query('//meta[@property="og:description"]');
    $description = $descriptionNode->length > 0 ? trim($descriptionNode->item(0)->getAttribute('content')) : 'N/A';

    // 📌 เพิ่มข้อมูลบทความ
    $newData['papers'][] = [
        'paper' => $title,
        'authors' => $authors,
        'paperUrl' => $paperUrl,
        'citations' => $citations,
        'year' => $year,
        'paper_type' => $paper_type,
        'paper_type_detail' => $paper_type_detail,
        'description' => $description
    ];

    $paperCount++;
}

// 🔥 บันทึก JSON
file_put_contents($jsonFilePath, json_encode($newData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "📂 บันทึกข้อมูล JSON ที่: $jsonFilePath\n";

?>
