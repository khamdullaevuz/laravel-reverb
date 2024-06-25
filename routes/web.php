<?php

use App\Http\Controllers\ChatController;
use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/chats', Chat::class)->name('chats');
    Route::get('/chatroom/{id}', [ChatController::class, 'show'])->name('chats.show');
});
