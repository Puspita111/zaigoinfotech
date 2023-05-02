<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//login

Route::get('/',[loginController::class,'index']);
Route::post('/loginaction',[loginController::class,'login'])->name('loginaction');
//endlogin

//signup
Route::get('/signup',[loginController::class,'signup']);
Route::post('/signup_action',[loginController::class,'signupaction'])->name('signupaction');



Route::group(['middleware'=>'login'],function(){
    Route::group(['middleware'=>'ip'],function(){

    
    //dashboard
    Route::get('/dashboard',[HomeController::class,'index'])->middleware('login');
    //ipaddress
    Route::get('/ipaddress',[HomeController::class,'ipaddress_index']);
    Route::post('/ipaddress_store',[HomeController::class,'ipaddress_store'])->name('ip_store');
    Route::post('/ipstatus',[HomeController::class,'updatestatus'])->name('updatestatus');
    //Employee
    Route::get('/employee',[EmployeeController::class,'index']);
    Route::post('/addemployee',[EmployeeController::class,'store'])->name('addemployee');
    Route::group(['prefix'=>'employee'],function(){
        Route::get('/create',[EmployeeController::class,'create']);
        Route::post('/bulkaction',[EmployeeController::class,'bulkaction'])->name('bulkaction');
    });
   Route::get('/useractivity',[HomeController::class,'useractivity']);
   Route::get('/sample_download',[HomeController::class,'sample_download']);

   Route::post('/edit_employee',[EmployeeController::class,'edit']);
   Route::post('/update_employee',[EmployeeController::class,'update'])->name('update_employee');

   Route::get('/employee_delete/{id}',[HomeController::class,'employee_delete']);
});
   
});



//logout
Route::get('logout',[loginController::class,'logout']);