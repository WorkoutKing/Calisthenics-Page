<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $workouts = Workout::query();

        if ($search) {
            $workouts = $workouts->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $workouts = $workouts->paginate(9);

        return view('workouts.index', compact('workouts', 'search'));
    }



    public function myWorkouts()
    {
        $workouts = Workout::where('user_id', auth()->id())->paginate(6);

        return view('workouts.my', compact('workouts'));
    }

    public function create()
    {
        $workoutCount = Workout::where('user_id', auth()->id())->count();
        if (auth()->user()->role_id != 2 && $workoutCount >= 5) {
            return redirect()->route('workouts.index')->with('warning', 'You can only create up to 5 workouts.');
        }
        $exercises = Exercise::orderBy('title', 'asc')->get();

        return view('workouts.create', compact('exercises'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'workout_type' => 'required|string|max:255',
            'description' => 'required|string',
            'focus' => 'nullable|string|max:255',
            'exercises' => 'required|array|min:1',
            'exercises.*.id' => 'required|exists:exercises,id',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
            'exercises.*.rest_time' => 'required|integer|min:1',
            'exercises.*.note' => 'nullable|string|max:255',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        if (auth()->user()->role_id != 2) {
            $workoutCount = Workout::where('user_id', auth()->id())->count();
            if ($workoutCount >= 5) {
                return redirect()->route('workouts.index')
                    ->with('warning', 'You have reached the limit of 3 workouts.');
            }
        }

        $workout = Workout::create([
            'title' => $request->title,
            'workout_type' => $request->workout_type,
            'description' => $request->description,
            'focus' => $request->focus,
            'user_id' => auth()->id(),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
        ]);

        foreach ($request->exercises as $exerciseData) {
            $workout->exercises()->attach($exerciseData['id'], [
                'sets' => $exerciseData['sets'],
                'reps' => $exerciseData['reps'],
                'rest_time' => $exerciseData['rest_time'],
                'note' => $exerciseData['note'],
            ]);
        }

        return redirect()->route('workouts.index')->with('success', 'Workout created successfully.');
    }

    public function show($id)
    {
        $workout = Workout::with([
            'exercises.primaryMuscleGroup' => function ($query) {
                $query->select('id', 'name');
            }
        ])->findOrFail($id);

        return view('workouts.show', compact('workout'));
    }

    public function edit($id)
    {
        $workout = Workout::findOrFail($id);

        if (auth()->user()->role_id != 2 && $workout->user_id !== auth()->id()) {
            return redirect()->route('workouts.index')->with('error', 'You are not authorized to edit this workout.');
        }

        $exercises = Exercise::orderBy('title', 'asc')->get();

        $workoutExercises = $workout->exercises->map(function ($exercise) {
            return [
                'id' => $exercise->id,
                'title' => $exercise->title,
                'sets' => $exercise->pivot->sets,
                'reps' => $exercise->pivot->reps,
                'rest_time' => $exercise->pivot->rest_time,
                'note' => $exercise->pivot->note,
            ];
        });

        return view('workouts.edit', compact('workout', 'exercises', 'workoutExercises'));
    }

    public function update(Request $request, $id)
    {
        $workout = Workout::findOrFail($id);

        if (auth()->user()->role_id != 2 && $workout->user_id !== auth()->id()) {
            return redirect()->route('workouts.index')->with('error', 'You are not authorized to update this workout.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'workout_type' => 'required|string|max:255',
            'description' => 'required|string',
            'focus' => 'nullable|string|max:255',
            'exercises.*.id' => 'required|exists:exercises,id',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
            'exercises.*.rest_time' => 'required|integer|min:1',
            'exercises.*.note' => 'nullable|string|max:255',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        $workout->update([
            'title' => $request->title,
            'workout_type' => $request->workout_type,
            'description' => $request->description,
            'focus' => $request->focus,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
        ]);

        $workout->exercises()->sync([]);
        foreach ($request->exercises as $exerciseData) {
            $workout->exercises()->attach($exerciseData['id'], [
                'sets' => $exerciseData['sets'],
                'reps' => $exerciseData['reps'],
                'rest_time' => $exerciseData['rest_time'],
                'note' => $exerciseData['note'],
            ]);
        }

        return redirect()->route('workouts.index')->with('success', 'Workout updated successfully.');
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index')->with('success', 'Workout deleted successfully!');
    }
}
