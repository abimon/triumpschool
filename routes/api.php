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
// 4|75s71w9RMbEmzThYdBHNVlTncDq6RP4cCdWU9M3o3dc701f1
Route::middleware('auth:sanctum')->group(function () {
    // Students API
    Route::controller(StudentController::class)->prefix('students')->group(function () {
        Route::get('/', 'index');
        Route::post('/register', 'store');
        Route::get('/get_details/{id}', 'show');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });

    // Intakes API
    Route::controller(IntakeController::class)->prefix('/intakes')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });

    // Courses API
    Route::controller(CourseController::class)->prefix('courses')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });

    // Fee payments API - CRUD operations
    Route::controller(FeePaymentController::class)->prefix('fee-payments')->group(function () {
        Route::get('/', 'index');             // list all payments
        Route::post('/', 'store');            // create new payment
        Route::get('/{id}', 'show');          // show single payment
        Route::put('/{id}', 'update');        // update payment
        Route::delete('/{id}', 'destroy');    // delete payment
    });

});
