<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ProfileController extends Controller
{
    use Notifiable;

    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('profile.index', compact('notifications'));
    }


    public function edit(Request $request): View
    {
        return view('profile.settings.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.settings.edit')->with('status', 'profile-updated');
    }

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
    public function dashboard()
    {
        $notifications = auth()->user()->notifications()->latest()->get();

        return view('profile.dashboard', compact('notifications'));
    }
    public function markAsRead(Notification $notification)
    {
        $notification->update(['read' => true]);

        return redirect()->route('profile.dashboard')->with('success', 'Notification marked as read.');
    }

}
