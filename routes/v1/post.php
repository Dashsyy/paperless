<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/posts')->group(function () {
    Route::get('/', function () {
        return [];
    });
});
