<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Seempresa;
use App\Empresa;
use App\Categoria; 
class SeempresaController extends Controller
{
    public function index(Request $request)
    {
     /*determinar si es una peticion ajax para seguirdad*/
     if (!$request->ajax()) return redirect('/');

     $buscar =  $request->buscar;
     $criterio = $request->criterio;
     $id = $request->id;

     /*Si esta vacia la vriable busqueda que busque por categoria */
     if($id!=''){

        if($buscar==''){
            $seempresas = Seempresa::join('empresas','seempresas.id_empresa','=','empresas.id')
            ->join('vendedores','empresas.id_vendedor','=','vendedores.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('servicios','seempresas.id_servicio','=','servicios.id')
            ->join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('seempresas.id','seempresas.id_empresa','seempresas.id_servicio','seempresas.precio','empresas.nombre_empresa','servicios.nombre_servicio','servicios.imagen_servicio','categorias.nombre_categoria')
            ->where('users.id', '=', $id)
            ->paginate(3);
        }
        else{
            $seempresas = Seempresa::join('empresas','seempresas.id_empresa','=','empresas.id')
            ->join('vendedores','empresas.id_vendedor','=','vendedores.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->join('servicios','seempresas.id_servicio','=','servicios.id')
            ->join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('seempresas.id','seempresas.id_empresa','seempresas.id_servicio','seempresas.precio','empresas.nombre_empresa','servicios.nombre_servicio','servicios.imagen_servicio','categorias.nombre_categoria')
            ->where('servicios.'.$criterio, 'like', '%'. $buscar .'%')
            ->where('users.id', '=', $id)
            ->paginate(3); 
        }

     }else{

        if($buscar==''){
            $seempresas = Seempresa::join('empresas','seempresas.id_empresa','=','empresas.id')
            ->join('servicios','seempresas.id_servicio','=','servicios.id')
            ->join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('seempresas.id','seempresas.id_empresa','seempresas.id_servicio','seempresas.precio','empresas.nombre_empresa','servicios.nombre_servicio','servicios.imagen_servicio','categorias.nombre_categoria')
            ->orderBy('seempresas.id', 'desc')->paginate(3);
        }
        else{
            $seempresas = Seempresa::join('empresas','seempresas.id_empresa','=','empresas.id')
            ->join('servicios','seempresas.id_servicio','=','servicios.id')
            ->join('categorias','servicios.id_categoria','=','categorias.id')
            ->select('seempresas.id','seempresas.id_empresa','seempresas.id_servicio','seempresas.precio','empresas.nombre_empresa','servicios.nombre_servicio','servicios.imagen_servicio','categorias.nombre_categoria')
            ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('seempresas.id','desc')->paginate(3); 
        }

    }

     return [
         'pagination' => [
             'total' => $seempresas->total(),
             'current_page' => $seempresas->currentPage(),
             'per_page' => $seempresas->perPage(),
             'last_page' => $seempresas->lastPage(),
             'from' => $seempresas->firstItem(),
             'to' => $seempresas->lastItem(),
         ],
         'seempresas' => $seempresas
     ];
 }

 /**FUNCION PARA ALAMCENAR NUEVO SERVICIO**/
public function store(Request $request)
 {
     if (!$request->ajax()) return redirect('/');
     $servicio = new Seempresa();
     $servicio->id_empresa = $request->id_empresa;
     $servicio->id_servicio = $request->id_servicio;
     $servicio->precio = $request->precio;
     $servicio->save();
 }

 /**FUNCION PARA ACUTLIZAR PRODUCTO**/
 public function update(Request $request, $id)
 {
     if (!$request->ajax()) return redirect('/');
     $servicio = Seempresa::findOrFail($id);
     $servicio->id_empresa = $request->id_empresa;
     $servicio->id_servicio = $request->id_servicio;
     $servicio->precio = $request->precio;
     $servicio->save();
     
 }

 public function destroy(Request $request,$id){
     
    if (!$request->ajax()) return redirect('/');
    $servicio = Seempresa::findOrFail($id);
    $servicio->delete();

}

public function micrositios_empresa(Request $request){
    if (!$request->ajax()) return redirect('/');
    $id = $request->id;
    //return $request->all();
    $empresas = Seempresa::join('empresas','seempresas.id_empresa','=','empresas.id')
    ->join('servicios','seempresas.id_servicio','=','servicios.id')
    ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','empresas.logo','empresas.pais','empresas.ciudad','seempresas.precio','servicios.nombre_servicio','servicios.imagen_servicio')
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
