<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Clas;
use App\Models\Teacher;
use App\Models\Academic;

class ClassController extends Controller
{
    public function index(){
        $classes = Clas::with(['academic','teacher.user'])->get();
        // dd($classes);
        return Inertia::render('class/index',[
            'classes' =>$classes
        ]);
    }
    public function create(){
        $teachers = Teacher::with('user:id,name')->get();
        $academics = Academic::all('id','year_name');
        return Inertia::render('class/create',[
          'teachers' => $teachers,
          'academics' => $academics

]);
    }
    
    public function store(Request $request){

        // dd($request->all());
        $validate = $request->validate([
          'academic_id' => 'required|exists:academics,id',
          'teacher_id' => 'required|exists:teachers,id',
          'clas_name' => 'required|string',
          'clas_code' => 'required|string',
          'max_students' => 'required|numeric|min:0',
          'status' => 'required|in:active,inactive',
        ]);

        Clas::create($validate);
      return redirect()->route('class.index')->with('message', 'Class created successfully');

    }

    public function edit($id){
        $clas = Clas::findOrFail($id);
        $academics = Academic::all(['id','year_name']);
        $teachers = Teacher::with(['user'])->get();
        return Inertia::render('class/create',[
            'clas' => $clas,
            'academics' => $academics,
            'teachers' => $teachers

        ]);
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            'academic_id' => 'required|exists:academics,id',
            'teacher_id' => 'required|exists:teachers,id',
            'clas_name' => 'required|string',
            'clas_code' => 'required|string',
            'max_students' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $clas = Clas::findOrFail($id);
        $clas->update($validate);
        return redirect()->route('class.index')->with('message', 'Class updated successfully');

    }

    public function destroy($id){

        $clas = Clas::findOrFail($id);
        $clas->delete();
        return redirect()->route('class.index')->with('message','class deleted successfully');

    }

}
