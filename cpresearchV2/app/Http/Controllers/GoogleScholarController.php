<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleScholarScraper;
use App\Models\Paper;
use App\Models\User;
use App\Models\Author;
use App\Models\Source_data;
use Illuminate\Support\Facades\DB;

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

        // ✅ ดึง User ที่ล็อกอิน (หรือใช้ user ID ที่กำหนดเอง)
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // ✅ บันทึก Paper พร้อมเชื่อมโยงกับ User
        foreach ($data['papers'] as $paperData) {
            $paper = Paper::updateOrCreate(
                ['paper_name' => $paperData['paper']],
                [
                    'abstract' => null,
                    'paper_type' => null,
                    'paper_url' => $paperData['paperUrl'],
                    'paper_yearpub' => is_numeric($paperData['year']) ? (int) $paperData['year'] : null,
                    'paper_citation' => is_numeric($paperData['citations']) ? (int) $paperData['citations'] : 0,
                    'paper_sourcetitle' => $paperData['paper_type_detail'] ?? null,
                    'publication' => null,
                    'paper_volume' => null,
                    'paper_issue' => null,
                    'paper_page' => null,
                    'paper_doi' => null,
                    'paper_funder' => null,
                    'reference_number' => null
                ]
            );

            // ✅ ตรวจสอบว่ามีความสัมพันธ์ระหว่าง User และ Paper หรือยัง
            $exists = DB::table('user_papers')
                ->where('user_id', $user->id)
                ->where('paper_id', $paper->id)
                ->exists();

            if (!$exists) {
                // ✅ เชื่อมโยง User กับ Paper โดยกำหนด `author_type`
                $paper->teacher()->attach($user->id, ['author_type' => 1]);
            }
        }

        return response()->json($data);
    }
}