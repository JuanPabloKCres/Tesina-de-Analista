<?php

/*
Route::get('/', function () {
   return view('/auth/login');
});
*/

//Route::resource('admin','PedidosController@notificaciones');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
   Route::resource('usuarios','UsersController');
   Route::resource('roles','RolesController');
   Route::resource('clientes','ClientesController');

   Route::resource('paises','PaisesController');
   Route::resource('provincias','ProvinciasController');
   Route::resource('localidades','LocalidadesController');
   Route::resource('rubros','RubrosController');

   Route::resource('tipoArticulos','TiposController');
   Route::resource('materiales','MaterialesController');
   Route::resource('talles','TallesController');
   Route::resource('insumos','InsumosController');             //Insumos
   Route::resource('insumos/obtenerCosto','InsumosController@obtenerCosto');             //Insumos
   Route::resource('articulos','ArticulosController');
   Route::resource('factura','FacturasController');
   Route::resource('comprobantes','ComprobantesController');
   /*************** EMAILS del FRONT ***************/
   Route::resource('mail','Email_NotificacionesController');

   Route::resource('colores','ColoresController');
   Route::resource('bancos','BancosController');         //Bancos
   Route::resource('responiva','ResponivaController');
   Route::resource('ivas','IvasController');

   Route::resource('estadisticas','EstadisticasController');
   Route::resource('proveedores','ProveedoresController');
   Route::resource('configuraciones','ConfigController');
   Route::resource('cajas','CajasController');
   Route::resource('movimientos','MovimientosController');
   Route::resource('pedidos','PedidosController');             //Pedidos para ventas de Articulos (se debitan insumos del stock)

   Route::resource('compras','ComprasController');             //Compras de Insumos
   Route::resource('unidades_medidas','UnidadesController');

   Route::resource('auditorias','AuditoriasController');       //solo redirecciona a la view de la tabla de auditorias

   /** Para administrar el Front: **/
   Route::resource('tipos','TiposParaFrontController');
   Route::resource('productos','ProductosParaFrontController');
   /*** *********************************************************/
   Route::get('tablaRegistros', ['uses' => 'CajasController@registrosCajas', 'as' => 'admin.cajas.registrosCajas']);
   Route::PUT('usuario/{usuarios}', ['uses' => 'UsersController@actPass', 'as' => 'usuario.actpass']);
});


Route::auth();

Route::resource('/','frontHomeController');
Route::resource('/tipos','frontTiposController');
Route::resource('/productos' , 'frontProductosController');

Route::get('/contacto', function () {
   return view('front.contacto.index');
});

Route::get('/institucional', function () {
   return view('front.institucional.index');
});


//Route::get('/home', 'HomeController@index');
/*************** EMAILS del FRONT ***************/
Route::resource('mail','MailController');
/** ********************************************/

// Authentication routes...
Route::get('admin/auth/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'admin.auth.login'
]);

