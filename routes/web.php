<?php

use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('account');

// Маршрут для создания пользователя
Route::get('register')->name('register.create'); // Метод просмотра страницы регистрации пользователя
// Route::get('register', [RegisterController::class, 'create'])->name('register.create'); // Метод просмотра страницы регистрации пользователя
// Route::post('register/store', [RegisterController::class, 'store'])->name('register.store'); // Метод запрос регистрации пользователя

// Маршрут для авторизации пользователя
Route::get('login', [LoginController::class, 'index'])->name('login.index'); // Метод просмотра страницы авторизации
Route::post('login/auth', [LoginController::class, 'store'])->name('login.store'); // Метод запрос авторизации пользователя
Route::get('login/login.logout', [LoginController::class, 'logout'])->name('login.logout'); // Метод запрос авторизации пользователя
