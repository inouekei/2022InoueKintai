<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PauseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(
  function () {
    Route::get('/', [AttendanceController::class, 'add']);
    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::post('/attendance/{id}', [AttendanceController::class, 'update']);
    Route::post('/attendance', [AttendanceController::class, 'create']);
    Route::post('/individual', [AttendanceController::class, 'show']);
    Route::post('/pause/{id}', [PauseController::class, 'update']);
    Route::post('/pause', [PauseController::class, 'create']);
  }
);

require __DIR__ . '/auth.php';
