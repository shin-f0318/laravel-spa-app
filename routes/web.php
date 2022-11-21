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
Route::get('/', [SpaController::class, 'top'])->name('top');
Route::get('/index', [SpaController::class, 'index'])->name('index');
Route::get('/serch', [SpaController::class, 'serch'])->name('serch');

// お問合せ
Route::get('/create', [SpaController::class, 'create'])->name('create');
Route::post('/create', [ContactController::class, 'store'])->name('store');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
