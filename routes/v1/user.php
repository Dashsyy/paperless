<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/users')->group(function () {
    Route::get('/', function () {
        return [];
    });
});
