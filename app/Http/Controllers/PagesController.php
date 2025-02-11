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
}

