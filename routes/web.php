<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VuesyController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\GesCongAppController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
    
    Route::resource('holidays', HolidayController::class);
    Route::patch('holidays/update-status/{demand}', [HolidayController::class, 'changeHolidayDemandStatus'])->name('holidays-update-status');
    
    Route::resource('demands', DemandController::class);
    Route::patch('demands/update-status/{demand}', [DemandController::class, 'changeHolidayDemandStatus'])->name('demands-update-status');
    
    // Route::controller(DemandController::class)->group(function() {
    //     Route::name('demands.')->group(function() {
    //         Route::patch('demands/update-status/{demand}', [DemandController::class, 'changeHolidayDemandStatus'])->name('demands-update-status');
    //     });
    // });
    
    Route::get('roles', [RoleController::class, 'index'])->name('show-roles');   
    Route::get('roles-create', [RoleController::class, 'create'])->name('create-roles');   
    Route::post('store-roles', [RoleController::class, 'store'])->name('store-roles');   
    Route::get('edit-role/{id}', [RoleController::class, 'edit'])->name('roles.edit');   
    Route::post('update-role/{id}', [RoleController::class, 'update'])->name('roles.update');   
    Route::get('delete-role/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');   

    // Route::get('{any}', [GesCongAppController::class, 'index'])->name('index');
    Route::get('{any}', [VuesyController::class, 'index'])->name('index');
});


