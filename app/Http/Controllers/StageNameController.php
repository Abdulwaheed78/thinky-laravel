<?php

namespace App\Http\Controllers;

use App\Models\StageName;
use Illuminate\Http\Request;

class StageNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StageName::where('is_deleted', 'no')->orderby('id', 'desc')->get();
        return view('admin.stagename.stagename', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stage_names,name',
            'status' => 'required'
        ]);

        $stagename = new StageName();
        $stagename->name = $request->name;
        $stagename->status = $request->status;

        if ($stagename->save()) {
            return redirect()->route('stagename.index')->with('success', 'Stage Name Created !');
        } else {
            return view('admin.stagename.add');
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
        return view('admin.stagename.add');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = StageName::find($id);
        return view('admin.stagename.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:stage_names,name',
            'status' => 'required'
        ]);
        if(StageName::where('id', $id)->update(['name' => $request->name, 'status' => $request->status])){
            return redirect()->route('stagename.index')->with('status','Record Updated !');

        }else{
            $data=StageName::find($id);
            return view('admin.stagename.update',compact('data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        StageName::where('id', $id)->update(['is_deleted' => 'yes']);
        return redirect()->route('stagename.index')->with('success', 'Stage Name Deleted !');
    }
}
