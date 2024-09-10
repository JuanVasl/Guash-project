<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

/*Cliente*/
Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLoginForm'); //Vista Login
Route::post('/login', [LoginController::class, 'login'])->name('login'); //Login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');//Logout
Route::get('/menu', [ClienteController::class, 'index'])->name('index'); //Menu
Route::get('/registro',[ClienteController::class,'registro'])->name('registro');//Registro
Route::post('/regitroCliente',[ClienteController::class,'save'])->name('registroCliente');//Guardar Registro
