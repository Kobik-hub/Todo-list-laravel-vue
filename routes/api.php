<?php

use App\Http\Controllers\AuthController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::prefix('/todos')->group(function () {
        Route::post('/', [TodoController::class, 'index']);
        Route::post('/create', [TodoController::class, 'create']);
        Route::post('/remove-toggle', [TodoController::class, 'softRemoveToggle']);
        Route::post('/done-toggle', [TodoController::class, 'doneToggle']);
        Route::post('/edit', [TodoController::class, 'update']);
        Route::get('/{id}', [TodoController::class, 'getTodo']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
