<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class GoogleScholarScraper
{
    public function scrapeScholarProfile($scholar_id)
    {
        try {
            $url = "https://scholar.google.com/citations?&hl=en&pagesize=100&user=" . $scholar_id;

            // ✅ หน่วงเวลา 10-20 วินาที ก่อนโหลดหน้า Google Scholar

            $httpClient = HttpClient::create([
                'timeout' => 10,
                'headers' => [
                    'User-Agent' => $this->getRandomUserAgent()
                ]
            ]);

            $client = new Client($httpClient);
            $crawler = $client->request('GET', $url);

            if (!$crawler) {
                throw new \Exception("Failed to load page from Google Scholar");
            }

            // ✅ หน่วงเวลาเพิ่มอีก 5-10 วินาที หลังโหลดหน้าเว็บเสร็จ
            sleep(rand(5, 8));

            // ✅ ดึงข้อมูลโปรไฟล์
            $profile_name = $crawler->filter('#gsc_prf_in')->count() ? $crawler->filter('#gsc_prf_in')->text() : 'N/A';
            $total_citations = $crawler->filter('#gsc_rsb_st td.gsc_rsb_std')->eq(0)->count() ? $crawler->filter('#gsc_rsb_st td.gsc_rsb_std')->eq(0)->text() : '0';

            // ✅ หน่วงเวลาเพิ่มอีก 3-7 วินาที ก่อนดึง Paper
            sleep(rand(3, 7));

            // ✅ ดึงข้อมูล Paper ทั้งหมด
            $papers = [];
            $crawler->filter('.gsc_a_tr')->each(function ($node) use (&$papers) {                
                $titleElement = $node->filter('.gsc_a_t a');
                $authorsElement = $node->filter('.gsc_a_t div.gs_gray')->eq(0);
                $citationsElement = $node->filter('.gsc_a_c a');
                $yearElement = $node->filter('.gsc_a_y span');

                $title = $titleElement->count() ? $titleElement->text() : 'N/A';
                $paperPageUrl = $titleElement->count() ? 'https://scholar.google.com' . $titleElement->attr('href') : '#';
                $authors = $authorsElement->count() ? $authorsElement->text() : 'N/A';
                $citations = $citationsElement->count() ? $citationsElement->text() : '0';
                $year = $yearElement->count() ? $yearElement->text() : 'N/A';

                // ✅ หน่วงเวลา 8-15 วินาที ก่อนโหลดรายละเอียด Paper

                // ✅ ดึงข้อมูล Paper แบบละเอียดจากหน้าของ Paper
                $paperData = $this->fetchPaperDetails($paperPageUrl);

                // ✅ หน่วงเวลา 5-10 วินาที หลังโหลดเสร็จ
           

                $papers[] = [
                    'paper' => $title,
                    'Authors' => $authors,
                    'paperUrl' => $paperData['paperUrl'],
                    'citations' => $citations,
                    'year' => $year,
                    'paper_type' => $paperData['paperType'],
                    'paper_type_detail' => $paperData['paperTypeDetail'],
                    'description' => $paperData['description']
                ];
            });
                $crawler = $client->request('GET', $url);
    $data = $crawler->html(); // ดู HTML ที่ได้จาก Google Scholar

    // Debug ข้อมูลที่ได้รับ
    dd($data);

            return [
                'profile' => $profile_name,
                'total_citations' => $total_citations,
                'papers' => $papers
            ];

        } catch (\Exception $e) {
            return ['error' => "Failed to fetch data: " . $e->getMessage()];
        }
    }

    // ✅ ฟังก์ชันดึงข้อมูล Paper แบบละเอียด
    private function fetchPaperDetails($paperPageUrl)
    {
        try {
            // ✅ หน่วงเวลา 10-20 วินาทีก่อนโหลดหน้ารายละเอียด Paper
           

            $client = new Client();
            $crawler = $client->request('GET', $paperPageUrl);

            // ✅ ดึง Paper URL จาก <a class="gsc_oci_title_link">
            $paperUrlNode = $crawler->filter('.gsc_oci_title_link');
            $paperUrl = $paperUrlNode->count() ? $paperUrlNode->attr('href') : '#';

            // ✅ ดึงคำอธิบายจาก <div class="gsh_small">
            $descriptionNode = $crawler->filter('.gsh_small');
            $description = $descriptionNode->count() ? trim($descriptionNode->text()) : "No description available.";

            // ✅ ดึงประเภทของ Paper
            $paperTypeNode = $crawler->filterXPath('//*[@id="gsc_oci_table"]/div[3]/div[1]');
            $paperType = $paperTypeNode->count() ? trim($paperTypeNode->text()) : 'N/A';

            // ✅ ดึงรายละเอียดของประเภท Paper
            $paperTypeDetailNode = $crawler->filterXPath('//*[@id="gsc_oci_table"]/div[3]/div[2]');
            $paperTypeDetail = $paperTypeDetailNode->count() ? trim($paperTypeDetailNode->text()) : 'N/A';

            // ✅ หน่วงเวลา 5-10 วินาที ก่อนคืนค่า

            return [
                'paperUrl' => $paperUrl,
                'description' => $description,
                'paperType' => $paperType,
                'paperTypeDetail' => $paperTypeDetail
            ];
        } catch (\Exception $e) {
            return [
                'paperUrl' => '#',
                'description' => "Failed to fetch description.",
                'paperType' => 'N/A',
                'paperTypeDetail' => 'N/A'
            ];
        }
        $crawler = $client->request('GET', $url);
$data = $crawler->html(); // ดู HTML ที่ได้จาก Google Scholar

// Debug ข้อมูลที่ได้รับ
dd($data);
    }

    private function getRandomUserAgent()
    {
        $userAgents = [
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
            "Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36",
        ];
        return $userAgents[array_rand($userAgents)];
    }
}