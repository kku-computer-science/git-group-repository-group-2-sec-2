<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ScopuscallController;
use App\Http\Controllers\GoogleScholarController;
use App\Services\GoogleScholarScraper;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class BothPaperCallController extends Controller
{
    public function callBothSources($id)
    {
        try {
            $userId = Crypt::decrypt($id);
            $user = User::findOrFail($userId);
            // ✅ เรียกใช้งาน Scopus API
            $scopusController = new ScopuscallController();
            $scopusResponse = $scopusController->create($id);

            // ✅ เรียกใช้งาน Google Scholar API
            $googleScholarScraper = new GoogleScholarScraper();
            $scholarController = new GoogleScholarController($googleScholarScraper);
            $scholarResponse = $scholarController->getScholarProfile($user->scholar_id);

            // return response()->json([
            //     'scopus' => $scopusResponse,
            //     'google_scholar' => $scholarResponse
            // ]);
            return redirect()->back();

        } catch (\Exception $e) {
            return response()->json(['error' => "Failed to fetch data: " . $e->getMessage()], 500);
        }
    }
}
