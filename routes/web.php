<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use PHPUnit\Metadata\Test;

Route::get('/', function () {
    return view('login');
});
Route::view('chat','welcome')->name('home');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::view('test', 'test')->name('test');
