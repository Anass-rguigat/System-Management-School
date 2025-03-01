<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();
Route::middleware(['admin'])->group(function () {
    Route::get('admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('admin/create', [App\Http\Controllers\Admin\HomeController::class, 'create'])->name('admin.create');
});

Route::middleware(['teacher'])->group(function () {
    Route::get('teacher/home', [App\Http\Controllers\Teacher\HomeController::class, 'index'])->name('teacher.home');
    Route::get('teacher/create', [App\Http\Controllers\Teacher\HomeController::class, 'create'])->name('teacher.create');
});

Route::middleware(['student'])->group(function () {
    Route::get('student/home', [App\Http\Controllers\Student\HomeController::class, 'index'])->name('student.home');
    Route::get('student/create', [App\Http\Controllers\Student\HomeController::class, 'create'])->name('student.create');
});
