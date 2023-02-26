<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;


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

// ログイン認証グループ定義
Route::group(['middleware' => 'auth'], function() {

// 施設登録ページ
Route::get('/serch', [SpaController::class, 'serch'])->name('serch');
Route::post('/serch', [SpaController::class, 'map_store'])->name('map_store');

// お問合せページ
Route::get('/create', [SpaController::class, 'create'])->name('create');
Route::post('/create', [SpaController::class, 'store'])->name('store');

// お問合せ一覧ページ
Route::get('/index', [SpaController::class, 'index'])->name('index');

});

// マップ一覧ページ
Route::get('/map', [SpaController::class, 'map'])->name('map');
