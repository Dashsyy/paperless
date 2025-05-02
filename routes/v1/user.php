<?php

Route::prefix('v1/users')->group(function () {
    Route::get('/', function () {
        return [];
    });
});
