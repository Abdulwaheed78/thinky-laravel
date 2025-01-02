<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Nature::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        return view('admin.nature.nature', compact('data'));
    }

    public function show()
    {
        return view('admin.nature.add');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:natures,name',
            'status' => 'required'
        ]);

        $nature = new Nature();
        $nature->name = $request->name;
        $nature->status = $request->status;

        if ($nature->save()) {
            return redirect()->route('nature.index')->with('success', 'Nature Created!');
        } else {
            return redirect()
                ->route('nature.add');
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Nature::find($id);
        return view('admin.nature.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|unique:natures,name,' . $id,  // Ignore the current record in the unique validation
            'status' => 'required'
        ]);

        // Prepare the data to update
        $data = [
            'name' => $request->name,
            'status' => $request->status
        ];

        // Update the nature record
        $updated = Nature::where('id', $id)->update($data);

        // Check if the update was successful
        if ($updated) {
            return redirect()->route('nature.index')->with('success', 'Nature Updated!');
        } else {
            return redirect()->route('nature.add')->with('error', 'Nature update failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        Nature::where('id', $id)->update(['is_deleted' => 'yes']);
        return redirect()->route('nature.index')->with('success', 'Nature Deleted !');
    }
}
