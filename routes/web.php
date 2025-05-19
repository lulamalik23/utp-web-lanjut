<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\StudentController;
use App\Http\controllers\TeacherController;
use App\Http\controllers\CourseController;
use App\Http\controllers\BatchController;
use App\Http\controllers\EnrollmentController;
use App\Http\controllers\PaymentController;
use App\Http\controllers\ReportController;
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

Route::resource('/batches', BatchController::class);

Route::resource('/enrollments', EnrollmentController::class);

Route::resource('/payments', PaymentController::class);

 Route::get('report/report1/{pid}', [ReportController::class, 'report1']);

Route::get('/report/report/{id}', [ReportController::class, 'show'])->name('report.print');

Route::get('/report/{id}', [ReportController::class, 'report'])->name('report.pdf');



 