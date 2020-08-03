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

//rutas para usuarios no registrados
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@home')->name('inicio');//controlador de login
    Route::get('/iniciar','Auth\LoginController@Login');//controlador de login
    Route::post('/login', 'Auth\LoginController@iniciar')->name('login');
    Route::get('/registrar', 'Auth\RegisterController@registrar')->name('registrar');
    Route::post('/crear', 'Auth\RegisterController@create')->name('create');
    
});

//rutas para usuarios registrados
Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::get('/micrositio', function () {
        return view('micrositio/micrositio');
    })->name('micrositio');

    //rutas para administrador
    Route::group(['middleware'=>['Administrador']],function(){
    /**Rutas para llamas a los controladores de categorias, y articulos con respectivos crud**/
    Route::get('/categoria', 'CategoriaController@index');//mostrar categorias
    Route::post('/categoria/registrar/', 'CategoriaController@store');//gurdar nueva categoria
    Route::put('/categoria/actualizar/{id}', 'CategoriaController@update');//acutlizar ctegoria
    Route::put('/categoria/desactivar/{id}', 'CategoriaController@desactivar');//desactivaar categoria
    Route::put('/categoria/activar/{id}', 'CategoriaController@activar');//activr categoria
    Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');//seleccionar categoria desde articulos

    Route::get('/articulo', 'ProductoController@index');//mostrar articulos
    Route::post('/articulo/registrar/', 'ProductoController@store');//guardar nuevo articulo
    Route::post('/articulo/actualizar/', 'ProductoController@update');//actualizar articulo
    Route::put('/articulo/desactivar/{id}', 'ProductoController@desactivar');//deactivar articulo
    Route::put('/articulo/activar/{id}', 'ProductoController@activar');//activar articulo
    Route::get('/articulo/selectProducto', 'ProductoController@selectProducto');//mostrar articulos

    Route::get('/servicio', 'ServicioController@index');//mostrar articulos
    Route::post('/servicio/registrar/', 'ServicioController@store');//guardar nuevo articulo
    Route::post('/servicio/actualizar/', 'ServicioController@update');//actualizar articulo
    Route::put('/servicio/desactivar/{id}', 'ServicioController@desactivar');//deactivar articulo
    Route::put('/servicio/activar/{id}', 'ServicioController@activar');//activar articulo
    Route::get('/servicio/selectServicio', 'ServicioController@selectServicio');//mostrar articulos

    Route::get('/usuario', 'UserController@index');//mostrar articulos
    Route::post('/usuario/registrar/', 'UserController@store');//guardar nuevo articulo
    Route::put('/usuario/actualizar/{id}', 'UserController@update');//actualizar articulo
    Route::put('/usuario/desactivar/{id}', 'UserController@desactivar');//deactivar articulo
    Route::put('/usuario/activar/{id}', 'UserController@activar');//activar articulo
    Route::get('/usuario/selectUsuario', 'UserController@selectUser');//seleccionar categoria desde articulos
    Route::get('/usuario/selectUsuarioC', 'UserController@selectCliente');//seleccionar clientes activos

    Route::get('/vendedor', 'VendedorController@index');//mostrar articulos
    Route::post('/vendedor/registrar/', 'VendedorController@store');//guardar nuevo articulo
    Route::put('/vendedor/actualizar/{id}', 'VendedorController@update');//guardar nuevo articulo
    Route::get('/vendedor/selectVendedor', 'VendedorController@selectVendedor');//seleccionar categoria desde articulos

    Route::get('/cliente', 'ClienteController@index');//mostrar clientes
    Route::post('/cliente/registrar/', 'ClienteController@store');//guardar nuevo cliente
    Route::put('/cliente/actualizar/{id}', 'ClienteController@update');//guardar nuevo cliente

    Route::get('/empresa', 'EmpresaController@index');//mostrar articulos
    Route::get('/empresa/selectEmpresa', 'EmpresaController@selectEmpresa');//mostrar articulos
    Route::post('/empresa/registrar/', 'EmpresaController@store');//guardar nuevo articulo
    Route::post('/empresa/actualizar/', 'EmpresaController@update');//guardar nuevo articulo

    Route::get('/pdempresa', 'PdempresaController@index');//mostrar articulos
    Route::post('/pdempresa/registrar', 'PdempresaController@store');//mostrar articulos
    Route::put('/pdempresa/actualizar/{id}', 'PdempresaController@update');//guardar nuevo articulo
    Route::delete('/pdempresa/destroy/{id}', 'PdempresaController@destroy');
    
    Route::get('/seempresa', 'SeempresaController@index');//mostrar articulos
    Route::post('/seempresa/registrar', 'SeempresaController@store');//mostrar articulos
    Route::put('/seempresa/actualizar/{id}', 'SeempresaController@update');//guardar nuevo articulo
    Route::delete('/seempresa/destroy/{id}', 'SeempresaController@destroy');
    
    });    

    //rutas para clientes
    Route::group(['middleware'=>['Clientes']],function(){
        Route::get('/cuentav/{id}', 'ClienteController@showcliente');//mostrar articulos
        Route::put('/cliente/actualizar/{id}', 'ClienteController@update');//guardar nuevo articulo
        Route::get('/comprasp', 'VentaController@index_comprasp');//mostrar clientes
        Route::get('/comprass', 'VentaController@index_comprass');//mostrar clientes
        Route::get('/carrito', 'CarritoController@index')->name('carrito');//mostrar clientes
        Route::delete('/carrito/destroy/{id}', 'CarritoController@destroy');
       // Route::get('/micrositio', 'EmpresaController@index_micrositio');
    });    

    //rutas para vendedores
    Route::group(['middleware'=>['Vendedor']],function(){
        Route::get('/cuenta/{id}', 'VendedorController@showvendedor');//mostrar articulos
        Route::put('/vendedor/actualizar/{id}', 'VendedorController@update');//guardar nuevo articulo
        Route::get('/ventap', 'VentaController@index_productos');//mostrar clientes
        Route::get('/ventas', 'VentaController@index_servicios');//mostrar clientes
        Route::delete('/venta/destroy/{id}', 'VentaController@destroy');
        Route::get('/mapa', 'EmpresaController@showproducto');//mostrar articulos
        Route::get('/micrositio_servicios', 'SeempresaController@micrositios_empresa');//mostrar articulos
        Route::get('/micrositio_productos', 'PdempresaController@micrositiop_empresa');//mostrar articulos
        Route::get('/index_micrositio','EmpresaController@index_micrositio');
    
    });    


});