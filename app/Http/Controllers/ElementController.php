<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementController extends Controller
{
    //
    public function index()
    {
        $elements = Element::with('steps')->get();
        return view('elements.index', compact('elements'));
    }

    public function create()
    {
        return view('elements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Element::create($request->all());
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
}
