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
                ['paper_name' => $paper['paper']],  // ค้นหาว่ามี Paper นี้อยู่แล้วหรือไม่
                [
                    'abstract' => $paper['description'],
                    'paper_type' => $paper['paper_type'],
                    // 'paper_subtype' => $paper['paper_type_detail'],
                    'paper_subtype' => null,
                    'paper_url' => $paper['paperUrl'],
                    'paper_yearpub' => $paper['year'],
                    'paper_citation' => (int) $paper['citations'],
                    'paper_sourcetitle' => 'Google Scholar',  // เพิ่มข้อมูลแหล่งที่มา
                    'publication' => null, // ถ้าไม่มี ให้เป็น NULL
                    'paper_volume' => null,
                    'paper_issue' => null,
                    'paper_page' => null,
                    'paper_doi' => null,
                    'paper_funder' => null,
                    'reference_number' => null
                ]
            );
        }

        return response()->json([
            'message' => 'Data saved successfully',
            'papers' => $data['papers']
        ]);
    }
}