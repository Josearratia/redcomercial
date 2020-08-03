<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Pdempresa;
use App\Empresa;
use App\Categoria; 
class PdempresaController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;
        $id = $request->id;


        if($id!=''){
                if($buscar==''){
                    $pdempresas = Pdempresa::join('empresas','pdempresas.id_empresa','=','empresas.id')
                    ->join('vendedores','empresas.id_vendedor','=','vendedores.id')
                    ->join('users','vendedores.id_usuario','=','users.id')
                    ->join('productos','pdempresas.id_producto','=','productos.id')
                    ->join('categorias','productos.id_categoria','=','categorias.id')
                    ->select('pdempresas.id','pdempresas.id_empresa','pdempresas.id_producto','pdempresas.stock','pdempresas.precio','empresas.nombre_empresa','productos.nombre_producto','productos.imagen_producto','categorias.nombre_categoria')
                    ->where('users.id', '=', $id)
                    ->paginate(3);
                } else{
                    $pdempresas = Pdempresa::join('empresas','pdempresas.id_empresa','=','empresas.id')
                    ->join('vendedores','empresas.id_vendedor','=','vendedores.id')
                    ->join('users','vendedores.id_usuario','=','users.id')
                    ->join('productos','pdempresas.id_producto','=','productos.id')
                    ->join('categorias','productos.id_categoria','=','categorias.id')
                    ->select('pdempresas.id','pdempresas.id_empresa','pdempresas.id_producto','pdempresas.stock','pdempresas.precio','empresas.nombre_empresa','productos.nombre_producto','productos.imagen_producto','categorias.nombre_categoria')
                    ->where('users.id', '=', $id)
                    ->where('productos.'.$criterio, 'like', '%'. $buscar .'%')
                    ->paginate(3); 
                }

            }else{
                    /*Si esta vacia la variable busqueda que busque por categoria */
                if($buscar==''){
                    $pdempresas = Pdempresa::join('empresas','pdempresas.id_empresa','=','empresas.id')
                    ->join('productos','pdempresas.id_producto','=','productos.id')
                    ->join('categorias','productos.id_categoria','=','categorias.id')
                    ->select('pdempresas.id','pdempresas.id_empresa','pdempresas.id_producto','pdempresas.stock','pdempresas.precio','empresas.nombre_empresa','productos.nombre_producto','productos.imagen_producto','categorias.nombre_categoria')
                    ->orderBy('pdempresas.id', 'desc')->paginate(3);
                }
                else{
                    $pdempresas = Pdempresa::join('empresas','pdempresas.id_empresa','=','empresas.id')
                    ->join('productos','pdempresas.id_producto','=','productos.id')
                    ->join('categorias','productos.id_categoria','=','categorias.id')
                    ->select('pdempresas.id','pdempresas.id_empresa','pdempresas.id_producto','pdempresas.stock','pdempresas.precio','empresas.nombre_empresa','productos.nombre_producto','productos.imagen_producto','categorias.nombre_categoria')
                    ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
                    ->orderBy('pdempresas.id','desc')->paginate(3); 
                }
            //$categorias = Categoria::paginate(2);
        }
        return [
            'pagination' => [
                'total' => $pdempresas->total(),
                'current_page' => $pdempresas->currentPage(),
                'per_page' => $pdempresas->perPage(),
                'last_page' => $pdempresas->lastPage(),
                'from' => $pdempresas->firstItem(),
                'to' => $pdempresas->lastItem(),
            ],
            'pdempresas' => $pdempresas
        ];
    }

    /**FUNCION PARA ALAMCENAR NUEVO PRODUCTO**/
   public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Pdempresa();
        $producto->id_empresa = $request->id_empresa;
        $producto->id_producto = $request->id_producto;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->save();
    }

    /**FUNCION PARA ACUTLIZAR PRODUCTO**/
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Pdempresa::findOrFail($id);
        $producto->id_empresa = $request->id_empresa;
        $producto->id_producto = $request->id_producto;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->save();
        
    }

    public function destroy(Request $request, $id){
     
        if (!$request->ajax()) return redirect('/');
        
        $producto = Pdempresa::findOrFail($id);
        $producto->delete();

    }

    public function micrositiop_empresa(Request $request){
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;
        //return $request->all();
        $empresas = Pdempresa::join('empresas','pdempresas.id_empresa','=','empresas.id')
        ->join('productos','pdempresas.id_producto','=','productos.id')
        ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','empresas.logo','empresas.pais','empresas.ciudad','pdempresas.precio','pdempresas.stock','productos.nombre_producto','productos.imagen_producto')
        ->where('empresas.id','=',$id)->paginate(3);
        
        return [
            'pagination' => [
                'total' => $empresas->total(),
                'current_page' => $empresas->currentPage(),
                'per_page' => $empresas->perPage(),
                'last_page' => $empresas->lastPage(),
                'from' => $empresas->firstItem(),
                'to' => $empresas->lastItem(),
            ],
            'empresas' => $empresas
        ];
    
    }
    


}
