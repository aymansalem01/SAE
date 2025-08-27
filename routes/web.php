<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});
Route::view('chat','welcome')->name('home');

Route::post('login', [AuthController::class, 'login'])->name('login');
