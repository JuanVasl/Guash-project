<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LavanderiaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CierreDiarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*Logins*/
//Clientes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLoginForm'); //Vista CLiente
Route::post('/login', [LoginController::class, 'login'])->name('login'); //Cliente
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');//Logout
Route::get('/registro', [ClienteController::class, 'registro'])->name('registro');//Registro
Route::post('/regitroCliente', [ClienteController::class, 'save'])->name('registroCliente');//Guardar Registro

//Usuarios
Route::get('/loginUsuario', [UsuarioController::class, 'vistaLogin'])->name('vistaLogin'); //Vista Usuario
Route::post('/logearse', [UsuarioController::class, 'loginUsuario'])->name('loginUsuario'); //Cerrar sesion
Route::post('/logoutUsuario', [UsuarioController::class, 'logoutUsuario'])->name('logoutUsuario');//Logout


/*Cliente*/
Route::middleware(['role:cliente'])->group(function () {
//Pedidos
    Route::get('/menu', [ClienteController::class, 'index'])->name('index'); //Menu
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
});

/*Usuario Master*/
Route::middleware(['role: Usuario Master'])->group(function () {
    Route::get('/usuarioMaster', [UsuarioController::class, 'usuarioMaster'])->name('usuarioMaster'); //Vista Usuario
});

/*Motorista*/
Route::middleware(['role:Motorista, Usuario Master'])->group(function () {
    Route::get('/menuMoto', [MotoristaController::class, 'indexMotorista'])->name('indexMotorista'); //Menu
    Route::get('/entregas', [MotoristaController::class, 'entregas'])->name('entregas'); //Entregas de Pendientes
    Route::post('/motorista/cambiarEstado/{id_pedido}', [MotoristaController::class, 'estadoPedidoMotorista'])->name('estadoPedidoMotorista'); //Detalles de Pedido
    Route::get('detalles/{id_pedido}', [MotoristaController::class, 'detallesPedidoMotorista'])->name('detalles'); //Vista Detalles de Pedido
    Route::get('/historial', [MotoristaController::class, 'historial'])->name('historial'); //Historial de entregas
    Route::get('/motorista/detalle/{id_historial}', [MotoristaController::class, 'historialDetallesPedido'])->name('detallesHistorial');//Detalle de historial de entrega
});

/*Lavandero*/
Route::middleware(['role:Lavandero, Usuario Master'])->group(function () {
    Route::get('/menuLavan', [LavanderiaController::class, 'indexLavanderia'])->name('indexLavanderia'); //Vista Lavanderia
});

/*Lavandero y Administrador*/
Route::middleware(['role:Administrador Lavanderia, Lavandero, Usuario Master'])->group(function () {
//Pedidos Lavanderia
    Route::get('/pedidos', [LavanderiaController::class, 'pedidos'])->name('pedidos'); //Pedidos en Espera
    Route::get('/detallesPedido/{id_pedido}', [LavanderiaController::class, 'detallesPedido'])->name('detallesPedido'); //Vista Detalles de Pedido
    Route::post('/lavanderia/cambiarEstado/{id_pedido}', [LavanderiaController::class, 'estadoPedido'])->name('estadoPedido'); //Estado del Pedido
    Route::get('/calcularCanastos/{id_pedido}', [LavanderiaController::class, 'calcularCanastos'])->name('calcularCanastos'); //Vista Detalles de Canastos
    Route::post('/guardar-canastos/{id_pedido}', [LavanderiaController::class, 'guardarCanastos'])->name('guardar.canastos'); //guardamos los canastos en BD

//Asignar equipo en el pedido
    Route::get('/asignar-equipos/{id_pedido}', [LavanderiaController::class, 'asignarEquipos'])->name('asignar.equipos'); // Vista para asignar el equipo
    Route::post('/guardar-asignacion-lavadora/{id_pedido}', [LavanderiaController::class, 'guardarAsignacionLavadora'])->name('guardar.asignacionLavadora'); // Guardamos la asignación de lavadora
    Route::post('/guardar-asignacion-secadora/{id_pedido}', [LavanderiaController::class, 'guardarAsignacionSecadora'])->name('guardar.asignacionSecadora'); // Guardamos la asignación de secadora
    Route::post('/guardar-asignacion-lavadora-secadora/{id_pedido}', [LavanderiaController::class, 'guardarAsignacionLavadoraSecadora'])->name('guardar.asignacionLavadoraSecadora'); // Guardamos la asignación de lavadora y secadora

//Historico de Pedidos
    Route::get('/menuLavan/historial-pedidos', [LavanderiaController::class, 'historialPedidos'])->name('historial.pedidos'); //Vista de historial de pedidos
    Route::get('/menuLavan/historial-pedidos/pedido/{id}', [LavanderiaController::class, 'detallePedidoHistorico'])->name('detalle.pedidoHistorico');
});

