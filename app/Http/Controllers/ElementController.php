<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Exercise;

class ElementController extends Controller
{
    //
    public function index()
    {
        $elements = Element::with(['steps', 'exercise'])->get();
        return view('elements.index', compact('elements'));
    }

    public function create()
    {
        $exercises = Exercise::orderBy('title')->get();
        return view('elements.create', compact('exercises'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'exercise_id' => 'nullable|exists:exercises,id',
        ]);

        Element::create([
            'name' => $request->name,
            'description' => $request->description,
            'exercise_id' => $request->exercise_id
        ]);

        return redirect()->back()->with('success', 'Element created successfully');
    }

    public function statistics()
    {
        $elements = Element::with([
            'steps.results' => function ($query) {
                $query->join('steps', 'steps.id', '=', 'results.step_id')
                    ->select(
                        'results.id as result_id',
                        'results.user_id',
                        'results.video_url',
                        'results.reps_time',
                        'results.approved',
                        'steps.id as step_id',
                        'steps.points as step_points',
                        'results.step_id as result_step_id'
                    )
                    ->orderByDesc('results.reps_time')
                    ->take(3);
            }
        ])->get();
        return view('elements.statistics', compact('elements'));
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $exercises = Exercise::orderBy('title')->get();

        return view('elements.edit', compact('element', 'exercises'));
    }

    public function update(Request $request, $element_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'exercise_id' => 'nullable|exists:exercises,id',
        ]);

        $element = Element::findOrFail($element_id);

        $element->update([
            'name' => $request->name,
            'description' => $request->description,
            'exercise_id' => $request->exercise_id,
        ]);

        return redirect()->route('elements.index')->with('success', 'Element updated successfully');
    }
}
