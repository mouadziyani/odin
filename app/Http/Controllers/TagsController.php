<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tags::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tags $tags)
    {
        return view('tags.show', compact('tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tags $tags)
    {
        return view('tags.edit', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tags $tags)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tags->id,
        ]);

        $tags->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tags updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tags $tags)
    {
        $tag->delete();

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag deleted successfully.');
    }

    /**
     * Remove all tags.
     */
    public function delete_all()
    {
        Tag::truncate(); // delete all rows
        return redirect()
            ->route('tags.index')
            ->with('success', 'All tags deleted successfully.');
    }
}
