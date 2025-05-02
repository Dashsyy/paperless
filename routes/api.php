<?php

use Illuminate\Support\Facades\Route;

$basePath = __DIR__;

foreach (glob("$basePath/*", GLOB_ONLYDIR) as $domainPath) {
    foreach (glob("$domainPath/*.php") as $routeFile) {
        $segments = explode('/', $routeFile);
        $version = basename($routeFile, '.php');
        Route::prefix($version)
            ->middleware('api')
            ->group($routeFile);
    }
}
