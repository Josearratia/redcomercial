<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Servicio;
class ServicioController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*Si esta vacia la vriable busqueda que busque por categoria */
        if($buscar==''){
            $servicios = Servicio::join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('servicios.id','servicios.id_categoria','servicios.imagen_servicio','servicios.nombre_servicio','servicios.descripcion','categorias.nombre_categoria as nombre_categoria','servicios.condicion')
            ->orderBy('servicios.id', 'desc')->paginate(3);
        }
        else{
            $servicios = Servicio::join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('servicios.id','servicios.id_categoria','servicios.imagen_servicio','servicios.nombre_servicio','servicios.descripcion','categorias.nombre_categoria as nombre_categoria','servicios.condicion')
            ->where('servicios.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('servicios.id','desc')->paginate(3);
            
            
        }
        //$categorias = Categoria::paginate(2);

        return [
            'pagination' => [
                'total' => $servicios->total(),
                'current_page' => $servicios->currentPage(),
                'per_page' => $servicios->perPage(),
                'last_page' => $servicios->lastPage(),
                'from' => $servicios->firstItem(),
                'to' => $servicios->lastItem(),
            ],
            'servicios' => $servicios
        ];
    }

    /**FUNCION PARA ALAMCENAR NUEVO PRODUCTO**/
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = new Servicio();
        $servicio->id_categoria = $request->id_categoria;
        $servicio->nombre_servicio = $request->nombre_servicio;
        if ($request->hasFile('imagen')) {
            $path = Storage::disk('public')->put('image', $request->file('imagen'));
            $servicio->imagen_servicio = asset($path);    
            }
        $servicio->descripcion = $request->descripcion;
        $servicio->condicion = '1';
        $servicio->save();
    }

    /**FUNCION PARA ACUTLIZAR PRODUCTO**/
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->id);
        $servicio->id_categoria = $request->id_categoria;
  
        $servicio->nombre_servicio = $request->nombre_servicio;
        if ($request->hasFile('imagen')) {
            $path = Storage::disk('public')->put('image', $request->file('imagen'));
            $servicio->imagen_servicio = asset($path);    
            }
        $servicio->descripcion = $request->descripcion;
    
        $servicio->condicion = '1';
        $servicio->save();
        /**/
    }

    /** FUNCION PARA DESACTIVAR CATEGORIA**/
    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($id);
        $servicio->condicion = '0';
        $servicio->save();
    }

    /**FUNCION PARA ACTIVAR CATEGORIA**/
    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($id);
        $servicio->condicion = '1';
        $servicio->save();
    }

    public function selectServicio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicios = Servicio::select('id','nombre_servicio')->orderBy('nombre_servicio', 'asc')->get();
        return ['servicios' => $servicios];
    }
}
