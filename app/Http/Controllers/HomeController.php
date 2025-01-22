<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Post;
use App\Models\Challenge;
use App\Models\Basic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quote = Quote::inRandomOrder()->first();

        $challenges = Challenge::where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        $topPullups = Basic::where('exercise', 'pull ups')
            ->orderByDesc('reps')
            ->take(3)
            ->get();

        $topPushups = Basic::where('exercise', 'push ups')
            ->orderByDesc('reps')
            ->take(3)
            ->get();

        $topDips = Basic::where('exercise', 'dips')
            ->orderByDesc('reps')
            ->take(3)
            ->get();

        $topPistolsquats = Basic::where('exercise', 'pistol squats')
            ->orderByDesc('reps')
            ->take(3)
            ->get();

        $newestPosts = Post::latest()->take(8)->get();

        return view('welcome', compact('quote', 'challenges', 'topPullups', 'topPushups', 'topDips', 'topPistolsquats', 'newestPosts'));
    }
}
