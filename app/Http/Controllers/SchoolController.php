<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools=School::all();
        return inertia::render('school/index',[
            'schools'=>$schools
        ]);
    }
    public function create()
    {
        return inertia::render('school/create');
    }
    public function store(Request $request){
    //  dd($request->all());
     $validate = $request->validate([
        'name' => 'required|string',
        'medium' => 'required|in:english,tamil',
        'board' => 'required|string',
        'address' => 'required|string',
        'rating' => 'nullable|numeric|between:1,5|decimal:0,5'
     ]);
     School::create($validate);
    //  dd($validate);
     return redirect()->route('school.index')->with('message','School created successfully');
    }

    public function edit(School $school){
        // dd($school);
        return inertia::render('school/edit',[
            'school'=>$school
        ]);
    }
    public function update(Request $request, School $school)
    {
        // dd($request->all());
        $validate=$request->validate([
            'name' => 'required|string',
            'medium' => 'required|string',
            'board' => 'required|string',
            'address' =>'required|string',
            'rating' => 'required|numeric|between:1,5|decimal:0,2'
        ]);
          $school->update($validate);
        return redirect()->route('school.index')->with('message','school updated successfully');
    }

    public function destroy(School $school){
        //   dd($school);
        $school->delete();
        return redirect()->route('school.index')->with('message','school deleted successfully');
    }

}
