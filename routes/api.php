<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\TransactionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/employers', [EmployersController::class, 'index']);
    Route::get('/applicants', [ApplicantsController::class, 'index']);
    Route::get('/subscribers', [SubscribersController::class, 'index']);
    Route::get('/transactions', [TransactionsController::class, 'index']);
});
