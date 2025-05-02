<?php

Route::prefix('v1/posts')->group(function () {
    Route::get('/', function () {
        return [];
    });
});
