<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectManagement\ProjectController;
use App\Http\Controllers\ProjectManagement\DeleteProjectController;
use App\Http\Controllers\ProjectManagement\UpdateProjectController;
use App\Http\Controllers\ProjectManagement\DeleteWorkspaceController;
use App\Http\Controllers\ProjectManagement\CreateWorkspaceController;
use App\Http\Controllers\ProjectManagement\ChangeProjectOwnerController;

use App\Http\Controllers\SignUpUserController;


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
    //project routes
    Route::post('projects', [ProjectController::class, 'store']);
    Route::put('projects/{id}/changeOwner', ChangeProjectOwnerController::class);
    Route::put('projects/{id}', UpdateProjectController::class);
    Route::delete('projects/{id}', DeleteProjectController::class);
    
    //workspace routes
    Route::post('workspaces', CreateWorkspaceController::class);
    Route::delete('workspaces/{id}', DeleteWorkspaceController::class);

});


Route::post('signup', SignUpUserController::class);

