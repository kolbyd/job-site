<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticatedMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Models\RoleAssignment;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingController::class, 'index'])->name('index');

/**
 * Route group for routes involving user authentication.
 */
Route::group(['prefix'=> 'auth'], function () {
    /**
     * The following methods are used by guest users.
     */
    Route::group(['middleware'=> GuestMiddleware::class], function () {
        Route::view('login', 'auth.login')->name('login');
        Route::post('login', [UserController::class, 'login'])->name('login');

        Route::view('register', 'auth.register')->name('register');
        Route::post('register', [UserController::class, 'create'])->name('register.post');
    });

    Route::get('logout', [UserController::class,'logout'])
        ->middleware(AuthenticatedMiddleware::class)
        ->name('logout');
});

/**
 * Listing routes.
 */
Route::group(['prefix' => 'listings'], function () {
    // Route::get {ID} - View a listing

    Route::post('{listing}/interest', [ListingController::class, 'changeUserInterest'])
        ->middleware(RoleMiddleware::class . ':' . RoleAssignment::VIEWER_ROLE)
        ->name('listing.interest');
});
