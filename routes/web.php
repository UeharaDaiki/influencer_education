<?php

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
Route::prefix('user')->namespace('Users')->name('user.')->group(function () {
    Route::get('/progress', [App\Http\Controllers\Users\ProgressController::class, 'showProgress'])->name('show.progress');
    Route::get('/delivery/{id}', [App\Http\Controllers\Users\DeliveryController::class, 'showDelivery'])->name('show.delivery');
    Route::get('/top', [App\Http\Controllers\Users\TopController::class, 'showTop'])->name('show.top');
    Route::get('/curriculum_list', [App\Http\Controllers\Users\CurriculumController::class, 'showCurriculum'])->name('show.curriculum');
    Route::get('/profile', [App\Http\Controllers\Users\ProfileController::class, 'showProfileForm'])->name('show.profile');
    Route::get('/login', [App\Http\Controllers\Users\LoginController::class, 'showLogin'])->name('show.login');
    Route::get('/article/{id}', [App\Http\Controllers\Users\ArticleController::class, 'showArticle'])->name('show.article');
    Route::post('/profile_edit', [App\Http\Controllers\Users\ProfileController::class, 'profileEdit'])->name('profile.edit');
    Route::get('/password', [App\Http\Controllers\Users\ProfileController::class, 'showPasswordForm'])->name('show.password.edit');
    Route::post('/password_edit', [App\Http\Controllers\Users\ProfileController::class, 'passwordEdit'])->name('password.edit');

});
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/top', [App\Http\Controllers\Admin\AdminTopController::class, 'showTop'])->name('show.top');
    Route::get('/article_list', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleList'])->name('show.article.list');
    Route::get('/article_create', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleCreate'])->name('show.article.create');
    Route::get('/article_edit/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleEdit'])->name('show.article.edit');
    Route::post('/article_delete/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'showArticleDelete'])->name('show.article.delete');
    Route::post('/article_edit/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'articleEdit'])->name('article.edit');
    Route::post('/article_create', [App\Http\Controllers\Admin\ArticleController::class, 'articleCreate'])->name('article.create');
});