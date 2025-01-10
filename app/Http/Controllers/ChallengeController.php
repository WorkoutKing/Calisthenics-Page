<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Models\ChallengeResult;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\ChallengeCreatedNotification;

class ChallengeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $challenges = Challenge::where('status', '!=', 'completed')->get();
        } else {
            $challenges = Challenge::where('status', 'active')
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->get();
        }

        $previousChallenges = Challenge::where('status', 'completed')
            ->withCount([
                'challengeResults as completed_count' => function ($query) {
                    $query->where('approved', true);
                }
            ])->get();

        $userResults = auth()->check()
            ? ChallengeResult::where('user_id', auth()->id())->get(['challenge_id', 'approved'])->keyBy('challenge_id')
            : collect();

        return view('challenges.index', compact('challenges', 'previousChallenges', 'userResults'));
    }

    public function show($id)
    {
        $challenge = Challenge::findOrFail($id);

        $canJoin = $challenge->status == 'active' &&
            now()->between($challenge->start_date, $challenge->end_date);

        $userJoined = $challenge->participants->contains(auth()->id());

        $userResult = ChallengeResult::where('challenge_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return view('challenges.show', compact('challenge', 'userJoined', 'userResult', 'canJoin'));
    }

    public function join($id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge->participants()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('challenges.index')->with('error', 'You have already joined this challenge.');
        }

        $challenge->participants()->attach(auth()->id());

        return redirect()->route('challenges.index')->with('success', 'You have successfully joined the challenge.');
    }


    public function complete(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        if (!$challenge->participants->contains(auth()->id())) {
            return redirect()->route('challenges.show', $id)->with('error', 'You must join the challenge before uploading results.');
        }

        if (ChallengeResult::where('challenge_id', $id)->where('user_id', auth()->id())->exists()) {
            return redirect()->route('challenges.show', $id)->with('error', 'You have already submitted results for this challenge.');
        }

        $request->validate([
            'result' => 'required|string|max:255',
        ]);

        ChallengeResult::create([
            'user_id' => auth()->id(),
            'challenge_id' => $id,
            'result' => $request->result,
        ]);

        return redirect()->route('challenges.show', $id)->with('success', 'Your results have been uploaded successfully.');
    }



    public function create()
    {
        return view('challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $challenge = Challenge::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        // Notify all users about the new challenge
        $users = User::all(); // Fetch all users
        foreach ($users as $user) {
            $user->notify(new ChallengeCreatedNotification($challenge));
        }

        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully!');
    }
    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('challenges.edit', compact('challenge'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully!');
    }
    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();

        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,active,completed',
        ]);

        $challenge->update([
            'status' => $request->status,
        ]);

        return redirect()->route('challenges.index')->with('success', 'Challenge status updated successfully!');
    }

}
