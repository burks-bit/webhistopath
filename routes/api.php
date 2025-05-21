<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AuditLogController,
    AuthController,
    BranchController,
    ConfigurationController,
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Protected route to fetch authenticated user
Route::middleware(['auth:sanctum', 'token.expiry'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getBranch', [BranchController::class, 'getBranch']);

Route::get('/get_configurations', [ConfigurationController::class, 'get_configurations']);
Route::post('/createConfiguration', [ConfigurationController::class, 'createConfiguration']);
Route::get('/searchConfigurations', [ConfigurationController::class, 'searchConfigurations']);
Route::put('/updateConfiguration', [ConfigurationController::class, 'updateConfiguration']);
Route::post('/deleteConfig', [ConfigurationController::class, 'deleteConfig']);

Route::get('/getAuditLogs', [AuditLogController::class, 'getAuditLogs']);
Route::get('/searchAuditLogs', [AuditLogController::class, 'searchAuditLogs']);