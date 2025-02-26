<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateFormController extends Controller
{
    public function index()
    {
        return view('certificate-form.index');
    }
}
