<?php

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


//Route::get('/', function () {
//    return view('welcome');
//});
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}


Route::get('/home', 'HomeController@avisos');
Route::get('plantillas/master', ['as' => 'plantilla', 'uses' => 'ConfigController@plantilla']);

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::middleware(['auth'])->group(function () 
{
	//Productos
	Route::post('productos', ['as' => 'productos.store', 'uses' => 'ProductoController@store']);

  Route::get('productos', ['as' => 'productos.index', 'uses' => 'ProductoController@index', 'middleware' => ['permission:productos.index']]);

  Route::get('productos/create', ['as' => 'productos.create', 'uses' => 'ProductoController@create', 'middleware' => ['permission:productos.create']]);

  Route::get('productos/{productos}', ['as' => 'productos.show', 'uses' => 'ProductoController@show']);

  Route::delete('productos/{productos}', ['as' => 'productos.destroy', 'uses' => 'ProductoController@destroy', 'middleware' => ['permission:productos.destroy']]);

  Route::patch('productos/{productos}', ['as' => 'productos.update', 'uses' => 'ProductoController@update']);

  Route::get('productos/{productos}/edit', ['as' => 'productos.edit', 'uses' => 'ProductoController@edit', 'middleware' => ['permission:productos.edit']]);

   Route::get('almacen/productos/stock', ['as' => 'productos.stock', 'uses' => 'ProductoController@stock', 'middleware' => ['permission:productos.stock']]);

		//CATEGORIAS
	Route::post('categorias', ['as' => 'categorias.store', 'uses' => 'CategoriaController@store']);

  Route::get('categorias', ['as' => 'categorias.index', 'uses' => 'CategoriaController@index', 'middleware' => ['permission:categorias.index']]);

  Route::get('categorias/create', ['as' => 'categorias.create', 'uses' => 'CategoriaController@create', 'middleware' => ['permission:categorias.create']]);

  Route::get('categorias/{categorias}', ['as' => 'categorias.show', 'uses' => 'CategoriaController@show']);

  Route::delete('categorias/{categorias}', ['as' => 'categorias.destroy', 'uses' => 'CategoriaController@destroy', 'middleware' => ['permission:categorias.destroy']]);

  Route::patch('categorias/{categorias}', ['as' => 'categorias.update', 'uses' => 'CategoriaController@update']);

  Route::get('categorias/{categorias}/edit', ['as' => 'categorias.edit', 'uses' => 'CategoriaController@edit', 'middleware' => ['permission:categorias.edit']]);

		//MARCAS
	Route::post('marcas', ['as' => 'marcas.store', 'uses' => 'MarcaController@store']);

  Route::get('marcas', ['as' => 'marcas.index', 'uses' => 'MarcaController@index', 'middleware' => ['permission:marcas.index']]);

  Route::get('marcas/create', ['as' => 'marcas.create', 'uses' => 'MarcaController@create', 'middleware' => ['permission:marcas.create']]);

  Route::get('marcas/{marcas}', ['as' => 'marcas.show', 'uses' => 'MarcaController@show']);

  Route::delete('marcas/{marcas}', ['as' => 'marcas.destroy', 'uses' => 'MarcaController@destroy', 'middleware' => ['permission:marcas.destroy']]);

  Route::patch('marcas/{marcas}', ['as' => 'marcas.update', 'uses' => 'MarcaController@update']);

  Route::get('marcas/{marcas}/edit', ['as' => 'marcas.edit', 'uses' => 'MarcaController@edit', 'middleware' => ['permission:marcas.edit']]);

		//CLIENTES
	Route::post('clientes', ['as' => 'clientes.store', 'uses' => 'ClienteController@store']);

  Route::get('clientes', ['as' => 'clientes.index', 'uses' => 'ClienteController@index', 'middleware' => ['permission:clientes.index']]);

  Route::get('clientes/create', ['as' => 'clientes.create', 'uses' => 'ClienteController@create', 'middleware' => ['permission:clientes.create']]);

  Route::get('clientes/{clientes}', ['as' => 'clientes.show', 'uses' => 'ClienteController@show']);

  Route::delete('clientes/{clientes}', ['as' => 'clientes.destroy', 'uses' => 'ClienteController@destroy', 'middleware' => ['permission:clientes.destroy']]);

  Route::patch('clientes/{clientes}', ['as' => 'clientes.update', 'uses' => 'ClienteController@update']);

  Route::get('clientes/{clientes}/edit', ['as' => 'clientes.edit', 'uses' => 'ClienteController@edit', 'middleware' => ['permission:clientes.edit']]);

		//PROVEEDORES
	Route::post('proveedores', ['as' => 'proveedores.store', 'uses' => 'ProveedorController@store']);

  Route::get('proveedores', ['as' => 'proveedores.index', 'uses' => 'ProveedorController@index', 'middleware' => ['permission:proveedores.index']]);

  Route::get('proveedores/create', ['as' => 'proveedores.create', 'uses' => 'ProveedorController@create', 'middleware' => ['permission:proveedores.create']]);

  Route::get('proveedores/{proveedores}', ['as' => 'proveedores.show', 'uses' => 'ProveedorController@show']);

  Route::delete('proveedores/{proveedores}', ['as' => 'proveedores.destroy', 'uses' => 'ProveedorController@destroy', 'middleware' => ['permission:proveedores.destroy']]);

  Route::patch('proveedores/{proveedores}', ['as' => 'proveedores.update', 'uses' => 'ProveedorController@update']);

  Route::get('proveedores/{proveedores}/edit', ['as' => 'proveedores.edit', 'uses' => 'ProveedorController@edit', 'middleware' => ['permission:proveedores.edit']]);

		//ROLES
	Route::post('admin/roles', ['as' => 'roles.store', 'uses' => 'RoleController@store']);

  Route::get('admin/roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:admin/roles.index']]);

  Route::get('admin/roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:admin/roles.create']]);

  Route::get('admin/roles/{roles}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);

  Route::delete('admin/roles/{roles}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:admin/roles.destroy']]);

  Route::patch('admin/roles/{roles}', ['as' => 'roles.update', 'uses' => 'RoleController@update']);

  Route::get('admin/roles/{roles}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:admin/roles.edit']]);

			//Users
	Route::post('admin/users', ['as' => 'users.store', 'uses' => 'UserController@store']);

  Route::get('admin/users', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['permission:admin/users.index']]);

  Route::get('admin/users/create', ['as' => 'users.create', 'uses' => 'UserController@create', 'middleware' => ['permission:admin/users.create']]);

  Route::get('admin/users/{users}', ['as' => 'users.show', 'uses' => 'UserController@show']);

  Route::delete('admin/users/{users}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['permission:admin/users.destroy']]);

  Route::patch('admin/users/{users}', ['as' => 'users.update', 'uses' => 'UserController@update']);

  Route::get('admin/users/{users}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['permission:admin/users.edit']]);

	Route::get('user/profile/{user}', 'UserController@editProfile')->name('user.edit.profile');;
	Route::patch('user/profile/{user}', 'UserController@updateProfile')->name('user.update.profile');;
	Route::resource('admin/configurations', 'ConfigurationController');
	Route::get('/admin/user/{user}/menu', 'UserController@menu')->name('user.menu');;
	Route::patch('/admin/user/menu/{user}', 'UserController@menuStore')->name('users.menuStore');
	Route::get('/admin/option/create/{padre}', 'OptionMenuController@create');
	Route::get('/admin/option/orden', 'OptionMenuController@updateOrden');
	Route::post('/admin/option/orden', 'OptionMenuController@updateOrden');
	Route::resource('/admin/option',"OptionMenuController");

	//CONTACTOS
	Route::resource('contactos', 'ContactoController');

		//DOMICILIOS
	Route::resource('domicilios', 'DomicilioController');

		//Contacto Proveedor
	
	Route::resource('contactoProveedors', 'ContactoProveedorController');

	//DOMICILIO Proveedor
	Route::resource('domicilioProveedors', 'DomicilioProveedorController');


		//VENTA
	Route::post('venta', ['as' => 'venta.store', 'uses' => 'VentaController@store']);

  Route::get('venta', ['as' => 'venta.index', 'uses' => 'VentaController@index', 'middleware' => ['permission:venta.index']]);

  Route::get('venta/create', ['as' => 'venta.create', 'uses' => 'VentaController@create', 'middleware' => ['permission:venta.create']]);
Route::get('venta/reporte', 'VentaController@filtrar');
  Route::get('venta/{ventum}', ['as' => 'venta.show', 'uses' => 'VentaController@show']);

  Route::delete('venta/{ventum}', ['as' => 'venta.destroy', 'uses' => 'VentaController@destroy', 'middleware' => ['permission:venta.destroy']]);

  Route::patch('venta/{ventum}', ['as' => 'venta.update', 'uses' => 'VentaController@update']);

  Route::get('venta/{ventum}/edit', ['as' => 'venta.edit', 'uses' => 'VentaController@edit', 'middleware' => ['permission:venta.edit']]);

	Route::get('venta/ticke/{id}', ['as' => 'ticke', 'uses' => 'VentaController@ticke']);

		//MENSUAL
	Route::post('mensual', ['as' => 'mensual.store', 'uses' => 'MensualController@store']);

  Route::get('mensual', ['as' => 'mensual.index', 'uses' => 'MensualController@index', 'middleware' => ['permission:mensual.index']]);

  Route::get('mensual/create', ['as' => 'mensual.create', 'uses' => 'MensualController@create', 'middleware' => ['permission:mensual.create']]);

  Route::get('mensual/{mensual}', ['as' => 'mensual.show', 'uses' => 'MensualController@show']);

  Route::delete('mensual/{mensual}', ['as' => 'mensual.destroy', 'uses' => 'MensualController@destroy', 'middleware' => ['permission:mensual.destroy']]);

  Route::patch('mensual/{mensual}', ['as' => 'mensual.update', 'uses' => 'MensualController@update']);

  Route::get('mensual/{mensual}/edit', ['as' => 'mensual.edit', 'uses' => 'MensualController@edit', 'middleware' => ['permission:mensual.edit']]);

	

		//PRESUPUESTO
	Route::post('presupuesto/store', 'PresupuestoController@store')->name('presupuesto.store')
		->middleware('permission:presupuesto.create');

	Route::get('presupuesto', 'PresupuestoController@index')->name('presupuesto.index')
		->middleware('permission:presupuesto.index');

	Route::get('presupuesto/create', 'PresupuestoController@create')->name('presupuesto.create')
		->middleware('permission:presupuesto.create');

	Route::put('presupuesto/{presupuesto}', 'PresupuestoController@update')->name('presupuesto.update')
		->middleware('permission:presupuesto.edit');

	Route::get('presupuesto/{presupuesto}', 'PresupuestoController@show')->name('presupuesto.show')
		->middleware('permission:presupuesto.show');

	Route::delete('presupuesto/{presupuesto}', 'PresupuestoController@destroy')->name('presupuesto.destroy')
		->middleware('permission:presupuesto.destroy');

	Route::get('presupuesto/{presupuesto}/edit', 'PresupuestoController@edit')->name('presupuesto.edit')
		->middleware('permission:presupuesto.edit');

		//INGRESO

	Route::post('ingreso', ['as' => 'ingreso.store', 'uses' => 'IngresoController@store']);

  Route::get('ingreso', ['as' => 'ingreso.index', 'uses' => 'IngresoController@index', 'middleware' => ['permission:ingreso.index']]);

  Route::get('ingreso/create', ['as' => 'ingreso.create', 'uses' => 'IngresoController@create', 'middleware' => ['permission:ingreso.create']]);

  Route::get('ingreso/{ingreso}', ['as' => 'ingreso.show', 'uses' => 'IngresoController@show']);

  Route::delete('ingreso/{ingreso}', ['as' => 'ingreso.destroy', 'uses' => 'IngresoController@destroy', 'middleware' => ['permission:ingreso.destroy']]);

  Route::patch('ingreso/{ingreso}', ['as' => 'ingreso.update', 'uses' => 'IngresoController@update']);

  Route::get('ingreso/{ingreso}/edit', ['as' => 'ingreso.edit', 'uses' => 'IngresoController@edit', 'middleware' => ['permission:ingreso.edit']]);

	Route::get('ingreso/ticke/{id}', ['as' => 'ticke', 'uses' => 'IngresoController@ticke']);

		//ESTIMACION
	Route::post('estimacion', ['as' => 'estimacion.store', 'uses' => 'EstimacionController@store']);

  Route::get('estimacion', ['as' => 'estimacion.index', 'uses' => 'EstimacionController@index', 'middleware' => ['permission:estimacion.index']]);

  Route::get('estimacion/create', ['as' => 'estimacion.create', 'uses' => 'EstimacionController@create', 'middleware' => ['permission:estimacion.create']]);

  Route::get('estimacion/{estimacion}', ['as' => 'estimacion.show', 'uses' => 'EstimacionController@show']);

  Route::delete('estimacion/{estimacion}', ['as' => 'estimacion.destroy', 'uses' => 'EstimacionController@destroy', 'middleware' => ['permission:estimacion.destroy']]);

  Route::patch('estimacion/{estimacion}', ['as' => 'estimacion.update', 'uses' => 'EstimacionController@update']);

  Route::get('estimacion/{estimacion}/edit', ['as' => 'estimacion.edit', 'uses' => 'EstimacionController@edit', 'middleware' => ['permission:estimacion.edit']]);
	Route::get('estimacionventa/{id}','EstimacionController@estimacionventa');
    Route::post('crearventa', 'EstimacionController@crearventa');

    //DEVOLUCION
   Route::post('devolucion/store', ['as' => 'devolucion.store', 'uses' => 'DevolucionController@devolucion']);
    Route::get('devolucion-inicio', ['as' => 'devolucion.index', 'uses' => 'DevolucionController@index']);
    Route::get('devolucion/show/{id}', ['as' => 'devolucion.show', 'uses' => 'DevolucionController@show']);

      //DEVOLUCION PRODUCTO
  
  Route::post('devolucionproducto', ['as' => 'devolucionproducto.store', 'uses' => 'DevolucionProductoController@store']);

  Route::get('devolucionproducto', ['as' => 'devolucionproducto.index', 'uses' => 'DevolucionProductoController@index', 'middleware' => ['permission:devolucionproducto.index']]);

  Route::get('devolucionproducto/create', ['as' => 'devolucionproducto.create', 'uses' => 'DevolucionProductoController@create', 'middleware' => ['permission:devolucionproducto.create']]);

  Route::get('devolucionproducto/{devolucionproducto}', ['as' => 'devolucionproducto.show', 'uses' => 'DevolucionProductoController@show']);

  Route::delete('devolucionproducto/{devolucionproducto}', ['as' => 'devolucionproducto.destroy', 'uses' => 'DevolucionProductoController@destroy', 'middleware' => ['permission:devolucionproducto.destroy']]);

  //Pagos
	Route::post('pagos/store', 'PagoController@store')->name('pagos.store')
		->middleware('permission:pagos.create');

	Route::get('pagos', 'PagoController@index')->name('pagos.index')
		->middleware('permission:pagos.index');

	Route::get('pagos/create', 'PagoController@create')->name('pagos.create')
		->middleware('permission:pagos.create');

	Route::put('pagos/{pago}', 'PagoController@update')->name('pagos.update')
		->middleware('permission:pagos.edit');

	Route::get('pagos/{pago}', 'PagoController@show')->name('pagos.show')
		->middleware('permission:pagos.show');

	Route::delete('pagos/{pago}', 'PagoController@destroy')->name('pagos.destroy')
		->middleware('permission:pagos.destroy');

	Route::get('pagos/{pago}/edit', 'PagoController@edit')->name('pagos.edit')
		->middleware('permission:pagos.edit');

     Route::post('pago', ['as' => 'pago.dinero', 'uses' => 'MensualPagoController@pago']);
  

		//REPORTES
    Route::get('/venta/pdf/{id_venta}', 'VentaController@pdf')->name('venta_pdf');
Route::get('/productos/pdf/{idproducto}', 'ProductoController@pdf')->name('productos_pdf');

Route::get('/ingreso/pdf/{idingreso}', 'IngresoController@pdf')->name('ingreso_pdf');
Route::get('/mensual/pdf/{idmensual}', 'MensualController@pdf')->name('mensual_pdf');
Route::get('/devolucion/pdf/{iddevolucion}', 'DevolucionController@pdf')->name('devolucion_pdf');
Route::get('/devolucionproducto/pdf/{iddevolucionproducto}', 'DevolucionProductoController@pdf')->name('devolucionproducto_pdf');
Route::get('/estimacion/pdf/{idestimacion}', 'EstimacionController@pdf')->name('estimacion_pdf');
Route::get('/presupuesto/pdf/{idpresupuesto}', 'PresupuestoController@pdf')->name('recaudacion_pdf');

//CONFIGURACION
Route::get('config', ['as' => 'configuracion', 'uses' => 'ConfigController@index','middleware' => ['permission:configuracion_menu|configuracion_todo|sistema_entero']]);
  Route::post('config/create', ['as' => 'config.create', 'uses' => 'ConfigController@create']);
  Route::get('config/{id}/editar', ['as' => 'configuracion.editar', 'uses' => 'ConfigController@edit','middleware' => ['permission:configuracion_editar|configuracion_todo|sistema_entero']]);
  Route::patch('config/{id}', ['as' => 'configuracion.update', 'uses' => 'ConfigController@update']);
  
  Route::get('manual', ['as' => 'manual', 'uses' => 'ConfigController@manual']);

   Route::get('/', ['as' => 'home', 'uses' => 'HomeController@avisos']);




	});





