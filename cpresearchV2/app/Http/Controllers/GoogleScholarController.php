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

        // 🔹 บันทึก Paper ลงฐานข้อมูล
        foreach ($data['papers'] as $paper) {
            Paper::updateOrCreate(
                ['paper_name' => $paper['paper']],
                [
                    'abstract' => null,
                    // 'paper_type' => $paper['paper_type_detail'] ?? null, 
                    'paper_type' => null,
                    'paper_url' => $paper['paperUrl'],
                    'paper_yearpub' => is_numeric($paper['year']) ? (int) $paper['year'] : null,
                    'paper_citation' => is_numeric($paper['citations']) ? (int) $paper['citations'] : 0,
                    'paper_sourcetitle' => $paper['paper_type_detail'] ?? null,
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

        return response()->json($data);
    }
}
