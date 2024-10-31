<?php

use App\Http\Controllers\AnagramController;
use App\Http\Controllers\TaskSchedulerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/group-anagrams', [AnagramController::class, 'groupAnagrams']);
Route::post('/task-scheduler', [TaskSchedulerController::class, 'calculateMinimalCompletionTime']);