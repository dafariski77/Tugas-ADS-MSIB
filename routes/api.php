<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/karyawan', KaryawanController::class)->except([
        'create', 'edit'
    ]);
    
    Route::resource('/cuti-karyawan', CutiController::class)->except([
        'create', 'edit'
    ]);
    
    Route::get('/karyawan-pertama', [KaryawanController::class, 'firstThreeKaryawan']);
    
    Route::get('/cuti', [KaryawanController::class, 'karyawanWithCuti']);
    
    Route::get('/cuti/sisa-cuti', [KaryawanController::class, 'sisaCutiKaryawan']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
