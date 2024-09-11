<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LavanderiaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\UsuarioController;
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
Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLoginForm'); //Vista CLiente
Route::post('/login', [LoginController::class, 'login'])->name('login'); //Cliente
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');//Logout
Route::get('/menu', [ClienteController::class, 'index'])->name('index'); //Menu
Route::get('/registro',[ClienteController::class,'registro'])->name('registro');//Registro
Route::post('/regitroCliente',[ClienteController::class,'save'])->name('registroCliente');//Guardar Registro




/*Usuario*/
Route::get('/loginUsuario', [UsuarioController::class, 'vistaLogin'])->name('vistaLogin'); //Vista Usuario
Route::get('/usuarioMaster', [UsuarioController::class, 'usuarioMaster'])->name('usuarioMaster'); //Vista Usuario
Route::post('/logearse', [UsuarioController::class, 'loginUsuario'])->name('loginUsuario'); //Cliente
Route::post('/logoutUsuario', [UsuarioController::class, 'logoutUsuario'])->name('logoutUsuario');//Logout

/*Motirsta*/
Route::get('/menuMoto', [MotoristaController::class, 'indexMotorista'])->name('indexMotorista'); //Vista Motirista





/*Lavanderia*/
Route::get('/menuLavan', [LavanderiaController::class, 'indexLavanderia'])->name('indexLavanderia'); //Vista Lavanderia
Route::get('/menuAdmin', [LavanderiaController::class, 'indexAdministrador'])->name('menuAdmin'); //Vista Administrador
