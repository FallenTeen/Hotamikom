<?php

use Livewire\livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::view('/', 'welcome')->name('/');

//ADMIN ROUTE ONLY
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::get('/managekamar', \App\Livewire\Pages\Admin\KamarIndex::class)->name('managekamar');
    Route::get('/createkamar', \App\Livewire\Pages\Admin\KamarCreate::class)->name('createkamar');
    Route::get('/editkamar/{id}', \App\Livewire\Pages\Admin\KamarEdit::class)->name('editkamar');

    Route::view('/reservasi', 'livewire.pages.admin.managereservasi')->name('reservasi');
    Route::view('/layanan', 'livewire.pages.admin.layanan')->name('layanan');
    Route::view('/pembayaran', 'livewire.pages.admin.managepembayaran')->name('pembayaran');

    Route::view('/review', 'livewire.pages.admin.review')->name('review');
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

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('/');
})->name('logout');

require __DIR__ . '/auth.php';
