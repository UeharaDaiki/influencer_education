<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TopController;

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

Route::prefix('user')->name('user.')->group(function () {

    /* トップ画面 */
    Route::get('/top', function () {
        return 'トップ画面（仮）';
    })->name('show.top');

    /* ログイン画面 */
    Route::get('/login', function () {
        return 'ログイン画面（仮）';
    })->name('show.login');

    /* ユーザープロフィール */
    Route::get('/profile', function () {
        return 'ユーザープロフィール（仮）';
    })->name('show.profile');

    /* 授業進捗画面 */
    Route::get('/progress', function () {
        return '授業進捗画面（仮）';
    })->name('show.progress');
    
    /* 配信画面 */
    Route::get('/delivery/{id}', function ($id) {
        return '配信画面(仮)'. $id;
    })->name('show.delivery');

    /* 時間割ページ */
    Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum');
    
});

Route::prefix('admin')->name('admin.')->group(function () {
    /* ユーザー新規登録画面 */
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('show.register');

    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show.login');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    /* 管理者トップ画面 */
    Route::get('/top', [TopController::class, 'showTop'])->name('show.top');

    /* 授業一覧画面 */
    Route::get('/curriculum_list', function () {
        return '授業一覧画面（仮）';
    })->name('show.curriculum.list');
    

    /* お知らせ一覧画面 */
    Route::get('/article_list', function () {
        return 'お知らせ一覧画面（仮）';
    })->name('show.article.list');

    /* バナー管理画面 */
    Route::get('/banner_list', function () {
        return 'バナー管理画面（仮）';
    })->name('show.banner.list');
});
