<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Vpdetalle;
use App\Productos;
use App\Pdempresa;
use App\Servicio;
use App\Vsdetalle;
use App\Seempresa;
use App\Vendedores;
use App\User;
use App\Empresa;


class VentaController extends Controller
{
    
    public function index_productos(Request $request)
    {
     /*determinar si es una peticion ajax para seguirdad*/
     if (!$request->ajax()) return redirect('/');

     $buscar =  $request->buscar;
     $criterio = $request->criterio;
     $id = $request->id;

     /*Si esta vacia la variable busqueda que busque por categoria */
     if($id!=''){

        if($buscar==''){
            $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
            ->join('clientes','ventas.id_cliente','clientes.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
            ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
            ->join('productos','pdempresas.id_producto','=','productos.id')
            
            
           
            ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
            ->where('users.id', '=', $id)
            ->paginate(3);
        }
        else{
            $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
            ->join('clientes','ventas.id_cliente','clientes.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
            ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
            ->join('productos','pdempresas.id_producto','=','productos.id')
            
            
           
            ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
            ->where('users.id', '=', $id)
            ->where('clientes.'.$criterio, 'like', '%'. $buscar .'%')
            
            
            ->paginate(3); 
        }

     }else{

        if($buscar==''){
            $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
            ->join('clientes','ventas.id_cliente','clientes.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
            ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
            ->join('productos','pdempresas.id_producto','=','productos.id')
            
            
           
            ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
           
            ->paginate(3);
        }
        else{
            $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
            ->join('clientes','ventas.id_cliente','clientes.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
            ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
            ->join('productos','pdempresas.id_producto','=','productos.id')
            
            
           
            ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
            ->where('clientes.'.$criterio, 'like', '%'. $buscar .'%')
            
            ->paginate(3); 
        }

    }

     return [
         'pagination' => [
             'total' => $ventas->total(),
             'current_page' => $ventas->currentPage(),
             'per_page' => $ventas->perPage(),
             'last_page' => $ventas->lastPage(),
             'from' => $ventas->firstItem(),
             'to' => $ventas->lastItem(),
         ],
         'ventas' => $ventas
     ];
 }

    public function destroy(Request $request,$id){
        
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($id);
        $venta->delete();

    }

 
public function index_servicios(Request $request)
{
 /*determinar si es una peticion ajax para seguirdad*/
 if (!$request->ajax()) return redirect('/');

 $buscar =  $request->buscar;
 $criterio = $request->criterio;
 $id = $request->id;

 /*Si esta vacia la variable busqueda que busque por categoria */
 if($id!=''){

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('users.id', '=', $id)
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('users.id', '=', $id)
        ->where('clientes.'.$criterio, 'like', '%'. $buscar .'%')
        
        
        ->paginate(3); 
    }

 }else{

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('clientes.'.$criterio, 'like', '%'. $buscar .'%')
        
        ->paginate(3); 
    }

}

 return [
     'pagination' => [
         'total' => $ventas->total(),
         'current_page' => $ventas->currentPage(),
         'per_page' => $ventas->perPage(),
         'last_page' => $ventas->lastPage(),
         'from' => $ventas->firstItem(),
         'to' => $ventas->lastItem(),
     ],
     'ventas' => $ventas
 ];
}




public function index_comprasp(Request $request)
{
 /*determinar si es una peticion ajax para seguirdad*/
 if (!$request->ajax()) return redirect('/');

 $buscar =  $request->buscar;
 $criterio = $request->criterio;
 $id = $request->id;

 /*Si esta vacia la variable busqueda que busque por categoria */
 if($id!=''){

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
        ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
        ->join('empresas','pdempresas.id_empresa','=','empresas.id')
        ->join('productos','pdempresas.id_producto','=','productos.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
        ->where('users.id', '=', $id)
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
        ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
        ->join('empresas','pdempresas.id_empresa','=','empresas.id')
        ->join('productos','pdempresas.id_producto','=','productos.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
        ->where('users.id', '=', $id)
        ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
        
        
        ->paginate(3); 
    }

 }else{

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
        ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
        ->join('empresas','pdempresas.id_empresa','=','empresas.id')
        ->join('productos','pdempresas.id_producto','=','productos.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
       
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vpdetalles','ventas.id','=','vpdetalles.id_venta')
        ->join('pdempresas','vpdetalles.id_producto_empresa','=','pdempresas.id')
        ->join('empresas','pdempresas.id_empresa','=','empresas.id')
        ->join('productos','pdempresas.id_producto','=','productos.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vpdetalles.cantidad','vpdetalles.precio','productos.nombre_producto')
        ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
        
        ->paginate(3); 
    }

}

 return [
     'pagination' => [
         'total' => $ventas->total(),
         'current_page' => $ventas->currentPage(),
         'per_page' => $ventas->perPage(),
         'last_page' => $ventas->lastPage(),
         'from' => $ventas->firstItem(),
         'to' => $ventas->lastItem(),
     ],
     'ventas' => $ventas
 ];
}


public function index_comprass(Request $request)
{
 /*determinar si es una peticion ajax para seguirdad*/
 if (!$request->ajax()) return redirect('/');

 $buscar =  $request->buscar;
 $criterio = $request->criterio;
 $id = $request->id;

 /*Si esta vacia la variable busqueda que busque por categoria */
 if($id!=''){

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('empresas','seempresas.id_empresa','=','empresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('users.id', '=', $id)
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('empresas','seempresas.id_empresa','=','empresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('users.id', '=', $id)
        ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
        
        
        ->paginate(3); 
    }

 }else{

    if($buscar==''){
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
        ->join('clientes','ventas.id_cliente','clientes.id')
        ->join('users','clientes.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('empresas','seempresas.id_empresa','=','empresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->paginate(3);
    }
    else{
        $ventas = Venta::join('vendedores','ventas.id_vendedor','=','vendedores.id')
       ->join('clientes','ventas.id_cliente','clientes.id')
       ->join('users','clientes.id_usuario','=','users.id')
        ->join('vsdetalles','ventas.id','=','vsdetalles.id_venta')
        ->join('seempresas','vsdetalles.id_servicio_empresa','=','seempresas.id')
        ->join('empresas','seempresas.id_empresa','=','empresas.id')
        ->join('servicios','seempresas.id_servicio','=','servicios.id')
        
        
       
        ->select('ventas.id','ventas.total','clientes.nombres as cliente','vendedores.nombres as vendedor','empresas.nombre_empresa','vsdetalles.cantidad','vsdetalles.precio','servicios.nombre_servicio')
        ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
        
        ->paginate(3); 
    }

}

 return [
     'pagination' => [
         'total' => $ventas->total(),
         'current_page' => $ventas->currentPage(),
         'per_page' => $ventas->perPage(),
         'last_page' => $ventas->lastPage(),
         'from' => $ventas->firstItem(),
         'to' => $ventas->lastItem(),
     ],
     'ventas' => $ventas
 ];
}













}
