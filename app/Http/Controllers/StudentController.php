<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Academic;
use App\Models\Clas;
use App\Models\Section;
use App\Models\Student;
class StudentController extends Controller
{
    public function index(){

        $students = Student::with(['academic','user','section','clas'])->get();
        return Inertia::render('student/index',[
            'students' => $students
        ]);
    }

    public function create(){

        $users = User::where('role','student')->get(['id','name']);
         $academics = Academic::all('id','year_name');
        $classes = Clas::all('id','clas_name');
        $sections = Section::all('id','section_name');
        return Inertia::render('student/create',[
            'users' => $users,
            'academics' => $academics,
            'classes' => $classes,
            'sections' => $sections

        ]);
    }

    public function store(Request $request){
        // dd($request->all());
        $validate =  $request->validate([
           'user_id' => 'required|exists:users,id',
           'academic_id' => 'required|exists:academics,id',
           'clas_id' => 'required|exists:clas,id',
           'section_id' => 'required|exists:sections,id',
           'roll_number' => 'required|string|unique:students,roll_number',
           'admission_date' => 'required|date',
           'dob' => 'required|date',
           'gender' => 'required|in:male,female,other',
           'blood_group' => 'required|string',
           'address' => 'required|string',
           'parent_name'=> 'required|string',
           'parent_contact' => 'required|string',
           'status' => 'required|in:active,inactive,graduated,left'
        ]);

        Student::create($validate);
        return redirect()->route('student.index')->with('success','student created successfully');
    }

    public function edit($id){
        $student = Student::findOrFail($id);
        // dd($student);
        $academics=Academic::all('id','year_name');
        $clas = Clas::all('id','clas_name');
        $sections=Section::all('id','section_name');
        $users = User::where('role','student')->get();
        return Inertia::render('student/create',[
            'student' => $student,
            'users' => $users,
            'academics' => $academics,
            'sections' => $sections,
            'classes' => $clas,
        ]);
    }

    public function update(Request $request,$id){

        // dd($request->all());
        $validate = $request->validate([
           'user_id' => 'required|exists:users,id',
           'academic_id' => 'required|exists:academics,id',
           'clas_id' => 'required|exists:clas,id',
           'section_id' => 'required|exists:sections,id',
           'roll_number' => 'required|string',
           'admission_date' => 'required|date',
           'dob' => 'required|date',
           'gender' => 'required|in:male,female,other',
           'blood_group' => 'required|string',
           'address' => 'required|string',
           'parent_name'=> 'required|string',
           'parent_contact' => 'required|string',
           'status' => 'required|in:active,inactive,graduated,left'
        ]);

 $update = Student::findOrFail($id);
//  dd('$update');
 $update->update($validate);
        return redirect()->route('student.index')->with('message','Student updated successfully');
    }

    public function destroy($id){
        $student  = Student::findOrFail($id);
        $student->delete();
          return redirect()->route('student.index')->with('message','Student deleted successfully');
    }

}
