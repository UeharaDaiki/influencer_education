<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\Admin\Auth\RegisterController;


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
});
