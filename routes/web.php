<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSpaController;
use App\Http\Controllers\AdminContactController;

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
// トップページ
Route::get('/', [SpaController::class, 'top'])->name('top');

// // ログイン認証グループ定義
// Route::group(['middleware' => 'auth'], function() {

// 施設登録ページ
Route::get('/serch', [SpaController::class, 'serch'])->name('serch');
Route::post('/serch', [SpaController::class, 'map_store'])->name('map_store');

// お問合せページ
Route::get('/create', [SpaController::class, 'create'])->name('create');
Route::post('/create', [SpaController::class, 'store'])->name('store');

// お問合せ一覧ページ
Route::get('/index', [SpaController::class, 'index'])->name('index');

// });

// マップ一覧ページ
Route::get('/map', [SpaController::class, 'map'])->name('map');


// 管理者ユーザーのみ
// ユーザー管理
Route::group(['middleware' => ['auth', 'can:admin']], function() {
    Route::get('/user/admin', [AdminController::class, 'index'])->name('user.index');
    Route::get('/user/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
});

// スパ管理
Route::group(['middleware' => ['auth', 'can:admin']], function() {
    Route::get('/spa/index', [AdminSpaController::class, 'index'])->name('spa.index');
    Route::get('/spa/{spa}/edit', [AdminSpaController::class, 'edit'])->name('spa.edit');
    Route::patch('/spa/update/{spa}', [AdminSpaController::class, 'update'])->name('spa.update');
    Route::get('/spa/delete/{spa}', [AdminSpaController::class, 'destroy'])->name('spa.destroy');
});

// お問合せ管理
Route::group(['middleware' => ['auth', 'can:admin']], function() {
    Route::get('/contact/index', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{contact}/edit', [AdminContactController::class, 'edit'])->name('contact.edit');
    Route::patch('/contact/update/{contact}', [AdminContactController::class, 'update'])->name('contact.update');
    Route::get('/contact/delete/{contact}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});
Auth::routes();
