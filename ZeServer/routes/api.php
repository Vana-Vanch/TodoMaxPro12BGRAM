<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodosController;
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


//Authenticate
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/createTodo', [TodosController::class, 'create']);
    Route::get('/getTodo', [TodosController::class, 'getAllTodos']);
    Route::post('/deleteTodo/{id}', [TodosController::class, 'destroyTodo']);
    Route::post('/updateTodo/{id}', [TodosController::class,'updateTodo']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
