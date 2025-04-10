<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebshopController;
use App\Http\Controllers\UserController;

Route::get('/', [WebshopController::class, 'Welcome']);
Route::post('/', [WebshopController::class, "autocomplete"])->name("layout.autocomplete");

Route::view('/reg','reg');
Route::post('/reg', [UserController::class, 'regData']);

Route::view('/login','login');
Route::post('/login', [UserController::class, 'loginData']);

Route::get("/logout", [UserController::class, 'logout']);

Route::get('/profil', [WebshopController::class, 'profil']);
Route::post("/profil", [WebshopController::class, 'termekadddata']);
Route::post('/passMod', [UserController::class, 'passMod']);

Route::post('/add', [WebshopController::class, 'Add']);
Route::get('/cart', [WebshopController::class, 'Cart']);
Route::post('/cart', [WebshopController::class, 'CartData']);
Route::get('/delivery', [WebshopController::class, 'Delivery']);
Route::post('/delivery', [WebshopController::class, 'DeliveryData']);
Route::get('/order', [WebshopController::class, 'Order']);

Route::get('/products', [WebshopController::class, 'index'])->name('products.index');
Route::get('/products/filter', [WebshopController::class, 'filter'])->name('products.filter');
Route::get('/products/category/{category}', [WebshopController::class, 'filterByCategory'])->name('products.byCategory');
Route::get('/products/{product}', [WebshopController::class, 'adatlap'])->name('products.adatlap');
Route::post('/products/{product}/review', [WebshopController::class, 'addReview'])->name('products.addReview');
Route::get('/products/{product}/reviews', [WebshopController::class, 'showReviews'])->name('products.showReviews');
