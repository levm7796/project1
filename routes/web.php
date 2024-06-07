<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CardProductsController;
use App\Http\Controllers\client\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('{any?}', fn () => view('app'))->where('any', '.*' );

//Route::group(['prefix' => 'admin'], function() {

//Route::get('/laravel/?{name}', function(){
//    return redirect('vue_app');
//})->where('name', '[A-Za-z]+');
//
//Route::get('/products', [ProductsController::class, 'store']);
//Route::get('/logout', [LogoutController::class, 'store']);
//
//Route::post('/register', [RegisterController::class, 'store']);
//Route::post('/login', [LoginController::class, 'store']);
//Route::post('/setToken', [LoginController::class, 'setToken']);
//Route::post('/setRegion', [LoginController::class, 'setRegion']);
//Route::post('/changePassword', [LoginController::class, 'changePassword']);
//Route::post('/forgotPassword', [LoginController::class, 'forgotPassword']);
//Route::post('/addToCart', [CardController::class, 'store']);
//Route::post('/addToFavorite', [CardController::class, 'addToFavorite']);
//Route::post('/cardProducts', [CardProductsController::class, 'store']);
//Route::post('/favoriteProducts', [CardProductsController::class, 'favoriteProducts']);
//Route::post('/removeProduct', [CardProductsController::class, 'removeProduct']);
//Route::post('/removeFavorite', [CardProductsController::class, 'removeFavorite']);
//Route::post('/changePics', [CardProductsController::class, 'changePics']);
//Route::post('/changeColor', [CardProductsController::class, 'changeColor']);
//Route::post('/changeSize', [CardProductsController::class, 'changeSize']);
//Route::post('/productById', [CardProductsController::class, 'productById']);
//Route::post('/checkout', [StripeController::class, 'checkout']);
//Route::post('/createOrder', [StripeController::class, 'createOrder']);
//Route::post('/updateOrder', [StripeController::class, 'updateOrder']);
//});

//Route::get('{page}', IndexController::class)->where('page', '*');
//Route::post('/success', [StripeController::class, 'createOrder']);
