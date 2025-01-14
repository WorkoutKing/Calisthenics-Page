<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Basic;
use App\Models\Notification;
use App\Models\Result;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $approvedBasics = Basic::where('user_id', $user->id)
            ->where('approved', true)
            ->get();

        $exerciseProgress = [];

        foreach ($approvedBasics as $basic) {
            $userScore = $basic->reps;

            $globalMax = Basic::where('exercise', $basic->exercise)
                ->where('approved', true)
                ->max('reps');

            $rank = Basic::where('exercise', $basic->exercise)
                ->where('reps', '>=', $userScore)
                ->count();

            $exerciseProgress[] = [
                'exercise' => $basic->exercise,
                'userScore' => $userScore,
                'globalMax' => $globalMax,
                'rank' => $rank,
            ];
        }

        $totalPoints = 0;
        $approvedResults = Result::where('user_id', $user->id)
            ->where('approved', true)
            ->get();

        foreach ($approvedResults as $result) {
            $step = $result->step;
            $totalPoints += $step->points;
        }

        $latestAchievements = Achievement::where('user_id', $user->id)
            ->with('element')
            ->latest()
            ->take(6)
            ->get();

        $allAchievementsCount = Achievement::where('user_id', $user->id)->count();

        return view('profile.index', [
            'exerciseProgress' => $exerciseProgress,
            'totalPoints' => $totalPoints,
            'latestAchievements' => $latestAchievements,
            'allAchievementsCount' => $allAchievementsCount,
        ]);
    }

    // For other users' profiles
    public function otherUserProfile($userId)
    {
        $user = User::findOrFail($userId);

        $approvedBasics = Basic::where('user_id', $user->id)
            ->where('approved', true)
            ->get();

        $exerciseProgress = [];

        foreach ($approvedBasics as $basic) {
            $userScore = $basic->reps;

            $globalMax = Basic::where('exercise', $basic->exercise)
                ->where('approved', true)
                ->max('reps');

            $rank = Basic::where('exercise', $basic->exercise)
                ->where('reps', '>=', $userScore)
                ->count();

            $exerciseProgress[] = [
                'exercise' => $basic->exercise,
                'userScore' => $userScore,
                'globalMax' => $globalMax,
                'rank' => $rank,
            ];
        }

        $totalPoints = 0;
        $approvedResults = Result::where('user_id', $user->id)
            ->where('approved', true)
            ->get();

        foreach ($approvedResults as $result) {
            $step = $result->step;
            $totalPoints += $step->points;
        }

        $latestAchievements = Achievement::where('user_id', $user->id)
            ->with('element')
            ->latest()
            ->take(6)
            ->get();

        $allAchievementsCount = Achievement::where('user_id', $user->id)->count();

        return view('profile.other', [
            'user' => $user,
            'exerciseProgress' => $exerciseProgress,
            'totalPoints' => $totalPoints,
            'latestAchievements' => $latestAchievements,
            'allAchievementsCount' => $allAchievementsCount,
        ]);
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('profile.notifications', compact('notifications'));
    }

    public function edit(Request $request): View
    {
        return view('profile.settings.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {

            if ($request->user()->profile_picture) {
                $oldFilePath = $request->user()->profile_picture;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }

            $newFilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $newFilePath;
        }

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.settings.edit')->with('status', 'profile-updated');
    }

    // Logout
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // User profile dashboard
    public function dashboard()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('profile.dashboard', compact('notifications'));
    }

    // Mark read notifications
    public function markAsRead()
    {
        auth()->user()->notifications()->where('read', 0)->update(['read' => 1]);

        return redirect()->route('profile.notifications')->with('success', 'All notifications marked as read.');
    }

    // Clear notifications
    public function clearNotifications()
    {
        auth()->user()->notifications()->delete();

        return redirect()->route('profile.notifications')->with('success', 'All notifications have been cleared.');
    }

    // Mark single notification as read
    public function markAsReadSingle($id)
    {
        $notification = DatabaseNotification::find($id);

        if ($notification && $notification->notifiable_id === auth()->id()) {
            $notification->update(['read' => 1]);

            return redirect()->back()->with('success', 'Notification marked as read.');
        }

        return redirect()->back()->withErrors('Notification not found or unauthorized.');
    }
}
