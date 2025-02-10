<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\ProxyService;

class GoogleScholarScraper
{
    protected $proxyService;

    public function __construct(ProxyService $proxyService)
    {
        $this->proxyService = $proxyService;
    }

    public function scrapeScholarProfile($scholar_id)
    {
        $proxies = $this->proxyService->getProxies(); // ดึง Proxy ทั้งหมด
        shuffle($proxies); // สุ่ม Proxy ก่อนใช้
        $maxRetries = count($proxies); // จำกัดจำนวนรอบการลอง
        $retryCount = 0;

        while ($retryCount < $maxRetries) {
            $proxy = $proxies[$retryCount] ?? null;
            $retryCount++;

            try {
                if (!$proxy) {
                    throw new \Exception("No available proxy found.");
                }

                // ตั้งค่า HTTP Client ให้ใช้ Proxy
                $httpClient = HttpClient::create([
                    'proxy' => $proxy,
                    'timeout' => 10,
                    'headers' => [
                        'User-Agent' => $this->getRandomUserAgent()
                    ]
                ]);

                $client = new Client($httpClient);
                $url = "https://scholar.google.com/citations?user=" . $scholar_id;
                $crawler = $client->request('GET', $url);

                // ตรวจสอบว่า Response ได้ HTML กลับมาหรือไม่
                if (!$crawler) {
                    throw new \Exception("Failed to load page from Google Scholar using proxy: $proxy");
                }

                // ดึงข้อมูลโปรไฟล์
                $profile_name = $crawler->filter('#gsc_prf_in')->count() ? $crawler->filter('#gsc_prf_in')->text() : 'N/A';
                $total_citations = $crawler->filter('#gsc_rsb_st td.gsc_rsb_std')->eq(0)->count() ? $crawler->filter('#gsc_rsb_st td.gsc_rsb_std')->eq(0)->text() : '0';

                return [
                    'profile' => $profile_name,
                    'total_citations' => $total_citations
                ];

            } catch (\Exception $e) {
                // ถ้า Proxy ใช้ไม่ได้ ให้ลองตัวถัดไป
                if ($retryCount >= $maxRetries) {
                    return ['error' => "All proxies failed: " . $e->getMessage()];
                }
            }
        }

        return ['error' => 'Failed to fetch data after trying all proxies.'];
    }

    private function getRandomUserAgent()
    {
        $userAgents = [
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
            "Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Mobile Safari/537.36",
            "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:89.0) Gecko/20100101 Firefox/89.0"
        ];

        return $userAgents[array_rand($userAgents)];
    }
}
