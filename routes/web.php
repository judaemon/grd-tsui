<?php

use App\Livewire\Chats\ChatsPage;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/users', Index::class)->name('users.index');

    Route::get('/user/profile', Profile::class)->name('user.profile');

    Route::get('/chats', ChatsPage::class)->name('chats.index');
});


use App\Events\NumberGenerated;

Route::get('/test-broadcast', function () {
    $number = rand(1, 100);
    broadcast(new NumberGenerated($number));
    return "Broadcasted number: $number";
});

Route::view('/listen', 'test');

require __DIR__.'/auth.php';
