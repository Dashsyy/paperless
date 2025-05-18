<?php

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (#[CurrentUser] User $user) {
    return $user;
});

Route::prefix('v1/users')->group(function () {
    Route::get('/', function () {
        return [];
    });
});
