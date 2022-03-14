<?php

use App\Http\Controllers\DeleteProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SignUpUserController;
use App\Http\Controllers\UpdateProjectController;
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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('projects/create', [ProjectController::class, 'store']);
    Route::put('projects/{id}', UpdateProjectController::class);
    Route::delete('projects/{id}', DeleteProjectController::class);

});



Route::post('signup', SignUpUserController::class);

