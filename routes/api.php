<?php

use Illuminate\Http\Request;
use App\http\Controllers\productController;
use App\http\Controllers\CustomerCartsController;
use App\http\Controllers\userController;
use App\http\Controllers\CartController;
use App\http\Controllers\addedToCartController;

use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addProduct', [productController::class, 'addProduct']);
Route::get('/data', [productController::class, 'getProducts']);
Route::post('/update', [productController::class, 'updateProduct']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/manage', [productController::class, 'manageProducts']);

    

    // this handle the route rquest and send details to productcontroller class and perform the function delete 
    Route::post('/delete', [productController::class, 'deleteProduct']);
    Route::post('/edit', [productController::class, 'editProduct']);
    
    Route::post('/relation', [productController::class, 'relation']);
    // Added products to cart
    // Route::post('/cart', [CartController::class, 'index']);

    Route::get('/cart', [addedToCartController::class, 'getCarts']);
    Route::post('/cart', [addedToCartController::class, 'changeQty']);
    // Route::post('/cart', [addedToCartController::class, 'decrementQty']);
    Route::post('/addcart/{product}', [addedToCartController::class, 'addToCart']);
    Route::post('/deletecart', [addedToCartController::class, 'deleteCart']);

    Route::get('/alladdedcart', [addedToCartController::class, 'allAddedCart']);

});
// User registration // Controller

Route::post('/register', [userController::class, 'store']);
Route::post('/login', [userController::class, 'verifyUser']);
