<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Clas;
use App\Models\Section;

class SectionController extends Controller
{
    public function index(){
        // $sections = Section::with('clas:id,clas_name')->get();
$sections = Section::with('clas:id,clas_name')->get();


        // dd($sections);
      return Inertia::render('section/index',[
        'sections' => $sections
      ]);
    }

    public function create(){

        $clas = Clas::all(['id','clas_name']);
        return Inertia::render('section/create',[
            'clas' => $clas
        ]);

    }
    public function store(Request $request){

    // dd($request->all());
        $validate = $request->validate([
          'class_id' => 'required|exists:clas,id',
          'section_name' => 'required|string',
          'max_students' => 'required|numeric|min:0',
            ]);
            Section::create($validate);
            return redirect()->route('section.index')->with('message','section created successfully');
       } 

      public function edit($id){
        $section = Section::findOrFail($id);
        $clas =Clas::all(['id','clas_name']);
        return Inertia::render('section/create',[
            'section' => $section,
            'clas' => $clas
        ]);
      } 

      public function update(Request $request,$id){

         $validate = $request->validate([
          'class_id' => 'required|exists:clas,id',
          'section_name' => 'required|string',
          'max_students' => 'required|numeric|min:0',
            ]);
           $section = Section::findOrFail($id);
           $section->update($validate);
            return redirect()->route('section.index')->with('message','section updated successfully');

      }

      public function destroy($id){
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('section.index')->with('message','section deleted successfully');
      }
}
