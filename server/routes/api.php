<?php

use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/allUser', [UserController::class, 'allUser']);
Route::get('/user/{id}', [UserController::class, 'userById']);
Route::post('/user/addUser', [UserController::class, 'addUser'])->middleware('validasi.input');
Route::put('/user/editUser/{id}', [UserController::class, 'editUser']);
Route::delete('/user/delUser/{id}', [UserController::class, 'delUser']);