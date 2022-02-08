<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\InitialController;
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

    
Route::get('/',  [InitialController::class, 'index']);
Route::get('/validarInput',  [InitialController::class, 'validarInput']);
Route::get('/curso',  [InitialController::class, 'curso']);
Route::post('/doMake',  [InitialController::class, 'doMake']);
//return view('welcome');

Route::get('/teste',  [TesteController::class, 'index']);
