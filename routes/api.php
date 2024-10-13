<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::group(
    [],
    function () {
        Route::group(
            [
                'prefix' => 'booking',
            ],
            function () {
                Route::get('/', [BookingController::class, 'index']);
                Route::post('/', [BookingController::class, 'store']);
                Route::get('/{id}', [BookingController::class, 'show']);
                Route::patch('/{id}', [BookingController::class, 'update']);
                Route::delete('/{id}', [BookingController::class, 'destroy']);

                Route::group(
                    [
                        'prefix' => 'user',
                    ],
                    function () {
                        Route::get('/{user_id}', [BookingController::class, 'userBookings']);
                    }
                );
            }
        );
        Route::group([

            'middleware' => 'api',
            'prefix' => 'auth'

        ], function ($router) {

            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('me', [AuthController::class, 'me']);
        });
    }
);
