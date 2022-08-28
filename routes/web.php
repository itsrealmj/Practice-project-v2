<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\productController;
use App\http\Controllers\addedToCartController;
use App\Http\Controllers\ImageUploadController;

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
    return view('app');
});


Route::get('/{add}', function () {
    return view('app');
})->where('add', '.*');

Route::get('/{productManagement}', function () {
    return view('app');
})->where('productManagement', '.*');

Route::get('/{cart}', function () {
    return view('app');
})->where('cart', '.*');

// Route::get('/login', [userController::class, 'verifyUser']);

// Route::get('/', [productController::class, 'getProducts']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


