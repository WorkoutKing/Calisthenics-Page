<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $exercises = Exercise::query();

        if ($search) {
            $exercises->where('title', 'like', '%' . $search . '%');

            $exercises->orWhereHas('primaryMuscleGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

            $exercises->orWhereHas('secondaryMuscleGroups', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $exercises = $exercises->orderBy('title')->paginate(15);

        return view('admin.exercises.index', compact('exercises'));
    }

    public function publicIndex(Request $request)
    {
        $search = $request->input('search');

        $exercises = Exercise::query();

        if ($search) {
            $exercises->where('title', 'like', '%' . $search . '%');

            $exercises->orWhereHas('primaryMuscleGroup', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

            $exercises->orWhereHas('secondaryMuscleGroups', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $exercises = $exercises->orderBy('title')->paginate(15);

        return view('exercises.index', compact('exercises'));
    }



    public function create()
    {
        $muscleGroups = MuscleGroup::orderBy('title', 'asc')->get();
        return view('admin.exercises.create', compact('muscleGroups'));
    }

    public function store(Request $request)
    {
        // Validation for description (ensuring it is present but allowing HTML)
        $request->validate([
            'title' => 'required|unique:exercises|max:255',
            'description' => 'required|string|min:5', // Enforcing min length to ensure meaningful content
            'primary_muscle_group_id' => 'required|exists:muscle_groups,id',
            'secondary_muscle_groups' => 'nullable|array',
            'secondary_muscle_groups.*' => 'exists:muscle_groups,id',
            'main_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        // Store the exercise data excluding 'main_picture' and 'secondary_muscle_groups'
        $exercise = new Exercise($request->except('main_picture', 'secondary_muscle_groups'));

        // Handle file upload for main_picture
        if ($request->hasFile('main_picture')) {
            $exercise->main_picture = $request->file('main_picture')->store('exercisePicture', 'public');
        }

        // Save the exercise and associate the primary muscle group
        $exercise->save();
        $exercise->primaryMuscleGroup()->associate($request->primary_muscle_group_id);
        $exercise->save();

        // Sync secondary muscle groups (if provided)
        if ($request->has('secondary_muscle_groups')) {
            $exercise->secondaryMuscleGroups()->sync($request->secondary_muscle_groups);
        }

        return redirect()->route('admin.exercises.index')->with('success', 'Exercise added successfully');
    }


    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show', compact('exercise'));
    }

    public function publicShow(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }

    public function edit(Exercise $exercise)
    {
        $muscleGroups = MuscleGroup::orderBy('title', 'asc')->get();
        return view('admin.exercises.edit', compact('exercise', 'muscleGroups'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'title' => "required|max:255|unique:exercises,title,{$exercise->id}",
            'description' => 'required|string|min:5',
            'primary_muscle_group_id' => 'required|exists:muscle_groups,id',
            'secondary_muscle_groups' => 'nullable|array',
            'secondary_muscle_groups.*' => 'exists:muscle_groups,id',
            'main_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);

        $exercise->fill($request->except('main_picture', 'secondary_muscle_groups'));

        if ($request->hasFile('main_picture')) {
            if ($exercise->main_picture) {
                Storage::disk('public')->delete($exercise->main_picture);
            }
            $exercise->main_picture = $request->file('main_picture')->store('exercisePicture', 'public');
        }

        $exercise->save();
        $exercise->primaryMuscleGroup()->associate($request->primary_muscle_group_id);
        $exercise->save();

        if ($request->has('secondary_muscle_groups')) {
            $exercise->secondaryMuscleGroups()->sync($request->secondary_muscle_groups);
        }

        return redirect()->route('admin.exercises.index')->with('success', 'Exercise updated successfully');
    }

    public function destroy(Exercise $exercise)
    {
        if ($exercise->main_picture) {
            Storage::disk('public')->delete($exercise->main_picture);
        }

        $exercise->delete();
        return redirect()->route('admin.exercises.index')->with('success', 'Exercise deleted successfully');
    }
}
