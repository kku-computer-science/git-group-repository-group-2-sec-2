<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        return view('highlight.index');
    }
}
