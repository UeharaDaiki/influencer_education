<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\ProgressController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\CurriculumController;
use App\Http\Controllers\Users\Auth\LoginController;
use App\Http\Controllers\Users\Auth\RegisterController;

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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout']);


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('top', [LoginController::class, 'top'])->name('top');

Route::get('progress', [ProgressController::class, 'showProgress'])->name('showProgress');

Route::get('ProfileForm', [ProfileController::class, 'showProfileForm'])->name('showProfileForm');

Route::get('CurriculumList', [CurriculumController::class, 'showCurriculumList'])->name('showCurriculumList');
