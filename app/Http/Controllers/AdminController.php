<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ChallengeResult;
use App\Notifications\ElementApprovedNotification;
use App\Notifications\ElementDeletedNotification;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Show pending challenge results
    public function challengeResultsIndex()
    {
        $challengeResults = ChallengeResult::where('approved', 0)->get();
        return view('admin.challenge_results', compact('challengeResults'));
    }

    // Approve challenge result
    public function approveChallengeResult(ChallengeResult $result)
    {
        $result->approve();
        return redirect()->route('admin.challengeResults')->with('success', 'Challenge result approved!');
    }

    // Show pending element results
    public function elementResultsIndex()
    {
        $elementResults = Result::where('approved', 0)->get();
        return view('admin.element_results', compact('elementResults'));
    }

    // Delete element result
    public function deleteElementResult(Result $result)
    {
        // Delete the element result
        $result->delete();

        // Notify the user who created the result
        $result->user->notify(new ElementDeletedNotification($result));

        return redirect()->route('admin.elementResults')->with('success', 'Element result deleted!');
    }

    public function approveElementResult(Result $result)
    {
        // Approve the element result
        $result->approve();  // Assume you have an 'approve' method on your Result model

        // Notify the user who created the result
        $result->user->notify(new ElementApprovedNotification($result));

        return redirect()->route('admin.elementResults')->with('success', 'Element result approved!');
    }

}
