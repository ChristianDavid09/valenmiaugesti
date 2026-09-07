<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolitytermsController extends Controller
{
    public function index()
    {
        return view('termsUse.polity');
    }
    public function show()
    {
        return view('termsUse.terms');
    }
}
