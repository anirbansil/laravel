<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

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

Route::group(['middleware'=>"auth"], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/product', [ProductsController::class, 'index'])->name('product');
    Route::get('/new-product', [ProductsController::class, 'new'])->name('new-product');
    Route::post('/save-product', [ProductsController::class,'store'])->name('save-product');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
    Route::post('/update-product', [ProductsController::class,'update'])->name('update-product');
    Route::delete('/delete/{id}', [ProductsController::class, 'destroy'])->name('delete');
});
