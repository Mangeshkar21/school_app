<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Academic;

class AcademicController extends Controller
{
    public function index(){
          $academics = Academic::all();
         return Inertia::render('academic/index',[
            'academics'=>$academics
         ]);
    }
    public function create(){
        return Inertia::render('academic/create');
    }
    public function store(Request $request){
        //  dd($request->all());
         $validate = $request->validate([
          'year_name' => 'required|string',
          'start_date' => 'required|date',
          'end_date' => 'required|date',
          'status' => 'required|string'
         ]);
      
      Academic::create($validate);
      return redirect()->route('academic.index')->with('message','accademic created successfully') ;

    }

    public function edit(Academic $academic)
{
    return Inertia::render('academic/create', [
        'academic' => $academic
    ]);
}
    public function update(Request $request, Academic $academic ){
        $validate = $request->validate([
           'year_name' => 'required|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date',
           'status' => 'required|string',
        ]);
    
      $updated =  $academic->update($validate);
    //   dd($updated);
        return redirect()->route('academic.index')->with('message','Academic Year Updated Successfully');
    }

    public function destroy(Academic $academic)
    {
        $academic->delete();
        return redirect()->route('academic.index')->with('message', 'Academic Year deleted successfully');
    }
}
