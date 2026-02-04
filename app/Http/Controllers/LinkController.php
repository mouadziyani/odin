<?php

namespace App\Http\Controllers;

use App\Models\link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::all();
        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        Link::create($request->only('title', 'url'));

        return redirect()->route('links.index')->with('success', 'Link created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(link $link)
    {
        return view('links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, link $link)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $link->update($request->only('title', 'url'));

        return redirect()->route('links.index')->with('success', 'Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(link $link)
    {
        $link->delete();
        return redirect()->route('links.index')
            ->with('success', 'Link deleted successfully.');
    }

    /**
     * Remove All links from storage.
     */
    public function delete_all()
    {
        link::truncate();
        return redirect()->route('link.index')->with('success', 'All links deleted successfully.');
    }
}
