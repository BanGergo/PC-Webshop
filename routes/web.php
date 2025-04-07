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

Route::get('/mod', [UserController::class, 'mod']);
Route::post('/mod', [UserController::class, 'modData']);

Route::get("/logout", [UserController::class, 'logout']);

Route::get('/profil', [WebshopController::class, 'profil']);
Route::post("/profil", [WebshopController::class, 'termekadddata']);

Route::get("/mind", [WebshopController::class, "mind"]);

Route::get('/tmod/{cikkszam}', [WebshopController::class, 'tmod']);
Route::post('/tmod/{cikkszam}', [WebshopController::class, 'tmoddata']);

Route::post('/add', [WebshopController::class, 'Add']);
Route::get('/cart', [WebshopController::class, 'Cart']);
Route::post('/cart', [WebshopController::class, 'CartData']);
Route::get('/order', [WebshopController::class, 'Order']);

Route::get('/products', [WebshopController::class, 'index'])->name('products.index');
Route::get('/products/filter', [WebshopController::class, 'filter'])->name('products.filter');
Route::get('/products/category/{category}', [WebshopController::class, 'filterByCategory'])->name('products.byCategory');
