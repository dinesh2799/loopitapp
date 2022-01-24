<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register'])->name('register.user');
Route::post('/login', [UserController::class, 'login'])->name('login.user');
Route::post('/add-car',[CarController::class,'addCar']);
Route::get('/edit-car/{id}', [CarController::class, 'edit']);
Route::put('/update-car/{id}', [CarController::class, 'update']);
Route::put('/delete-car/{id}', [CarController::class, 'destroy']);
Route::get('cars',[CarController::class,'cars']);
