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

Route::get('/', [AttendanceController::class, 'add'])->middleware(['auth']);
Route::get('/attendance', [AttendanceController::class, 'index'])->middleware(['auth']);
Route::post('/attendance/{id}', [AttendanceController::class, 'update'])->middleware(['auth']);
Route::post('/attendance', [AttendanceController::class, 'create'])->middleware(['auth']);
Route::post('/pause/{id}', [PauseController::class, 'update'])->middleware(['auth']);
Route::post('/pause', [PauseController::class, 'create'])->middleware(['auth']);

require __DIR__ . '/auth.php';
