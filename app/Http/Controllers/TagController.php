<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        return view('admin.tag.tag', compact('data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name', // Unique validation
            'image' => 'nullable|image', // Handle image validation
            'status' => 'required'
        ]);

        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->image = $request->file('image') ? $request->file('image')->store('images/tag', 'public') : null; // Handle image upload
        $tag->status = $request->input('status');

        if ($tag->save()) {
            return redirect()->route('tag.index')->with('success', 'Tag Created!');
        } else {
            return redirect()
                ->route('tag.add');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('admin.tag.add');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=tag::find($id);
        return view('admin.tag.update',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,' . $request->id, // Ignore the current record when validating for uniqueness
            'image' => 'nullable|image', // Validate image upload
            'status' => 'required' // Validate status
        ]);

        // Prepare data to update
        $data = [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'image' => $request->file('image') ? $request->file('image')->store('images/tag', 'public') : null
        ];

        // Update category record
        $updated = Tag::where('id', $request->id)->update($data);

        if ($updated) {
            // If the update was successful, redirect with success message
            return redirect()->route('tag.index')->with('success', 'Tag Updated!');
        } else {
            // If update fails (e.g., no changes), load the edit form again with the existing category data
            $data = Tag::find($request->id); // Retrieve the existing category to show in the form
            return view('admin.tag.update', compact('data')); // Return to the update view with the existing data
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        Tag::where('id', $id)
            ->update(['is_deleted' => 'yes']);

        return redirect()->route('tag.index')->with('success', 'Tag Deleted !');
    }
}
