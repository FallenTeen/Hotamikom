<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

//ADMIN ROUTE ONLY
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('profile', 'profile')->name('profile');
});


//USER ROUTE ONLY
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::view('profile', 'profile')->name('profile');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return view('livewire.pages.admin.dashboard');
        }
        if (Auth::user()->role == 'user') {
            return view('livewire.pages.user.dashboard');
        }
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
