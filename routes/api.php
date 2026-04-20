<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\FreelancerProfileController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Middleware\ClientOnly;
use App\Http\Middleware\FreelancerOnly;
use App\Http\Middleware\EnsureFreelancerVerified;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('city', CityController::class);
    Route::apiResource('country', CountryController::class);
    Route::apiResource('review', ReviewController::class);
    Route::apiResource('skill', SkillController::class);
    Route::apiResource('tag', TagController::class);
    Route::apiResource('user', UserController::class);
   Route::get('/dashboard/stats', [DashboardController::class, 'index']);


    Route::middleware('freelancer.verified')->group(function () {
        Route::post('/projects/{id}/apply', [OfferController::class, 'store']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('freelancerProfile', FreelancerProfileController::class);
});

Route::middleware(['auth:sanctum', 'client.only'])->group(function () {
    Route::apiResource('projects', ProjectController::class)
        ->only(['store']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class)
        ->only(['index', 'show']);
});

Route::middleware(['auth:sanctum', 'freelancer.only', 'freelancer.verified'])->group(function () {
    Route::apiResource('offers', OfferController::class);
});