<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingController::class, 'index']);
Route::group(['prefix'=> 'auth'], function () {
    Route::view('login', 'login');
});
