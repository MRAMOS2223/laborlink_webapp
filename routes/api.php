<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\DashboardController;

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

    /* Dashboard */
    Route::get('/statistics/hire-count', [DashboardController::class, 'getHireCount']);
    Route::get('/statistics/job-postings-count', [DashboardController::class, 'getJobPostingsCount']);
    Route::get('/statistics/applicants-count', [DashboardController::class, 'getApplicantsCount']);
    Route::get('/statistics/monthly-earnings', [DashboardController::class, 'getMonthlyEarnings']);
    Route::get('/statistics/rejected-count', [DashboardController::class, 'getRejectedCount']);
    Route::get('/statistics/companies-count', [DashboardController::class, 'getCompaniesCount']);
    Route::get('/statistics/interviewed-count', [DashboardController::class, 'getInterviewedCount']);
    Route::get('/statistics/profile-strength', [DashboardController::class, 'getProfileStrength']);
});
