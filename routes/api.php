<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeePaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'create');
    Route::post('/signup', 'store');
});
Route::middleware('auth:sanctum')->group(function () {

    // Students API
    Route::apiResource('students', StudentController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    // Intakes API
    Route::apiResource('intakes', IntakeController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    // Courses API
    Route::apiResource('courses', CourseController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    // Fee payments (stubbed controller)
    Route::apiResource('fee-payments', FeePaymentController::class)->only(['index', 'store', 'show', 'update', 'destroy']);


    // Student Routes
    Route::apiResource('students',StudentController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
});
