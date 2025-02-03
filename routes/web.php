<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebshopController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/kosar', [WebshopController::class, 'Kosar']);
