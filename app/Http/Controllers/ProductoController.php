<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*Si esta vacia la vriable busqueda que busque por categoria */
        if($buscar==''){
            $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
            ->select('productos.id','productos.id_categoria','productos.imagen_producto','productos.nombre_producto','categorias.nombre_categoria as nombre_categoria','productos.condicion')
            ->orderBy('productos.id', 'desc')->paginate(3);
        }
        else{
            $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
            ->select('productos.id','productos.id_categoria','productos.imagen_producto','productos.nombre_producto','categorias.nombre_categoria as nombre_categoria','productos.condicion')
            ->where('productos.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('productos.id','desc')->paginate(3); 
        }
        //$categorias = Categoria::paginate(2);

        return [
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' => $productos->perPage(),
                'last_page' => $productos->lastPage(),
                'from' => $productos->firstItem(),
                'to' => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    /**FUNCION PARA ALAMCENAR NUEVO PRODUCTO**/
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
       

        //return $request->all();
        $producto = new Producto();
        $producto->id_categoria = $request->id_categoria;
        $producto->nombre_producto = $request->nombre_producto;
        if ($request->hasFile('imagen')) {
        $path = Storage::disk('public')->put('image', $request->file('imagen'));
        $producto->imagen_producto = asset($path);    
        }
        $producto->condicion = '1';

        /*if($request->hasFile('imagen_producto')){
            $path =  Storage::disk('public')->put('img', $request->file('imagen_producto'));
            $producto->imagen_producto = 'asds';
        }*/
        
        $producto->save();
    }

    /**FUNCION PARA ACUTLIZAR PRODUCTO**/
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //return $request->all();
        $producto = Producto::findOrFail($request->id);
        $producto->id_categoria = $request->id_categoria;
  
        $producto->nombre_producto = $request->nombre_producto;
        
        if ($request->hasFile('imagen')) {
            //Storage::delete('438DI57eb13PVgeD0iBfxOMrH5aM230ZDVC30ODk.png');
            //unlink(storage_path('public\image\438DI57eb13PVgeD0iBfxOMrH5aM230ZDVC30ODk.png'));
            //unlink($request->imagen_anterior);
            $path = Storage::disk('public')->put('image', $request->file('imagen'));
            $producto->imagen_producto = asset($path);    
            }

        $producto->condicion = '1';
        $producto->save();
        /**/
    }

    /** FUNCION PARA DESACTIVAR CATEGORIA**/
    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($id);
        $producto->condicion = '0';
        $producto->save();
    }

    /**FUNCION PARA ACTIVAR CATEGORIA**/
    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($id);
        $producto->condicion = '1';
        $producto->save();
    }


    public function selectProducto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $productos = Producto::select('id','nombre_producto')->orderBy('nombre_producto', 'asc')->get();
        return ['productos' => $productos];
    }
}
