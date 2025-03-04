<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebshopController;
use App\Http\Controllers\UserController;

Route::view('/',"welcome");
Route::get('/kosar', [WebshopController::class, 'Kosar']);
Route::get("/search", [WebshopController::class, 'Search']);

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
