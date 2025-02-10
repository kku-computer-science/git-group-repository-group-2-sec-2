<?php

namespace App\Http\Controllers;

use App\Models\ApiStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class APIstatusController extends Controller
{
    public function index()
    {
        $statuses = ApiStatus::all();
        return view('apistatus.index', compact('statuses'));
    }

    public function updateOrCreate(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'api_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'last_checked' => 'required|date',
            'message' => 'nullable|string|max:255', // Make message nullable
        ]);

        // Ensure last_checked is properly formatted
        $validated['last_checked'] = now()->toDateTimeString();

        try {
            // Using 'updateOrCreate' to either update an existing record or create a new one
            $status = ApiStatus::updateOrCreate(
                ['api_name' => $validated['api_name']], // Check if the api_name already exists
                [
                    'status' => $validated['status'],
                    'last_checked' => $validated['last_checked'],
                    'message' => $validated['message']
                ]
            );

            Log::info('API status updated or created successfully:', ['status' => $status]);

            // Return appropriate response based on request type
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'API status updated successfully', 'data' => $status], 200);
            }

            return redirect()->route('apistatus.index');
        } catch (\Exception $e) {
            Log::error('Failed to update or create API status:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update or create API status'], 500);
        }
    }
}