<?php

use App\Http\Controllers\Admin\BusinessOverviewController;
use Illuminate\Support\Facades\Route;

// only super admin can use these routes
Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'auth:admin',
        'role:super-admin|admin',
    ],
], function () {
    Route::get('/business-overview', [BusinessOverviewController::class, 'businessOverview']);
    Route::get('/business-overview/total-income', [BusinessOverviewController::class, 'totalIncome']);
    Route::get('/business-overview/total-expense', [BusinessOverviewController::class, 'totalExpense']);
    Route::get('/business-overview/total-usages', [BusinessOverviewController::class, 'totalUsage']);
    Route::get('/subscription-packages/income', [BusinessOverviewController::class, 'subscriptionPackagesData']);
});
