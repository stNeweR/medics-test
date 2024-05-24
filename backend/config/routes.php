<?php

use App\Router\Route;
use App\Controllers\UserController;

return [
    Route::get('', [UserController::class, 'index']),
    Route::get('/how', [UserController::class, 'show']),
];