<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleScholarScraper;
use App\Models\Paper;
use App\Models\User;
use App\Models\Author;
use App\Models\Source_data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GoogleScholarController extends Controller
{
    protected $scraper;

    public function __construct(GoogleScholarScraper $scraper)
    {
        $this->scraper = $scraper;
    }

    public function getScholarProfile($scholar_id)
    {
        try {
            $data = $this->scraper->scrapeScholarProfile($scholar_id);

            // Check if specific fields are "N/A" or if "papers" is an empty array
            if ($data['profile'] === 'N/A' && $data['total_citations'] === 'N/A' && empty($data['papers']) && $data['scholar_id'] !== 'N/A') {
                throw new \Exception('The Google Scholar profile information is incomplete or unavailable.');
            }

            if (isset($data['error'])) {
                throw new \Exception($data['error']);
            }

            // อัปเดตสถานะ API ว่าใช้งานได้
            $this->updateApiStatus('Google Scholar API', 'active');

            // ✅ ดึง User ที่ล็อกอิน (หรือใช้ user ID ที่กำหนดเอง)
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated');
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
                    // ✅ เชื่อมโยง User กับ Paper โดยกำหนด author_type
                    $paper->teacher()->attach($user->id, ['author_type' => 1]);
                }
            }

            // Optional: Log success or perform other actions

            return response()->json($data);

        } catch (\Exception $e) {
            Log::error("Error fetching Scholar profile: " . $e->getMessage());

            // Update API status to 'inactive' due to the error
            $this->updateApiStatus('Google Scholar API', 'inactive', $e->getMessage());

            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    private function updateApiStatus($apiName, $status, $message = null)
    {
        $requestData = [
            'api_name' => $apiName,
            'status' => $status,
            'last_checked' => now()->toDateTimeString(),
            'message' => $message,
        ];

        // Log the data for debugging
        Log::info('Updating API status with data:', $requestData);

        // Create an instance of the API status controller
        $controller = new APIstatusController();

        // Call the updateOrCreate method on the controller instance
        return $controller->updateOrCreate(new Request($requestData));
    }
}
