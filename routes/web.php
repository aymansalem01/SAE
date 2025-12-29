<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use PHPUnit\Metadata\Test;

Route::get('/', function () {
    return view('test');
})->middleware('auth')->name('chat');


Route::view('chat','welcome')->name('home');

Route::post('login', [AuthController::class, 'login'])->name('login');


Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::view('login', 'login')->name('loginPage');
