<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Masterminds\HTML5;

function scrapeScholarProfile($scholarUrl)
{
    $client = new Client([
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.0.0 Safari/537.36',
            'Accept-Language' => 'en-US,en;q=0.9,th;q=0.8',
            'Referer' => 'https://scholar.google.com/',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive'
        ],
        'allow_redirects' => true,
        'timeout' => 10
    ]);

    try {
        $response = $client->get($scholarUrl);
        $html = (string) $response->getBody();

        // ✅ ตรวจสอบว่าโหลด HTML มาหรือไม่
        if (empty($html)) {
            echo "❌ HTML ไม่ถูกโหลด กรุณาตรวจสอบ URL และลองใหม่\n";
            exit;
        }

        // ✅ บันทึก HTML เพื่อตรวจสอบโครงสร้าง
        file_put_contents("scholar_output.html", $html);

    } catch (\Exception $e) {
        echo "❌ เกิดข้อผิดพลาดในการโหลดหน้าเว็บ: " . $e->getMessage() . "\n";
        exit;
    }

    $html5 = new HTML5();
    $dom = $html5->loadHTML($html);
    $xpath = new DOMXPath($dom);

    // ✅ ดึงชื่อโปรไฟล์
    $profileNameNode = $xpath->query('//div[contains(@class,"gsc_prf_in")]');
    $profileName = $profileNameNode->length ? trim($profileNameNode->item(0)->textContent) : 'ไม่พบข้อมูล';

    // ✅ ดึงจำนวน Citation
    $citationNode = $xpath->query('//td[@class="gsc_rsb_std"]');
    $citationCount = $citationNode->length ? trim($citationNode->item(0)->textContent) : '0';

    // ✅ ดึงรายการงานวิจัย
    $articles = [];
    foreach ($xpath->query('//tr[@class="gsc_a_tr"]') as $article) {
        $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article);
        $title = $titleNode->length ? $titleNode->item(0)->textContent : 'ไม่มีชื่อบทความ';
        $link = $titleNode->length ? "https://scholar.google.com" . $titleNode->item(0)->getAttribute('href') : '#';

        $citationNode = $xpath->query('.//td[@class="gsc_a_c"]/a', $article);
        $citations = $citationNode->length ? $citationNode->item(0)->textContent : '0';

        $articles[] = [
            'title' => $title,
            'link' => $link,
            'citations' => $citations
        ];
    }

    return [
        'profile_name' => $profileName,
        'citation_count' => $citationCount,
        'articles' => $articles
    ];
}

// 🔥 ทดสอบดึงข้อมูลจาก Google Scholar Profile
$scholarUrl = 'https://scholar.google.com/citations?hl=th&user=00JXDiUAAAAJ';
$profileData = scrapeScholarProfile($scholarUrl);

echo "📌 Profile: " . $profileData['profile_name'] . "\n";
echo "📊 Total Citations: " . $profileData['citation_count'] . "\n\n";

foreach ($profileData['articles'] as $article) {
    echo "🔹 Title: " . $article['title'] . "\n";
    echo "🔗 Link: " . $article['link'] . "\n";
    echo "📖 Citations: " . $article['citations'] . "\n\n";
}