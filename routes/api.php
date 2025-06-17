<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AuditLogController,
    AuthController,
    BranchController,
    ConfigurationController,
    PatientController,
    TestGroupController,
    TestOrderController,
    LocationController,
    PhysicianController,
    ReceiveSpecimenPhaseController,
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
Route::get('/user/phases', [AuthController::class, 'get_user_phase_accesses']);
Route::get('/getBranch', [BranchController::class, 'getBranch']);
Route::get('/get_configurations', [ConfigurationController::class, 'get_configurations']);
Route::post('/createConfiguration', [ConfigurationController::class, 'createConfiguration']);
Route::get('/searchConfigurations', [ConfigurationController::class, 'searchConfigurations']);
Route::put('/updateConfiguration', [ConfigurationController::class, 'updateConfiguration']);
Route::post('/deleteConfig', [ConfigurationController::class, 'deleteConfig']);
Route::get('/getAuditLogs', [AuditLogController::class, 'getAuditLogs']);
Route::get('/searchAuditLogs', [AuditLogController::class, 'searchAuditLogs']);
Route::get('/searchPatient', [PatientController::class, 'searchPatient']);
Route::get('/getTestgroups', [TestGroupController::class, 'getTestgroups']);
Route::get('/getTestOrders', [TestOrderController::class, 'getTestOrders']);
Route::get('/getLocations', [LocationController::class, 'getLocations']);
Route::get('/getPhysicians', [PhysicianController::class, 'getPhysicians']);
Route::get('/getReceivedSpecimens', [ReceiveSpecimenPhaseController::class, 'getReceivedSpecimens']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/savePatient', [PatientController::class, 'savePatient']);
    Route::put('/updatePatient', [PatientController::class, 'updatePatient']);
    Route::post('/saveTestOrder', [TestOrderController::class, 'saveTestOrder']);
    Route::post('/receiveSpecimen', [ReceiveSpecimenPhaseController::class, 'receiveSpecimen']);
});