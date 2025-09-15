<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\DocumentController;
use App\Http\Controllers\Web\AssemblyController;
use App\Http\Controllers\Web\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('members', MemberController::class)->middleware('auth');
    Route::resource('documents', DocumentController::class)->middleware('auth');
    Route::post('documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::get('assemblies/dashboard', [AssemblyController::class, 'dashboard'])->name('assemblies.dashboard')->middleware('auth');
    Route::resource('assemblies', AssemblyController::class)->middleware('auth');
    Route::resource('tasks', TaskController::class)->only(['store', 'edit', 'update', 'destroy'])->middleware('auth');
    Route::resource('committees', \App\Http\Controllers\Web\CommitteeController::class)->middleware('auth');
    Route::resource('projects', \App\Http\Controllers\Web\ProjectController::class)->middleware('auth');
});
