<?php

use Illuminate\Support\Facades\Route;
// ContentControllerを使う
use App\Http\Controllers\ContentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 投稿入力画面を表示
Route::get('/input', [ContentController::class, 'input'])->name('input');

// 投稿入力内容を保存
Route::post('/save', [ContentController::class, 'save'])->name('save');

// 投稿内容を全表示
Route::get('/output', [ContentController::class, 'output'])->name('output');

// 投稿内容の詳細表示
Route::get('/detail/{content_id}', [ContentController::class, 'detail'])->name('detail');

// 投稿内容を編集
Route::get('/edit/{content_id}', [ContentController::class, 'edit'])->name('edit');
Route::post('/update', [ContentController::class, 'update'])->name('update');

// 投稿内容を削除
Route::post('/delete', [ContentController::class, 'delete'])->name('delete');