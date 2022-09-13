<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TypologyController;
use App\Http\Controllers\UtilizerController;
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

Route::get('/', [DeviceController::class, 'index']);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('department/create', [DepartmentController::class, 'create'])->middleware('auth');
Route::post('department/create', [DepartmentController::class, 'store'])->middleware('auth');
Route::delete('department/{department:id}/destroy', [DepartmentController::class, 'destroy'])->middleware('auth');

Route::get('typology/create', [TypologyController::class, 'create'])->middleware('auth');
Route::post('typology/create', [TypologyController::class, 'store'])->middleware('auth');
Route::delete('typology/{typology:id}/destroy', [TypologyController::class, 'destroy'])->middleware('auth');

Route::get('utilizer/create', [UtilizerController::class, 'create'])->middleware('auth');
Route::post('utilizer/create', [UtilizerController::class, 'store'])->middleware('auth');
Route::delete('utilizer/{utilizer:id}/destroy', [UtilizerController::class, 'destroy'])->middleware('auth');

Route::get('typologies/{typology:name}', [DeviceController::class, 'typologiesFilter'])->middleware('auth');
Route::get('departments/{department:name}', [DeviceController::class, 'departmentsFilter'])->middleware('auth');

Route::get('device/create', [DeviceController::class, 'create'])->middleware('auth');
Route::post('device/create', [DeviceController::class, 'store'])->middleware('auth');
Route::get('devices/{device:serial}', [DeviceController::class, 'show'])->middleware('auth');
Route::get('devices/{device:serial}/edit', [DeviceController::class, 'edit'])->middleware('auth');
Route::patch('devices/{device:serial}/update', [DeviceController::class, 'update'])->middleware('auth');
Route::delete('devices/{device:serial}/destroy', [DeviceController::class, 'destroy'])->middleware('auth');

Route::get('devices/{device:serial}/maintanence/create', [ServiceController::class, 'create'])->middleware('auth');
Route::post('devices/{device:serial}/maintanence/create', [ServiceController::class, 'store'])->middleware('auth');
Route::get('devices/{device:serial}/maintanence/{service:id}/edit', [ServiceController::class, 'edit'])->middleware('auth');
Route::patch('devices/{device:serial}/maintanence/{service:id}/update', [ServiceController::class, 'update'])->middleware('auth');
Route::delete('devices/{device:serial}/maintanence/{service:id}/destroy', [ServiceController::class, 'destroy'])->middleware('auth');


