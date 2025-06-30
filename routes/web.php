<?php

use App\Livewire\BookList;
use App\Livewire\BookShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/books', BookList::class)->name('books.list');
    Route::get('/books/{id}', BookShow::class)->name('books.show');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/books', \App\Livewire\Admin\BookManager::class)->name('books');
});
Route::get('/dashboard', function () {
    return redirect()->route('books.list');
})->name('dashboard');
