<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;


class TeacherController extends Controller
{
    public function index(){
 $teachers = Teacher::with('user')->get();
      // $users = User::where('role','teacher')->get(['id','name']);
      return Inertia::render('teacher/index',[
        'teachers' => $teachers,
        // 'users' => $users
      ]);
    }
    public function create(){
      $users = User::where('role', 'teacher')->get(['id', 'name']);
      return Inertia::render('teacher/create',[
        'users' => $users
      ]);
    }
    public function store(Request $request){
    // dd($request->all());
    $validated = $request->validate([
        'user_id'        => 'required|exists:users,id',
        'qualification'  => 'required|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'salary'         => 'required|numeric|min:0',
        'hire_date'      => 'required|date',
        'status'         => 'required|in:active,inactive',
    ]);
  //  dd($validated);
    $user = User::findOrFail($validated['user_id']);
    $user->role = 'teacher';
    $user->save();
      Teacher::create($validated);
      return redirect()->route('teacher.index')->with('message', 'teacher created successfully');

    }

    public function edit($id){
      $teacher = Teacher::findOrFail($id);
      $users = User::where('role','teacher')->get(['id','name']);
      return Inertia::render('teacher/create',[
          'teacher' => $teacher,
          'users' => $users
      ]);
    }

    public function update(Request $request,$id){
      $validated = $request->validate([
        'user_id'        => 'required|exists:users,id',
        'qualification'  => 'required|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'salary'         => 'required|numeric|min:0',
        'hire_date'      => 'required|date',
        'status'         => 'required|in:active,inactive',
      ]);
      $teacher = Teacher::findOrFail($id);
      $teacher->update($validated);
      return redirect()->route('teacher.index')->with('message','teacher updated successfully');
    }

    public function destroy($id){
      $teacher = Teacher::findOrFail($id);
      $teacher->delete();
      return redirect()->route('teacher.index')->with('message','teacher delete successfully');
    }
}
