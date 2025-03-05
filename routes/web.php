<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dash',function(){return view('dashboard');})->name('dashboard');

Route::get('/users/create',function(){return view('users.create');})->name('users.create');

Route::get('/profile',function(){return view('users.profile');})->name('users.profile');

Route::get('/tags/index',function(){return view('tags.index');})->name('tags.index');

Route::get('/tags/create',function(){return view('tags.create');})->name('tags.create');



require __DIR__.'/auth.php';
