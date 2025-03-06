<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssistantResearcherController extends Controller
{
    public function index()
    {
        return view('assistant_researcher.index');
    }
}
