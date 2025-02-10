<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleScholarScraper;
use App\Models\User;
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

        // 🔹 ค้นหาหรือสร้าง User ที่มี scholar_id นี้
        $researcher = User::updateOrCreate(
            ['scholar_id' => $scholar_id],
            ['fname_en' => is_array($data['profile']) ? ($data['profile']['name'] ?? 'Unknown') : $data['profile']]
        );
        foreach ($data['papers'] as $paperData) {
            // 🔹 ตรวจสอบว่ามี Paper นี้อยู่แล้วหรือไม่
            $existingPaper = Paper::where('paper_name', $paperData['paper'])
                ->whereHas('teacher', function ($query) use ($researcher) {
                    $query->where('users.id', $researcher->id);
                })
                ->first();

            if ($existingPaper) {
                continue; // ✅ ถ้ามีแล้ว ข้ามการเพิ่มข้อมูลซ้ำ
            }

            // 🔹 เพิ่ม Paper ใหม่
            $paper = Paper::create([
                'paper_name'       => $paperData['paper'],
                'paper_yearpub'    => $paperData['year'] ?? null,
                'paper_citation'   => $paperData['citations'] ?? 0,
                'paper_type'       => $paperData['paper_type'] ?? null,
                'abstract'         => $paperData['description'] ?? null,
                'paper_url'        => $paperData['paperUrl'] ?? null
            ]);

            // 🔹 เชื่อมโยง User กับ Paper ผ่าน user_papers
            $researcher->paper()->attach($paper->id, ['author_type' => 'Researcher']);
        }

        return response()->json(['message' => 'Data saved successfully']);
    }
}
