<?php

namespace App\Http\Controllers;

use App\Models\ApiStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

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
            'api_name' => 'required|string|max:255', // Adjust validation as needed
            'status' => 'required|string|max:255', // Adjust validation as needed
            'last_checked' => 'required|date', // Adjust validation as needed
            'message' => 'required|string|max:255', // Adjust validation as needed
        ]);

        // Using 'updateOrCreate' to either update an existing record or create a new one
        $status = ApiStatus::updateOrCreate(
            ['api_name' => $validated['api_name']], // Check if the api_name already exists
            [
                'status' => $validated['status'],
                'last_checked' => $validated['last_checked'],
                'message' => $validated['message']
            ]
        );

        // Redirect back to the index with a success message
        return redirect()->route('apistatus.index');
    }
}