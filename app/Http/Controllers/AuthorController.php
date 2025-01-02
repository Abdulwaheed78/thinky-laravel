<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Author::where('is_deleted', 'no')->orderby('id', 'desc')->get();
        return view('admin.author.author', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:authors,email',
            'phone' => 'nullable|numeric|digits:10',
            'image' => 'nullable',
            'status' => 'required',
            'nickname' => 'nullable|string',
            'detail' => 'nullable'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->status = $request->status;
        $author->nickname = $request->nickname;
        $author->detail = $request->detail;
        $author->image = $request->image ?  $request->image->store('images/author', 'public') : null; // Handle image upload
        if ($author->save()) {
            return redirect()->route('author.index')->with('success', 'Author Created !');
        } else {
            return view('admin.author.add');
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
        return view('admin.author.add');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Author::find($id);
        return view('admin.author.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:authors,email,' . $id, // Ignore current author's email during validation
            'phone' => 'nullable|numeric|digits:10',
            'status' => 'required',
            'nickname' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional: add validation for image files
            'detail' => 'nullable',
        ]);

        // Find the author by ID
        $author = Author::findOrFail($id);

        // Update the author's attributes
        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->status = $request->status;
        $author->nickname = $request->nickname;
        $author->detail = $request->detail;

        if ($request->hasFile('image')) {
            $author->image = $request->file('image')->store('images/author','public');
        }

        if ($author->save()) {
            return redirect()->route('author.index')->with('success', 'Author updated !');
        } else {
            $data=Author::find($id);
            return view('admin.author.update',compact('data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        author::where('id',$id)->update(['is_deleted'=>'yes']);
        return redirect()->route('author.index')->with('success','Author Deleted !');
    }
}
