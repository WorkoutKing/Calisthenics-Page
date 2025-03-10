<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Element;
use App\Models\Result;
use App\Models\Exercise;

class StepController extends Controller
{
    public function uploadResult($step_id)
    {
        $step = Step::findOrFail($step_id);
        $element = $step->element;

        $previousSteps = $element->steps()->where('id', '<', $step_id)->get();

        foreach ($previousSteps as $previousStep) {
            $previousResult = $previousStep->results()->where('user_id', auth()->id())->first();

            if (!$previousResult || !$previousResult->approved) {
                return redirect()->route('elements.index')->with('info', 'You must have all previous steps approved before uploading for this one.');
            }
        }

        $result = Result::where('user_id', auth()->id())->where('step_id', $step_id)->first();

        if ($result) {
            $message = $result->approved
                ? 'Your result has already been approved for this step.'
                : 'Your result is awaiting approval.';
            return redirect()->route('elements.index')->with('error', $message);
        }

        return view('steps.upload_result', compact('step'));
    }

    public function storeResult(Request $request, $step_id)
    {
        $request->validate([
            'video_url' => 'url',
            'reps_time' => 'integer',
        ]);

        $existingResult = Result::where('user_id', auth()->id())
            ->where('step_id', $step_id)
            ->first();

        if ($existingResult) {
            return redirect()->route('elements.index')->with('info', 'Slow down! Spamming uploads is not allowed.');
        }

        Result::create([
            'user_id' => auth()->id(),
            'step_id' => $step_id,
            'video_url' => $request->video_url,
            'reps_time' => $request->reps_time,
        ]);

        return redirect()->route('elements.index')->with('success', 'Your result has been uploaded.');
    }

    public function create($element_id)
    {
        $exercises = Exercise::orderBy('title', 'asc')->get();
        $element = Element::findOrFail($element_id);
        return view('steps.create', compact('element', 'exercises'));
    }

    public function store(Request $request, $element_id)
    {
        $element = Element::findOrFail($element_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'criteria' => 'required|string',
            'points' => 'required|integer|min:0',
            'exercise_id' => 'nullable|exists:exercises,id'  // Added validation for exercise_id
        ]);

        Step::create([
            'element_id' => $element->id,
            'name' => $request->name,
            'criteria' => $request->criteria,
            'points' => $request->points,
            'exercise_id' => $request->exercise_id  // Save selected exercise
        ]);
        return redirect()->back()->with('success', 'Step added successfully.');
    }

    public function edit($step_id)
    {
        $exercises = Exercise::orderBy('title', 'asc')->get();
        $step = Step::findOrFail($step_id);
        return view('steps.edit', compact('step', 'exercises'));
    }

    public function update(Request $request, $step_id)
    {
        $step = Step::findOrFail($step_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'criteria' => 'required|string',
            'points' => 'required|integer|min:0',
            'exercise_id' => 'nullable|exists:exercises,id',  // Added validation for exercise_id
        ]);

        $step->update([
            'name' => $request->name,
            'criteria' => $request->criteria,
            'points' => $request->points,
            'exercise_id' => $request->exercise_id, // Save selected exercise
        ]);

        return redirect()->route('elements.index')->with('success', 'Step updated successfully.');
    }

    public function destroy($step_id)
    {
        $step = Step::findOrFail($step_id);
        $step->delete();

        return redirect()->route('elements.index')->with('success', 'Step deleted successfully.');
    }

    public function destroyResult($step_id)
    {
        $step = Step::findOrFail($step_id);

        $result = Result::where('user_id', auth()->id())
            ->where('step_id', $step_id)
            ->first();

        if ($result && $result->approved) {
            $result->delete();
            return redirect()->route('elements.index')->with('success', 'Your result has been deleted.');
        } else {
            return redirect()->route('elements.index')->with('error', 'You can only delete results that are approved.');
        }
    }
}
