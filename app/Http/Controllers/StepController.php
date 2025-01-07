<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Element;
use App\Models\Result;

class StepController extends Controller
{
    public function uploadResult($step_id)
    {
        $step = Step::findOrFail($step_id);

        $result = Result::where('user_id', auth()->id())
            ->where('step_id', $step_id)
            ->first();

        if ($result) {
            $message = $result->approved
                ? 'Your result has already been approved for this step.'
                : 'Your result is awaiting approval.';
            return redirect()->route('steps.index')->with('error', $message);
        }

        return view('steps.upload_result', compact('step'));
    }


    public function storeResult(Request $request, $step_id)
    {
        $request->validate([
            'video_url' => 'nullable|url',
            'reps' => 'nullable|integer',
            'time' => 'nullable|numeric',
        ]);

        Result::create([
            'user_id' => auth()->id(),
            'step_id' => $step_id,
            'video_url' => $request->video_url,
            'reps' => $request->reps,
            'time' => $request->time,
        ]);

        return redirect()->route('elements.index')->with('success', 'Your result has been uploaded.');
    }

    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        return view('steps.create', compact('element'));
    }

    public function store(Request $request, $element_id)
    {
        $element = Element::findOrFail($element_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'criteria' => 'required|string',
            'points' => 'required|integer|min:0',
        ]);

        Step::create([
            'element_id' => $element->id,
            'name' => $request->name,
            'criteria' => $request->criteria,
            'points' => $request->points,
        ]);

        return redirect()->route('elements.index')->with('success', 'Step added successfully.');
    }


    public function edit($step_id)
    {
        $step = Step::findOrFail($step_id);
        return view('steps.edit', compact('step'));
    }

    public function update(Request $request, $step_id)
    {
        $step = Step::findOrFail($step_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'criteria' => 'required|string',
            'points' => 'required|integer|min:0',
        ]);

        $step->update([
            'name' => $request->name,
            'criteria' => $request->criteria,
            'points' => $request->points,
        ]);

        return redirect()->route('elements.index')->with('success', 'Step updated successfully.');
    }

    public function destroy($step_id)
    {
        $step = Step::findOrFail($step_id);
        $step->delete();

        return redirect()->route('elements.index')->with('success', 'Step deleted successfully.');
    }
}
