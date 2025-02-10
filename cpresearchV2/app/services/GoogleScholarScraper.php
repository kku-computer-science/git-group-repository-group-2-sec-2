<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\ProxyService;

class GoogleScholarScraper
{
    protected $proxyService;
    private function getRandomUserAgent()
{
    $userAgents = [
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
        "Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:89.0) Gecko/20100101 Firefox/89.0"
    ];
    return $userAgents[array_rand($userAgents)];
}


    public function __construct(ProxyService $proxyService)
    {
        $this->proxyService = $proxyService;
    }

    public function scrapeScholarProfile($scholar_id)
    {
        $proxies = $this->proxyService->getProxies();
        shuffle($proxies);
        // $maxRetries = count($proxies);
        $maxRetries = min(count($proxies), 3); // จำกัดแค่ 3 Proxy
        $retryCount = 0;

        while ($retryCount < $maxRetries) {
            $proxy = $proxies[$retryCount] ?? null;
            $retryCount++;

            try {
                if (!$proxy) {
                    throw new \Exception("No available proxy found.");
                }

                $httpClient = HttpClient::create([
                    'proxy' => $proxy,
                    'timeout' => 5, // ลดจาก 10 เป็น 5 วิ
                    'headers' => [
                        'User-Agent' => $this->getRandomUserAgent()
                    ]
                ]);

                $client = new Client($httpClient);
                $url = "https://scholar.google.com/citations?user=" . $scholar_id;
                $crawler = $client->request('GET', $url);

                if (!$crawler) {
                    throw new \Exception("Failed to load page from Google Scholar using proxy: $proxy");
                }

                $papers = [];
                $crawler->filter('.gsc_a_tr')->slice(0, 1)->each(function ($node) use (&$papers) {
                    $titleElement = $node->filter('.gsc_a_t a');
                    $authorsElement = $node->filter('.gsc_a_t div.gs_gray')->eq(0);
                    $publicationElement = $node->filter('.gsc_a_t div.gs_gray')->eq(1);
                    $citationsElement = $node->filter('.gsc_a_c a');
                    $yearElement = $node->filter('.gsc_a_y span');
                
                    $title = $titleElement->count() ? $titleElement->text() : 'N/A';
                    $paperUrl = $titleElement->count() ? 'https://scholar.google.com' . $titleElement->attr('href') : '#';
                    $authors = $authorsElement->count() ? $authorsElement->text() : 'N/A';
                    $paperType = $publicationElement->count() ? 'Journal/Conference' : 'N/A';
                    $paperTypeDetail = $publicationElement->count() ? $publicationElement->text() : 'N/A';
                    $citations = $citationsElement->count() ? $citationsElement->text() : '0';
                    $year = $yearElement->count() ? $yearElement->text() : 'N/A';
                
                    $papers[] = [
                        'paper' => $title,
                        'Authors' => $authors,
                        'paperUrl' => $paperUrl,
                        'citations' => $citations,
                        'year' => $year,
                        'paper_type' => $paperType,
                        'paper_type_detail' => $paperTypeDetail,
                        'description' => "No description available"
                    ];
                });
                

                return [
                    'profile' => $profile_name,
                    'total_citations' => $total_citations,
                    'papers' => $papers
                ];

            } catch (\Exception $e) {
                $this->proxyService->removeFailedProxy($proxy);

                if ($retryCount >= $maxRetries) {
                    return ['error' => "All proxies failed after $maxRetries attempts: " . $e->getMessage()];
                }
            }
        }

        return ['error' => 'Failed to fetch data after trying multiple proxies.'];
    }
}
