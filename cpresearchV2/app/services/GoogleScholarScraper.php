<?php 

namespace App\Services;  

use Exception;
use DOMDocument;
use DOMXPath;

class GoogleScholarScraper
{
    public function scrapeScholarProfile($scholar_id)
    {
        try {
            $url = "https://scholar.google.com/citations?view_op=list_works&pagesize=100&hl=en&user=" . $scholar_id;

            $html = $this->fetchPage($url);
            if (!$html) {
                throw new Exception("Failed to load page from Google Scholar");
            }

            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            $profile_name = $this->getXPathText($xpath, '//*[@id="gsc_prf_in"]');
            $total_citations = $this->getXPathText($xpath, '//*[@id="gsc_rsb_st"]//td[@class="gsc_rsb_std"][1]');

            $papers = [];
            $paperNodes = $xpath->query('//tr[@class="gsc_a_tr"]');

            foreach ($paperNodes as $paper) {
                $title = $this->getXPathText($xpath, './/td[@class="gsc_a_t"]/a', $paper);
                $authors = $this->getXPathText($xpath, './/td[@class="gsc_a_t"]/div[@class="gs_gray"][1]', $paper);
                $paper_type_detail = $this->getXPathText($xpath, './/td[@class="gsc_a_t"]/div[@class="gs_gray"][2]', $paper);
                $citations = $this->getXPathText($xpath, './/td[@class="gsc_a_c"]/a', $paper);
                $year = $this->getXPathText($xpath, './/td[@class="gsc_a_y"]/span', $paper);

                $papers[] = [
                    'paper' => $title,
                    'authors' => $authors,
                    'paper_type_detail' => $paper_type_detail,
                    'citations' => $citations,
                    'year' => $year,
                ];
            }

            return [
                'profile' => $profile_name ?: 'N/A',
                'total_citations' => $total_citations ?: '0',
                'papers' => $papers
            ];
        } catch (Exception $e) {
            return ['error' => "Failed to fetch data: " . $e->getMessage()];
        }
    }

    protected function fetchPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->getRandomUserAgent());
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }

    private function getXPathText($xpath, $query, $contextNode = null)
    {
        $node = $contextNode ? $xpath->query($query, $contextNode) : $xpath->query($query);
        return $node->length > 0 ? trim($node->item(0)->textContent) : 'N/A';
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
