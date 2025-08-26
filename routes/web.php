<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    //school
    Route::get('/school', [SchoolController::class, 'index'])->name('school.index');
    Route::get('/school/create',[SchoolController::class,'create'])->name('school.create');
    Route::post('/school',[SchoolController::class,'store'])->name('school.store');
    Route::get('/school/{school}/edit',[SchoolController::class,'edit'])->name('school.edit');
    Route::put('/school/{school}',[SchoolController::class,'update'])->name('school.update');
    Route::delete('/school/{school}',[SchoolController::class,'destroy'])->name('school.destroy');

    //accademic year
    Route::get('/academic',[AcademicController::class,'index'])->name('academic.index');
    Route::get('/academic/create',[AcademicController::class,'create'])->name('academic.create');
    Route::post('/academic',[AcademicController::class,'store'])->name('academic.store');
    Route::get('/academic/{academic}/edit',[AcademicController::class,'edit'])->name('academic.edit');
    Route::put('/academic/{academic}',[AcademicController::class,'update'])->name('academic.update');
    Route::delete('/academic/{academic}',[AcademicController::class,'destroy'])->name('academic.delete');

    //teacher
    Route::get('/teacher',[TeacherController::class,'index'])->name('teacher.index');
    Route::get('/teacher/create',[TeacherController::class,'create'])->name('teacher.create');
    Route::post('teacher/store',[TeacherController::class,'store'])->name('teacher.store');
    Route::get('teacher/{id}/edit',[TeacherController::class,'edit'])->name('teacher.edit');
    Route::put('teacher/{id}',[TeacherController::class,'update'])->name('teacher.update');
    Route::delete('teacher/{id}',[TeacherController::class,'destroy'])->name('teacher.delete');

    //class
    Route::get('/class',[ClassController::class,'index'])->name('class.index');
    Route::get('/class/create',[ClassController::class,'create'])->name('class.create');
    Route::post('/class',[ClassController::class,'store'])->name('class.store');
    Route::get('/class/{id}/edit',[ClassController::class,'edit'])->name('class.edit');
    Route::put('/class/{id}',[ClassController::class,'update'])->name('class.update');
    Route::delete('class/{id}',[ClassController::class,'destroy'])->name('class.destroy');

    //section
    Route::get('/sections',[SectionController::class,'index'])->name('section.index');
    Route::get('/sections/create',[SectionController::class,'create'])->name('section.create');
    Route::post('/sections',[SectionController::class,'store'])->name('section.store');
    Route::get('/sections/{id}/edit',[SectionController::class,'edit'])->name('section.edit');
    Route::put('/sections/{id}',[SectionController::class,'update'])->name('section.update');
    Route::delete('/sections/{id}',[SectionController::class,'destroy'])->name('section.destroy');

    //student
     Route::get('/students',[StudentController::class,'index'])->name('student.index');
    Route::get('/students/create',[StudentController::class,'create'])->name('student.create');
    Route::post('/students',[StudentController::class,'store'])->name('student.store');
    Route::get('/students/{id}/edit',[StudentController::class,'edit'])->name('student.edit');
    Route::put('/students/{id}',[StudentController::class,'update'])->name('student.update');
    Route::delete('/students/{id}',[StudentController::class,'destroy'])->name('student.destroy');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';



