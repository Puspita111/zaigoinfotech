<?php

use App\Http\Controllers\EmployeeController;
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

Route::post('/emoloyee_register', [EmployeeController::class, 'emoloyee_register']);
Route::get('/fetch_employee_data/{employee_id}', [EmployeeController::class, 'fetch_employee_data']);
Route::put('/employee_edit/{id}', [EmployeeController::class, 'employee_edit']);
Route::get('/delete_employee_data/{id}', [EmployeeController::class, 'delete_employee_data']);