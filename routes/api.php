<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ImagesController;

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


Route::post('/users/register', [UsersController::class,'register']);
Route::post('/students/register', [StudentsController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);
Route::get('/students/get', [StudentsController::class,'get']);
Route::post('/students/find', [StudentsController::class,'find']);
Route::put('/students/update', [StudentsController::class,'update']);
Route::post('/image/upload', [ImagesController::class,'upload']);