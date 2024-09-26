<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LavanderiaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
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
//Pedidos
Route::match(['get', 'post'], '/pedidos/iniciar', [PedidoController::class, 'inicioPedido'])->name('pedidos.iniciar');
Route::get('/pedidos/direcc/{pedido}', [PedidoController::class, 'direccion'])->name('pedidos.direcc');
Route::post('/pedidos/guardar-direccion/{pedido}', [PedidoController::class, 'guardarDireccion'])->name('pedidos.guardar-direcc');
Route::get('/pedidos/servicios/{pedido}', [PedidoController::class, 'servicios'])->name('pedidos.servicios');
Route::post('/pedidos/{pedido}/guardarServicios', [PedidoController::class, 'guardarServicios'])->name('pedidos.guardar-servicios');
Route::get('/pedidos/{pedido}/resumen', [PedidoController::class, 'resumen'])->name('pedidos.resumen');
Route::delete('/pedidos/{pedido}', [PedidoController::class, 'eliminar'])->name('pedidos.eliminar');
Route::get('/pedidos/historial', [PedidoController::class, 'historialPedidos'])->name('pedidos.historial');
Route::get('/pedidos/{id_pedido}/detalle', [PedidoController::class, 'detallePedido'])->name('pedidos.detalle');
Route::post('/pedidos/iniciar-programacion', [PedidoController::class, 'iniciarProgramacion'])->name('pedidos.iniciarProgramacion');
Route::get('/pedidos/{pedido}/programar', [PedidoController::class, 'programar'])->name('pedidos.programar');
Route::post('/pedidos/{pedido}/programar', [PedidoController::class, 'guardarProgramacion'])->name('pedidos.guardarProgramacion');

/*Usuario*/
Route::get('/loginUsuario', [UsuarioController::class, 'vistaLogin'])->name('vistaLogin'); //Vista Usuario
Route::get('/usuarioMaster', [UsuarioController::class, 'usuarioMaster'])->name('usuarioMaster'); //Vista Usuario
Route::post('/logearse', [UsuarioController::class, 'loginUsuario'])->name('loginUsuario'); //Cliente
Route::post('/logoutUsuario', [UsuarioController::class, 'logoutUsuario'])->name('logoutUsuario');//Logout

















/*Motirsta*/
Route::get('/menuMoto', [MotoristaController::class, 'indexMotorista'])->name('indexMotorista'); //Menu
Route::get('/entregas', [MotoristaController::class, 'entregas'])->name('entregas'); //Entregas de Pendientes
Route::post('/motorista/cambiarEstado/{id_pedido}', [MotoristaController::class, 'estadoPedido'])->name('estadoPedido'); //Detalles de Pedido
Route::get('/detalles/{id_pedido}', [MotoristaController::class, 'detallesPedido'])->name('detalles'); //Vista Detalles de Pedido
Route::get('/historial', [MotoristaController::class, 'historial'])->name('historial'); //Historial de entregas
Route::get('/motorista/detalle/{id_pedido}', [MotoristaController::class, 'historialDetallesPedido'])->name('detallesHistorial');//Detalle de historial de entregas


/*Lavanderia*/
Route::get('/menuLavan', [LavanderiaController::class, 'indexLavanderia'])->name('indexLavanderia'); //Vista Lavanderia
Route::get('/menuAdmin', [LavanderiaController::class, 'indexAdministrador'])->name('menuAdmin'); //Vista Administrador
