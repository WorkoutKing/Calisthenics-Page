<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use App\Models\Result;
use App\Models\ChallengeResult;
use App\Models\Challenge;
use App\Notifications\BasicApprovedNotification;
use App\Notifications\BasicDeletedNotification;
use App\Notifications\ElementApprovedNotification;
use App\Notifications\ElementDeletedNotification;
use App\Notifications\ChallengeApprovedNotification;
use App\Notifications\ChallengeDeletedNotification;

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
        $challengeResults = ChallengeResult::where('approved', 0)->get();
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
        $elementResults = Result::where('approved', 0)->get();
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

        return redirect()->route('admin.elementResults')->with('success', 'Element result approved!');
    }

    // Basics Results Index
    public function basicsResultsIndex()
    {
        $pendingBasics = Basic::where('approved', false)->latest()->get();
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

}
