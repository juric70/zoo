<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\FoodController;

Route::get('foods', [FoodController::class, 'index']);
Route::get('foods/{id}', [FoodController::class, 'show']);
Route::post('foods', [FoodController::class, 'store']);
Route::put('foods/{id}', [FoodController::class, 'update']);
Route::delete('foods/{id}', [FoodController::class, 'destroy']);


use App\Http\Controllers\MaintenanceTypeController;

Route::get('maintenance-types', [MaintenanceTypeController::class, 'index']);
Route::get('maintenance-types/{id}', [MaintenanceTypeController::class, 'show']);
Route::post('maintenance-types', [MaintenanceTypeController::class, 'store']);
Route::put('maintenance-types/{id}', [MaintenanceTypeController::class, 'update']);
Route::delete('maintenance-types/{id}', [MaintenanceTypeController::class, 'destroy']);


use App\Http\Controllers\AreasController;

Route::get('areas', [AreasController::class, 'index']);
Route::get('areas/{id}', [AreasController::class, 'show']);
Route::post('areas', [AreasController::class, 'store']);
Route::put('areas/{id}', [AreasController::class, 'update']);
Route::delete('areas/{id}', [AreasController::class, 'destroy']);

use App\Http\Controllers\PositionController;

Route::get('positions', [PositionController::class, 'index']);
Route::get('positions/{id}', [PositionController::class, 'show']);
Route::post('positions', [PositionController::class, 'store']);
Route::put('positions/{id}', [PositionController::class, 'update']);
Route::delete('positions/{id}', [PositionController::class, 'destroy']);

use App\Http\Controllers\AnimalTypesController;

Route::get('animal-types', [AnimalTypesController::class, 'index']);
Route::get('animal-types/{id}', [AnimalTypesController::class, 'show']);
Route::post('animal-types', [AnimalTypesController::class, 'store']);
Route::put('animal-types/{id}', [AnimalTypesController::class, 'update']);
Route::delete('animal-types/{id}', [AnimalTypesController::class, 'destroy']);

use App\Http\Controllers\EmployeesController;

Route::get('employees', [EmployeesController::class, 'index']);
Route::get('employees/{id}', [EmployeesController::class, 'show']);
Route::post('employees', [EmployeesController::class, 'store']);
Route::put('employees/{id}', [EmployeesController::class, 'update']);
Route::delete('employees/{id}', [EmployeesController::class, 'destroy']);


use App\Http\Controllers\TicketsController;

Route::get('tickets', [TicketsController::class, 'index']);
Route::get('tickets/{id}', [TicketsController::class, 'show']);
Route::post('tickets', [TicketsController::class, 'store']);
Route::put('tickets/{id}', [TicketsController::class, 'update']);
Route::delete('tickets/{id}', [TicketsController::class, 'destroy']);

use App\Http\Controllers\AccomodationController;

Route::get('accommodations', [AccomodationController::class, 'index']);
Route::get('accommodations/{id}', [AccomodationController::class, 'show']);
Route::post('accommodations', [AccomodationController::class, 'store']);
Route::put('accommodations/{id}', [AccomodationController::class, 'update']);
Route::delete('accommodations/{id}', [AccomodationController::class, 'destroy']);

use App\Http\Controllers\FeedingController;

Route::get('feedings', [FeedingController::class, 'index']);
Route::get('feedings/{id}', [FeedingController::class, 'show']);
Route::post('feedings', [FeedingController::class, 'store']);
Route::put('feedings/{id}', [FeedingController::class, 'update']);
Route::delete('feedings/{id}', [FeedingController::class, 'destroy']);

use App\Http\Controllers\MaintenanceController;

Route::get('maintenances', [MaintenanceController::class, 'index']);
Route::get('maintenances/{id}', [MaintenanceController::class, 'show']);
Route::post('maintenances', [MaintenanceController::class, 'store']);
Route::put('maintenances/{id}', [MaintenanceController::class, 'update']);
Route::delete('maintenances/{id}', [MaintenanceController::class, 'destroy']);

use App\Http\Controllers\AnimalsController;

Route::get('animals', [AnimalsController::class, 'index']);
Route::get('animals/{id}', [AnimalsController::class, 'show']);
Route::post('animals', [AnimalsController::class, 'store']);
Route::put('animals/{id}', [AnimalsController::class, 'update']);
Route::delete('animals/{id}', [AnimalsController::class, 'destroy']);
