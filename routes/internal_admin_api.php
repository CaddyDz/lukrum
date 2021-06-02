<?php

use App\Http\Controllers\Api\InternalAdmin\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'internal-admin', 'middleware' => ['auth:api', 'admin.internal']], function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('companies', [CompanyController::class, 'index']);
    Route::post('companies', [CompanyController::class, 'store']);
});