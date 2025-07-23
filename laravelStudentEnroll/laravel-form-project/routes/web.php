<?php

use App\Http\Controllers\StudentEnrollmentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('enrollments.index');
});

Route::get('/enrollments', [StudentEnrollmentController::class, 'index'])->name('enrollments.index');
Route::get('/enrollments/create', [StudentEnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments', [StudentEnrollmentController::class, 'store'])->name('enrollments.store');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
