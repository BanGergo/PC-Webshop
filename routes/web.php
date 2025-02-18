<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebshopController;
use App\Http\Controllers\UserController;

Route::view('/',"welcome");
Route::get('/kosar', [WebshopController::class, 'Kosar']);
Route::get("/search", [WebshopController::class, 'Search']);

// Route::view('/reg','reg');
Route::post('/', [UserController::class, 'regData']);

// Route::view('/login','login');
Route::post('/', [UserController::class, 'loginData']);

Route::view('/profil', 'profil');

Route::get('/mod', [UserController::class, 'mod']);
Route::post('/mod', [UserController::class, 'modData']);

Route::get("/logout", [UserController::class, 'logout']);
