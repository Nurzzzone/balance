<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/', 'home')->name('homepage');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
