<?php

use Illuminate\Support\Facades\Route;

// $model = App\Models\Seeker::query()->first()
Route::get('/resume/{id}', [\App\Http\Controllers\ResumeController::class, '__invoke']);
Route::get('/resume_one', function () {
	return view('templates.resume_one');
});
