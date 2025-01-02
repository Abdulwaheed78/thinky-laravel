<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::where('is_deleted', 'no')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.category.category', compact('data'));
    }
    public function show()
    {
        return view('admin.category.add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categorys,name',
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->image = $request->file('image') ? $request->file('image')->store('images/category', 'public') : null; // Handle image upload
        $category->status = $request->input('status');

        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Category Created!');
        } else {
            return redirect()
                ->route('category.add');
        }
    }



    public function edit(string $id)
    {
        $data = category::find($id);
        return view('admin.category.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:categorys,name,' . $request->id, // Ignore the current record when validating for uniqueness
            'image' => 'nullable|image', // Validate image upload
            'status' => 'required' // Validate status
        ]);

        // Prepare data to update
        $data = [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'image' => $request->file('image') ? $request->file('image')->store('images/category', 'public') : null
        ];

        // Update category record
        $updated = Category::where('id', $request->id)->update($data);

        if ($updated) {
            // If the update was successful, redirect with success message
            return redirect()->route('category.index')->with('success', 'Category Updated!');
        } else {
            // If update fails (e.g., no changes), load the edit form again with the existing category data
            $data = Category::find($request->id); // Retrieve the existing category to show in the form
            return view('admin.category.update', compact('data')); // Return to the update view with the existing data
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        Category::where('id', $id)
            ->update(['is_deleted' => 'yes']);

        return redirect()->route('category.index')->with('success', 'Category Deleted !');
    }
}
