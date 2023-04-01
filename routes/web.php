<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Cache\Store;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BlogController::class, 'main']);
Route::get('/post', [BlogController::class, 'create'])-> name('jku');

Route::post('/store-post', [BlogController::class, 'store'])-> name('tambah-post');

Route::resource('/post', BlogController::class);

Route::get('/hapus/{id}', [BlogController::class, 'delete']);

Route::get('/edit-post/{id}', [BlogController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [BlogController::class, 'update'])->name('update');

Route::get('/reset-id', [BlogController::class, 'resetId'])->name('resetId');

Route::get('/order-desc', [BlogController::class, 'orderDesc']);
Route::get('/order-asc', [BlogController::class, 'orderAsc']);