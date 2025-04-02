<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function indexPrivacy()
    {
        return view('pages.privacy-policy');
    }
    public function indexAboutUs()
    {
        return view('pages.about-us');
    }
    public function indexCalculator()
    {
        return view('pages.calculator');
    }
    public function indexGPM()
    {
        return view('pages.gpm');
    }
}

