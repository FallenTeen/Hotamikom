<?php

use Livewire\livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::view('/', 'index')->name('/');
Route::view('/index', 'index')->name('index');
Route::view('/room', 'kamar')->name('room');
Route::view('/reservation', 'reservasi')->name('res');

//ADMIN ROUTE ONLY
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/managekamar', \App\Livewire\Pages\Admin\KamarIndex::class)->name('managekamar');
    Route::get('/createkamar', \App\Livewire\Pages\Admin\KamarCreate::class)->name('createkamar');
    Route::get('/editkamar/{id}', \App\Livewire\Pages\Admin\KamarEdit::class)->name('editkamar');

    Route::get('/layanan', \App\Livewire\Pages\Admin\LayananIndex::class)->name('layanan');

    Route::get('/reservasi', \App\Livewire\Pages\Admin\ReservasiIndex::class)->name('reservasi');
    Route::get('/createreservasi', \App\Livewire\Pages\Admin\ReservasiCreate::class)->name('createreservasi');
    Route::get('/reservasi/edit/{id}', \App\Livewire\Pages\Admin\ReservasiEdit::class)->name('editreservasi');


    Route::get('/pembayaran', \App\Livewire\Pages\Admin\PembayaranIndex::class)->name('pembayaran');

    Route::get('/review', \App\Livewire\Pages\Admin\ReviewIndex::class)->name('review');
});


//USER ROUTE ONLY
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/allres', \App\Livewire\Pages\User\ReservasiIndex::class)->name('managereservasi');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('managekamar');
        }
        if (Auth::user()->role == 'user') {
            return redirect()->route('managereservasi');
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

//udah dibenerin
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

require __DIR__ . '/auth.php';
