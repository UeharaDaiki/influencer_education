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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/curriculum_list/{id?}', [App\Http\Controllers\Admin\CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
    Route::get('/show_curriculum_registration', [App\Http\Controllers\Admin\CurriculumController::class, 'showCurriculumRegistration'])->name('show.curriculum.registration');
    Route::post('/curriculum_registration', [App\Http\Controllers\Admin\CurriculumController::class, 'curriculumRegistration'])->name('curriculum.registration');
    Route::get('/curriculum_edit/{id}', [App\Http\Controllers\Admin\CurriculumController::class, 'showCurriculumEdit'])->name('show.curriculum.edit');
    Route::post('/curriculum_update/{id}', [App\Http\Controllers\Admin\CurriculumController::class, 'updateCurriculum'])->name('curriculum.update');
    Route::get('/delivery_edit/{id}', [App\Http\Controllers\Admin\DeliveryController::class, 'showDeliveryEdit'])->name('show.delivery.edit');
    Route::post('/delivery_update/{id}', [App\Http\Controllers\Admin\DeliveryController::class, 'updateDelivery'])->name('update.delivery');
    Route::post('/delivery_delete/{id}', [App\Http\Controllers\Admin\DeliveryController::class, 'deleteDelivery'])->name('delete.delivery');
});

