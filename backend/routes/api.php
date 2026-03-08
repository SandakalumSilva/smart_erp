<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('role')->middleware('auth:sanctum')->controller(RoleController::class)->group(function () {
    Route::get('/get-all-role', 'getAllRole')->name('role.get.all');
    Route::post('/add-role', 'store')->name('role.store');
    Route::put('/edit-role', 'editRole')->name('role.edit');
    Route::post('/delete-role', 'deleteRole')->name('role.delete');
    Route::post('/assign-permission', 'givePermission')->name('role.assign.permission');
});

Route::prefix('permission')->middleware('auth:sanctum')->controller(PermissionController::class)->group(function () {
    Route::post('/permission-create', 'store')->name('permission.create');
});
