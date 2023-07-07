<?php

use App\Http\Controllers\Admin\ClassroomController as AdminClassroomController;
use App\Http\Controllers\Admin\GradeController as AdminGradeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Teacher\GradeController as TeacherGradeController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ClassroomController::class, 'index']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::middleware('auth')->group(function () {
    Route::resource('basic', BasicController::class);
    Route::resource('class', ClassroomController::class)->parameters(['class' => 'classroom']);

    // WIP
    Route::view('schedule', 'blank', ['title' => 'Schedule'])->name('schedule.index');
    Route::view('grade', 'blank', ['title' => 'Grade'])->name('grade.index');
    Route::view('assignment', 'blank', ['title' => 'Assignment'])->name('assignment.index');
    Route::view('forum', 'blank', ['title' => 'Forum'])->name('forum.index');

    // Admin
    Route::as('admin.')->prefix('admin')->group(function () {
        Route::resource('class', AdminClassroomController::class)->parameters(['class' => 'classroom']);
        Route::resource('grades', AdminGradeController::class);

        // WIP
        Route::view('schedule', 'blank', ['title' => 'Schedule'])->name('schedule.index');
        Route::view('assignment', 'blank', ['title' => 'Assignment'])->name('assignment.index');
        Route::view('forum', 'blank', ['title' => 'Forum'])->name('forum.index');
    });

    // Teacher
    Route::as('teacher.')->prefix('teacher')->group(function () {
        Route::resource('grades', TeacherGradeController::class);

        // WIP
        Route::view('schedule', 'blank', ['title' => 'Schedule'])->name('schedule.index');
        Route::view('class', 'blank', ['title' => 'Class'])->name('class.index');
        Route::view('assignment', 'blank', ['title' => 'Assignment'])->name('assignment.index');
        Route::view('forum', 'blank', ['title' => 'Forum'])->name('forum.index');
    });

    // Student
    Route::as('student.')->prefix('student')->group(function () {
        Route::resource('grades', StudentGradeController::class)->only('index');

        // WIP
        Route::view('schedule', 'blank', ['title' => 'Schedule'])->name('schedule.index');
        Route::view('class', 'blank', ['title' => 'Class'])->name('class.index');
        Route::view('assignment', 'blank', ['title' => 'Assignment'])->name('assignment.index');
        Route::view('forum', 'blank', ['title' => 'Forum'])->name('forum.index');
    });
});

Route::fallback(function () {
    return to_route('home')->with('error', 'Not found');
});
