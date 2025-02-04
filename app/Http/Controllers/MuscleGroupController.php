<?php

namespace App\Http\Controllers;

use App\Models\MuscleGroup;
use Illuminate\Http\Request;

class MuscleGroupController extends Controller
{

    // Display all muscle groups
    public function index()
    {
        $muscleGroups = MuscleGroup::all();
        return view('admin.muscle_groups.index', compact('muscleGroups'));
    }

    // Show the form for creating a new muscle group
    public function create()
    {
        return view('admin.muscle_groups.create');
    }

    // Store a newly created muscle group
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:muscle_groups,name|max:255',
        ]);

        MuscleGroup::create($request->all());

        return redirect()->route('admin.muscle_groups.index')->with('success', 'Muscle group created successfully.');
    }

    // Show the form for editing a muscle group
    public function edit(MuscleGroup $muscleGroup)
    {
        return view('admin.muscle_groups.edit', compact('muscleGroup'));
    }

    // Update the specified muscle group
    public function update(Request $request, MuscleGroup $muscleGroup)
    {
        $request->validate([
            'name' => 'required|unique:muscle_groups,name,' . $muscleGroup->id . '|max:255',
        ]);

        $muscleGroup->update($request->all());

        return redirect()->route('admin.muscle_groups.index')->with('success', 'Muscle group updated successfully.');
    }

    // Delete the specified muscle group
    public function destroy(MuscleGroup $muscleGroup)
    {
        $muscleGroup->delete();
        return redirect()->route('admin.muscle_groups.index')->with('success', 'Muscle group deleted successfully.');
    }
}
