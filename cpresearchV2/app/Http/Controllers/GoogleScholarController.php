<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleScholarScraper;
use App\Models\Paper;

class GoogleScholarController extends Controller
{
    protected $scraper;

    public function __construct(GoogleScholarScraper $scraper)
    {
        $this->scraper = $scraper;
    }

    public function getScholarProfile($scholar_id)
    {
        $data = $this->scraper->scrapeScholarProfile($scholar_id);

        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 500);
        }

        // 🔹 เตรียมข้อมูล JSON ตามที่ต้องการ
        $response = [
            'profile' => $data['profile'] ?? 'Unknown',
            'total_citations' => $data['total_citations'] ?? '0',
            'papers' => []
        ];

        foreach ($data['papers'] as $paper) {
            $paperUrl = "https://scholar.google.com/scholar?q=" . urlencode($paper['paper']); // 🔹 สร้าง URL ของ Paper
            $response['papers'][] = [
                'paper' => $paper['paper'] ?? 'Untitled Paper',
                'authors' => $paper['authors'] ?? 'Unknown',
                'citations' => is_numeric($paper['citations']) ? (int) $paper['citations'] : 0,
                'year' => is_numeric($paper['year']) ? (int) $paper['year'] : null,
                'paperUrl' => $paperUrl
            ];

            // 🔹 บันทึกลงฐานข้อมูล
            Paper::updateOrCreate(
                ['paper_name' => $paper['paper']],
                [
                    'abstract' => $paper['authors'] ?? null,
                    'paper_type' => null,
                    'paper_subtype' => null,
                    'paper_url' => $paperUrl, 
                    'paper_yearpub' => is_numeric($paper['year']) ? (int) $paper['year'] : null,
                    'paper_citation' => is_numeric($paper['citations']) ? (int) $paper['citations'] : 0,
                    'paper_sourcetitle' => null,
                    'publication' => null,
                    'paper_volume' => null,
                    'paper_issue' => null,
                    'paper_page' => null,
                    'paper_doi' => null,
                    'paper_funder' => null,
                    'reference_number' => null
                ]
            );
        }

        return response()->json($response);
    }
}