/*Administrador Lavanderia*/
Route::middleware(['role:Administrador Lavanderia, Usuario Master'])->group(function () {
    Route::get('/menuAdmin', [LavanderiaController::class, 'indexAdministrador'])->name('menuAdmin'); //Vista Administrador

//Vista Detalles de Equipos Lavanderia
    Route::get('/equiposLavanderia', [LavanderiaController::class, 'equiposLavanderia'])->name('equiposLavanderia');

//Lavadoras
    Route::get('/equiposLavanderia/lavadoras', [LavanderiaController::class, 'lavadoras'])->name('lavadoras'); //Vista de Lavadoras
    Route::get('/equiposLavanderia/lavadoras/create', [LavanderiaController::class, 'createLavadora'])->name('lavadora.create');
    Route::post('/equiposLavanderia/lavadoras/create/save', [LavanderiaController::class, 'saveLavadora'])->name('lavadora.save');
    Route::get('/lavadoras/{id}', [LavanderiaController::class, 'detalleLavadoras'])->name('detalleLavadoras');
    Route::post('/lavadoras/{id}/actualizar', [LavanderiaController::class, 'actualizarEstadoLavadora'])->name('actualizarEstadoLavadora');

//Secadoras
    Route::get('/equiposLavanderia/secadoras', [LavanderiaController::class, 'secadoras'])->name('secadoras'); //Vista de Secadoras
    Route::get('/equiposLavanderia/secadoras/create', [LavanderiaController::class, 'createSecadora'])->name('secadora.create');
    Route::post('/equiposLavanderia/secadoras/create/save', [LavanderiaController::class, 'saveSecadora'])->name('secadora.save');
    Route::get('/secadoras/{id}', [LavanderiaController::class, 'detalleSecadoras'])->name('detalleSecadoras');
    Route::post('/secadoras/{id}/actualizar', [LavanderiaController::class, 'actualizarEstadoSecadora'])->name('actualizarEstadoSecadora');

//Reporteria
    Route::get('/menuAdmin/Conta', [LavanderiaController::class, 'menuContabilidad'])->name('Conta'); //Vista de Contabilidad
    Route::get('/Conta/Insumos', [LavanderiaController::class, 'insumos'])->name('inventario.insumos');
    Route::post('/Conta/Insumos/agregar', [LavanderiaController::class, 'agregarCantidad'])->name('inventario.agregarCantidad');
    Route::get('/Conta/cierre-diario', [CierreDiarioController::class, 'index'])->name('cierre_diario.index');
    Route::post('/Conta/cierre-diario', [CierreDiarioController::class, 'store'])->name('cierre_diario.store');
    Route::get('/Conta/cierre-diario/historico', [CierreDiarioController::class, 'historico'])->name('cierre_diario.historico');
    Route::get('/Conta/cierre-diario/historico/pdf', [CierreDiarioController::class, 'historicoPDF'])->name('cierre_mensual.pdf');
    Route::get('/Conta/cierre-diario/historico/pdf/{id}', [CierreDiarioController::class, 'detallePDF'])->name('cierre_diario.pdf');
    Route::get('/menuLavan/historial-pedidos/pedido/{id}/exportar-pdf', [LavanderiaController::class, 'exportarPedidoPDF'])->name('pedido.exportar.pdf');
});
