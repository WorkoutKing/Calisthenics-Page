<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use App\Models\Result;
use App\Models\ChallengeResult;
use App\Models\Challenge;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\BasicApprovedNotification;
use App\Notifications\BasicDeletedNotification;
use App\Notifications\ElementApprovedNotification;
use App\Notifications\ElementDeletedNotification;
use App\Notifications\ChallengeApprovedNotification;
use App\Notifications\ChallengeDeletedNotification;
use App\Models\Achievement;
use App\Notifications\AchievementEarned;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Challenge Results Index
    public function challengeResultsIndex()
    {
        $challengeResults = ChallengeResult::where('approved', 0)->paginate(15);
        return view('admin.challenge_results', compact('challengeResults'));
    }

    // Approve Challenge Result
    public function approveChallengeResult(ChallengeResult $challengeResult)
    {
        $challengeResult->approve();

        if ($challengeResult->user) {
            $challengeResult->user->notify(new ChallengeApprovedNotification($challengeResult));
        }

        return redirect()->route('admin.challengeResults')->with('success', 'Challenge result approved!');
    }


    // Approve Challenge
    public function approveChallenge(Challenge $challenge)
    {
        $challenge->update(['approved' => 1]);

        $challenge->user->notify(new ChallengeApprovedNotification($challenge));

        return redirect()->route('admin.challenges')->with('success', 'Challenge approved!');
    }

    // Delete Challenge
    public function deleteChallengeResult(ChallengeResult $challengeResult)
    {
        if ($challengeResult->user) {
            $challengeResult->user->notify(new ChallengeDeletedNotification($challengeResult));
        }

        $challengeResult->delete();

        return redirect()->route('admin.challengeResults')->with('success', 'Challenge result deleted!');
    }

    // Element Results Index
    public function elementResultsIndex()
    {
        $elementResults = Result::where('approved', 0)->paginate(15);
        return view('admin.element_results', compact('elementResults'));
    }


    // Delete Element Result
    public function deleteElementResult(Result $result)
    {
        $result->delete();

        $result->user->notify(new ElementDeletedNotification($result));

        return redirect()->route('admin.elementResults')->with('success', 'Element result deleted!');
    }

    // Approve Element Result
    public function approveElementResult(Result $result)
    {
        $result->approve();

        $result->user->notify(new ElementApprovedNotification($result));

        $step = $result->step;
        $element = $step->element;

        $hardestStep = $element->steps()->orderBy('points', 'desc')->first();

        if ($step->id === $hardestStep->id) {
            $existingAchievement = Achievement::where('user_id', $result->user_id)
                ->where('element_id', $element->id)
                ->first();

            if (!$existingAchievement) {
                Achievement::create([
                    'user_id' => $result->user_id,
                    'element_id' => $element->id,
                    'completed_at' => now(),
                ]);

                $result->user->notify(new AchievementEarned($element, $step));
            }
        }

        return redirect()->route('admin.elementResults')->with('success', 'Element result approved!');
    }

    // Basics Results Index
    public function basicsResultsIndex()
    {
        $pendingBasics = Basic::where('approved', false)->latest()->paginate(15);
        return view('admin.basics_results', compact('pendingBasics'));
    }

    // Basics Results Approve
    public function basicsResultsApprove(Basic $basic)
    {
        $basic->update(['approved' => true]);

        $basic->user->notify(new BasicApprovedNotification($basic));

        return redirect()->back()->with('success', 'Basic approved successfully.');
    }

    // Basics Results Delete
    public function basicsResultsDelete(Basic $basic)
    {
        $basic->delete();

        $basic->user->notify(new BasicDeletedNotification());

        return redirect()->back()->with('success', 'Basic deleted successfully.');
    }

    // Users Index
    public function indexUsers()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Create User
    public function createUser()
    {
        $roles = Role::select('id', 'role_name')->get();

        return view('admin.users.create', compact('roles'));
    }


    // Store User
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }


    // Edit User
    public function editUser(User $user)
    {
        $roles = Role::select('id', 'role_name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Update User
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete User
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

}