Route::post('mensualpago/store', ['as' => 'mensualpago.store', 'uses' => 'MensualPagoController@mensualpago']);
    Route::get('mensualpago-inicio', ['as' => 'mensualpago.index', 'uses' => 'MensualPagoController@index']);
    Route::get('mensualpago/show/{id}', ['as' => 'mensualpago.show', 'uses' => 'MensualPagoController@show']);
Route::resource('disminucionPrecios', 'DisminucionPrecioController');

Route::resource('aumentoPrecios', 'AumentoPrecioController');
Route::resource('estadisticaPrecios', 'EstadisticaPrecioController');



Route::resource('aumentoMarcaPrecios', 'AumentoMarcaPrecioController');

Route::resource('aumentoProductoPrecios', 'AumentoProductoPrecioController');

Route::resource('disminucionCategoriaPrecios', 'DisminucionCategoriaPrecioController');

Route::resource('disminucionMarcaPrecios', 'DisminucionMarcaPrecioController');


Route::get('listado_compras', 'GraficasCompraController@index');
Route::get('listado_graficas', 'GraficasController@index');
Route::get('grafica_registros/{anio}/{mes}', 'GraficasController@registros_mes');
Route::get('grafica_compras/{anio}/{mes}', 'GraficasCompraController@compras_mes');
Route::get('grafica_publicaciones', 'GraficasController@total_publicaciones');
  Route::get('/dashboard','DashboardController'); 

Route::resource('pagos', 'PagoController');

  Route::get('/arqueo', 'ArqueController@index')->name('arqueo.index');
    Route::get('/arqueo/tabla', 'ArqueController@tabla')->name('arqueo.tabla');
    Route::get('/arqueo/detalle/{id}', 'ArqueController@show')->name('arqueo.show');
    Route::get('/arqueo/tabla/{id}', 'ArqueController@tablashow')->name('arqueo.show.tabla');
    Route::put('/arqueo/update/{id}', 'ArqueController@update')->name('arqueo.update');
    Route::post('/arqueo/store', 'ArqueController@store')->name('arqueo.store');
    