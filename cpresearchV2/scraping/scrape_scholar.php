<?php
// 📌 ตั้งค่าโฟลเดอร์เก็บไฟล์หหห
$baseDir = __DIR__ . "/googleScholarWebscraping";
$htmlFilePath = "$baseDir/scholar_output.html";
$jsonFilePath = "$baseDir/scholar_data.json";

// ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0777, true);
}

// 📌 ลบไฟล์เก่าหากมีอยู่
if (file_exists($htmlFilePath)) unlink($htmlFilePath);
if (file_exists($jsonFilePath)) unlink($jsonFilePath);

// 📌 ฟังก์ชันดึงรายการพร็อกซีจาก ProxyScrape
function fetchProxyList() {
    $proxyApiUrl = 'https://api.proxyscrape.com/v2/?request=displayproxies&protocol=http&timeout=10000&country=all&ssl=all&anonymity=all';
    $proxyList = file($proxyApiUrl, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $proxyList ?: [];
}

// 📌 ฟังก์ชันสุ่มพร็อกซี
function getRandomProxy($proxyList) {
    return $proxyList[array_rand($proxyList)];
}

// 📌 ฟังก์ชันดึงข้อมูลจาก Google Scholar โดยใช้ Proxy และ Retry
function fetchWithRetry($url, $maxRetries = 5) {
    $proxyList = fetchProxyList();
    if (empty($proxyList)) {
        echo "❌ ไม่พบพร็อกซีที่ใช้งานได้\n";
        return null;
    }

    $retryCount = 0;
    $waitTime = 2; // เริ่มต้นหน่วงเวลา 2 วินาที
    $userAgents = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
        'Mozilla/5.0 (X11; Linux x86_64)'
    ];

    while ($retryCount < $maxRetries) {
        $proxy = getRandomProxy($proxyList);
        echo "🕵️‍♂️ ใช้ Proxy: $proxy\n";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: ' . $userAgents[array_rand($userAgents)],
            'Accept-Language: en-US,en;q=0.9'
        ]);

        // 📌 ใช้ Proxy
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            return $response;
        } elseif ($httpCode === 429) {
            $retryCount++;
            $backoff = $waitTime * pow(2, $retryCount);
            echo "🚨 HTTP 429 - เปลี่ยน Proxy และรอ {$backoff} วินาที...\n";
            sleep($backoff);
        } else {
            echo "⚠️ ไม่สามารถโหลดจาก Proxy: $proxy\n";
            $proxyList = array_diff($proxyList, [$proxy]); // ลบ Proxy ที่ใช้ไม่ได้ออก
            if (empty($proxyList)) {
                echo "❌ ไม่มี Proxy ที่ใช้งานได้เหลืออยู่\n";
                return null;
            }
        }
    }

    return null;
}

// 📌 เริ่ม Scrap Google Scholar
$researcherUrl = "https://scholar.google.com/citations?hl=en&user=sAp1BWsAAAAJ";
$html = fetchWithRetry($researcherUrl);
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

// 📌 ดึงข้อมูลบทความ
$articles = $xpath->query('//tr[@class="gsc_a_tr"]');
$paperCount = 0;
$maxPapers = 2;

$newData = [
    'profile' => $profileName,
    'total_citations' => $totalCitations,
    'papers' => []
];

foreach ($articles as $article) {
    if ($maxPapers !== null && $paperCount >= $maxPapers) break;

    $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article);
    $title = $titleNode->length > 0 ? trim($titleNode->item(0)->textContent) : 'N/A';

    $paperUrlNode = $xpath->query("//a[@class='gsc_oci_title_link']");
    $paperUrl = $paperUrlNode->length > 0 ? $paperUrlNode->item(0)->getAttribute('href') : 'N/A';

    $authorNode = $xpath->query("//div[@class='gsc_oci_field' and text()='Authors']/following-sibling::div[@class='gsc_oci_value']");
    $authors = $authorNode->length > 0 ? trim($authorNode->item(0)->textContent) : 'N/A';
    
    $citationsNode = $xpath->query('.//td[@class="gsc_a_c"]', $article);
    $citations = $citationsNode->length > 0 ? trim($citationsNode->item(0)->textContent) : '0';

    $yearNode = $xpath->query('.//td[@class="gsc_a_y"]', $article);
    $year = $yearNode->length > 0 ? trim($yearNode->item(0)->textContent) : 'N/A';

    $paperTypeNode = $xpath->query("//div[@class='gsc_oci_field' and text()='Journal']/following-sibling::div[@class='gsc_oci_value']");
    $paper_type_detail = $paperTypeNode->length > 0 ? trim($paperTypeNode->item(0)->textContent) : 'N/A';

    $descriptionNode = $xpath->query("//div[@class='gsh_small']/div[@class='gsh_csp']");
    $description = $descriptionNode->length > 0 ? trim($descriptionNode->item(0)->textContent) : 'N/A';

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
