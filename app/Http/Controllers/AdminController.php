<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ChallengeResult;

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

    // Approve element result
    public function approveElementResult(Result $result)
    {
        $result->approve();
        return redirect()->route('admin.elementResults')->with('success', 'Element result approved!');
    }
}
