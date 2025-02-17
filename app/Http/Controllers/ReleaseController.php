<?php
namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Http\Request;

class ReleaseController extends Controller
{
    public function index()
    {
        $releases = Release::orderBy('release_date', 'desc')->get();
        return view('releases.index', compact('releases'));
    }

    public function create()
    {
        return view('releases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        Release::create($request->all());
        return redirect()->route('releases.index')->with('success', 'Release created successfully!');
    }

    public function show(Release $release)
    {
        return view('releases.show', compact('release'));
    }

    public function edit(Release $release)
    {
        return view('releases.edit', compact('release'));
    }

    public function update(Request $request, Release $release)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $release->update($request->all());
        return redirect()->route('releases.index')->with('success', 'Release updated successfully!');
    }

    public function destroy(Release $release)
    {
        $release->delete();
        return redirect()->route('releases.index')->with('success', 'Release deleted successfully!');
    }
}
