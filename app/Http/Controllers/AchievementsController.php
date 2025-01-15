<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;

class AchievementsController extends Controller
{
    public function index()
    {
        $achievements = Achievement::where('user_id', auth()->id())->paginate(15);
        return view('achievements.index', compact('achievements'));
    }
}

