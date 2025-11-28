<?php

use App\Http\Controllers\admin\collegeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\gradeController;
use App\Http\Controllers\admin\subjectController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\home\homeController;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::get('/users', [userController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [userController::class, 'create'])->name('admin.users.create');
    Route::post('/users/create/store', [userController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [userController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [userController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{user}/edit/update', [userController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}/delete', [userController::class, 'destroy'])->name('admin.users.delete');

    Route::get('/subjects', [subjectController::class, 'index'])->name('admin.subjects');
    Route::get('/subjects/create', [subjectController::class, 'create'])->name('admin.subjects.create');
    Route::post('/subjects/create/store', [subjectController::class, 'store'])->name('admin.subjects.store');
    Route::get('/subjects/{subject}', [subjectController::class, 'show'])->name('admin.subjects.show');
    Route::get('/subjects/{subject}/edit', [subjectController::class, 'edit'])->name('admin.subjects.edit');
    Route::post('/subjects/{subject}/edit/update', [subjectController::class, 'update'])->name('admin.subjects.update');
    Route::delete('/subjects/{subject}/delete', [subjectController::class, 'destroy'])->name('admin.subjects.delete');


    Route::get('/grades', [gradeController::class, 'index'])->name('admin.grades');
    Route::get('/grades/create', [gradeController::class, 'create'])->name('admin.grades.create');
    Route::post('/grades/create/store', [gradeController::class, 'store'])->name('admin.grades.store');
    Route::get('/grades/{grade}', [gradeController::class, 'show'])->name('admin.grades.show');
    Route::get('/grades/{grade}/edit', [gradeController::class, 'edit'])->name('admin.grades.edit');
    Route::post('/grades/{grade}/edit/update', [gradeController::class, 'update'])->name('admin.grades.update');
    Route::delete('/grades/{grade}/delete', [gradeController::class, 'destroy'])->name('admin.grades.delete');
});

// admin - subAdmin - student