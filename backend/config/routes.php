<?php

use App\Router\Route;
use App\Controllers\PeopleController;

return [
    Route::get('/peoples', [PeopleController::class, 'index']),
    Route::get('/peoples/show', [PeopleController::class, 'show']),
    Route::post('/peoples/store', [PeopleController::class, 'store']),
];