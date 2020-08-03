<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrito;
use App\Pdempresa;
use App\Cliente;

class CarritoController extends Controller
{

    public function index(Request $request)
        {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;
        $id = $request->id;

        /*Si esta vacia la variable busqueda que busque por categoria */
        if($id!=''){

            if($buscar==''){
                $carritos = Carrito::join('pdempresas','carritos.id_producto_empresa','=','pdempresas.id')
                ->join('productos','pdempresas.id_producto','productos.id')
                ->join('clientes','carritos.id_cliente','=','clientes.id')
                ->join('users','clientes.id_usuario','=','users.id')
                ->join('empresas','pdempresas.id_empresa','=','empresas.id')
                ->select('carritos.id','carritos.cantidad','carritos.total','clientes.nombres','empresas.nombre_empresa','productos.nombre_producto','pdempresas.precio')
                ->where('users.id', '=', $id)
                ->paginate(3);
            }
            else{
                $carritos = Carrito::join('pdempresas','carritos.id_producto_empresa','=','pdempresas.id')
                ->join('productos','pdempresas.id_producto','productos.id')
                ->join('clientes','carritos.id_cliente','=','clientes.id')
                ->join('users','clientes.id_usuario','=','users.id')
                ->join('empresas','pdempresas.id_empresa','=','empresas.id')
                ->select('carritos.id','carritos.cantidad','carritos.total','clientes.nombres','empresas.nombre_empresa','productos.nombre_producto','pdempresas.precio')
                ->where('users.id', '=', $id)
                ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
                ->paginate(3); 
            }

        }else{

            if($buscar==''){
                $carritos = Carrito::join('pdempresas','carritos.id_producto_empresa','=','pdempresas.id')
                ->join('productos','pdempresas.id_producto','productos.id')
                ->join('clientes','carritos.id_cliente','=','clientes.id')
                ->join('users','clientes.id_usuario','=','users.id')
                ->join('empresas','pdempresas.id_empresa','=','empresas.id')
                ->select('carritos.id','carritos.cantidad','carritos.total','clientes.nombres','empresas.nombre_empresa','productos.nombre_producto','pdempresas.precio')
                ->paginate(3);
            }
            else{
                $carritos = Carrito::join('pdempresas','carritos.id_producto_empresa','=','pdempresas.id')
                ->join('productos','pdempresas.id_producto','productos.id')
                ->join('clientes','carritos.id_cliente','=','clientes.id')
                ->join('users','clientes.id_usuario','=','users.id')
                ->join('empresas','pdempresas.id_empresa','=','empresas.id')
                ->select('carritos.id','carritos.cantidad','carritos.total','clientes.nombres','empresas.nombre_empresa','productos.nombre_producto','pdempresas.precio')
                ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
                ->paginate(3); 
            }

        }

        return [
            'pagination' => [
                'total' => $carritos->total(),
                'current_page' => $carritos->currentPage(),
                'per_page' => $carritos->perPage(),
                'last_page' => $carritos->lastPage(),
                'from' => $carritos->firstItem(),
                'to' => $carritos->lastItem(),
            ],
            'carritos' => $carritos
        ];
        }

        public function destroy(Request $request,$id){
        
            if (!$request->ajax()) return redirect('/');
            $carrito = Carrito::findOrFail($id);
            $carrito->delete();
    
        }
    
}
