<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('tasks', [TodoController::class, 'showAll']);
Route::post('create-task', [TodoController::class, 'create']);
Route::put('task/{id}', [TodoController::class, 'update']);
Route::put('complete/{id}', [TodoController::class, 'done']);
Route::put('incomplete/{id}', [TodoController::class, 'undone']);
Route::get('task/{id}', [TodoController::class, 'show']);
Route::delete('task/{id}', [TodoController::class, 'remove']);
