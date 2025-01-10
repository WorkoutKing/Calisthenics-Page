<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BasicController extends Controller
{
    public function index()
    {
        $basics = Basic::where('user_id', Auth::id())->latest()->get();
        return view('basics.index', compact('basics'));
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'exercise' => 'required|in:pull ups,push ups,dips,pistol squats',
            'reps' => 'required|integer|min:1',
            'video_url' => 'required|url',
        ]);

        $existingUpload = Basic::where('user_id', Auth::id())
            ->where('exercise', $request->exercise)
            ->latest()
            ->first();

        if ($existingUpload) {
            $existingUpload->update([
                'reps' => $request->reps,
                'video_url' => $request->video_url,
                'approved' => false,
            ]);
            return redirect()->route('basics.index')->with('success', 'Your upload has been updated and is pending approval.');
        }

        $validated['user_id'] = Auth::id();
        Basic::create($validated);

        return redirect()->route('basics.index')->with('success', 'Your upload has been submitted for approval.');
    }

    public function statistics()
    {
        $topPullUps = Basic::where('exercise', 'pull ups')
            ->orderByDesc('reps')
            ->take(10)
            ->get();

        $topPushUps = Basic::where('exercise', 'push ups')
            ->orderByDesc('reps')
            ->take(10)
            ->get();

        $topDips = Basic::where('exercise', 'dips')
            ->orderByDesc('reps')
            ->take(10)
            ->get();

        $topPistolSquats = Basic::where('exercise', 'pistol squats')
            ->orderByDesc('reps')
            ->take(10)
            ->get();

        return view('basics.statistics', compact('topPullUps', 'topPushUps', 'topDips', 'topPistolSquats'));
    }
}
