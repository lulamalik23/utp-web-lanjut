<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\StudentController;
use App\Http\controllers\TeacherController;
use App\Http\controllers\CourseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::resource('/students', StudentController::class);

Route::resource('/teachers', TeacherController::class);


Route::resource('/courses', CourseController::class);
