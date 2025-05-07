<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\ProgressController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\TopController;
use App\Http\Controllers\Users\ArticleController;
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

Route::get('user/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('user/login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout']);


Route::get('user/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('user/register', [RegisterController::class, 'register']);

Route::get('user/top', [TopController::class, 'top'])->name('top');
Route::get('user/article_top', [TopController::class, 'article_top'])->name('article_top');
Route::get('user/article/{id}', [ArticleController::class, 'show'])->name('users.auth.article');

// 共通ヘッダーの画面遷移
Route::get('user/progress', [ProgressController::class, 'showProgress'])->name('showProgress');
Route::get('user/ProfileForm', [ProfileController::class, 'showProfileForm'])->name('showProfileForm');
Route::get('user/CurriculumList', [CurriculumController::class, 'showCurriculumList'])->name('showCurriculumList');
