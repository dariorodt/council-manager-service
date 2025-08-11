<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\DocumentController;
use App\Http\Controllers\Web\AssemblyController;

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
    Route::resource('assemblies', AssemblyController::class)->middleware('auth');
});
