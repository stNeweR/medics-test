<?php

use App\Router\Route;
use App\Controllers\PeopleController;
use App\Controllers\PeoplePhoneController;

return [
    Route::get('/peoples', [PeopleController::class, 'index']),
    Route::get('/peoples/show', [PeopleController::class, 'show']),
    Route::post('/peoples/store', [PeopleController::class, 'store']),
    Route::post('/peoples/delete', [PeopleController::class, 'delete']),
    Route::put('/peoples/update', [PeopleController::class, 'update']),
    Route::post('/peoples/phones', [PeoplePhoneController::class, 'store']),
    Route::post('/peoples/phones/delete', [PeoplePhoneController::class, 'delete']),
    Route::put('/peoples/phones/update', [PeoplePhoneController::class, 'update']),
];