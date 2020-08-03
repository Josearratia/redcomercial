<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Vendedor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');
            $buscar =  $request->buscar;
            $criterio = $request->criterio;
            $id = $request->id;
            
        if($id!=''){
            $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
            ->join('users','vendedores.id_usuario','=','users.id')
            ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','empresas.logo','vendedores.nombres as nombres','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
            ->where('users.id','=',$id)->paginate(1);
        
        }else{
            /*Si esta vacia la variable busqueda, que busque por nombre */
            if($buscar==''){
                $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
                ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','vendedores.nombres as nombres','empresas.logo','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
                ->orderBy('empresas.id', 'desc')->paginate(3);
            }
            else{
                $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
                ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','vendedores.nombres as nombres','empresas.logo','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
                ->where('empresas.'.$criterio, 'like', '%'. $buscar .'%')
                ->orderBy('empresas.id','desc')->paginate(3); 
            }
        }
        
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

    /**FUNCION PARA ALAMCENAR NUEVA EMPRESA**/
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = new Empresa();
        $empresa->id_vendedor = $request->id_vendedor;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->pais = $request->pais;
        $empresa->ciudad = $request->ciudad;
        $empresa->latitud = $request->latitud;
        $empresa->longitud = $request->longitud;
        $empresa->save();
    }

    /**FUNCION PARA ACUTLIZAR VENDEDOR**/
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id);
        $empresa->id_vendedor = $request->id_vendedor;
        $empresa->nombre_empresa = $request->nombre_empresa;
              
        if ($request->hasFile('logo')) {
            $path = Storage::disk('public')->put('image', $request->file('logo'));
            $empresa->logo = asset($path);    
            }

        $empresa->pais = $request->pais;
        $empresa->ciudad = $request->ciudad;
        $empresa->latitud = $request->latitud;
        $empresa->longitud = $request->longitud;
        $empresa->save();        
    }

    public function selectEmpresa(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;

        if($id!=''){
        $empresas = Empresa::
        join('vendedores','empresas.id_vendedor','=','vendedores.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->select('empresas.id','empresas.nombre_empresa')->orderBy('empresas.nombre_empresa', 'asc')
        ->where('users.id','=',$id)
        ->get();
        }
        else 
        {   
        $empresas = Empresa::select('id','nombre_empresa')->orderBy('nombre_empresa', 'asc')->get();
        } 
        return ['empresas' => $empresas];
    }

    public function showproducto(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar =  $request->buscar;
        $criterio = $request->criterio;
        $id = $request->id;

         /*Si esta vacia la variable busqueda que busque por nombre */
        if($buscar==''){
            $empresas = "no";
        }
        else{

            if($criterio == 'servicio'){
                $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
                ->join('seempresas','empresas.id','=','seempresas.id_empresa')
                ->join('servicios','seempresas.id_servicio','=','servicios.id')
                ->select('empresas.id','servicios.nombre_servicio as nombre_item','empresas.id_vendedor','seempresas.precio','empresas.nombre_empresa','vendedores.nombres','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
                ->where('servicios.nombre_servicio', 'like', '%'. $buscar .'%')
                ->orderBy('seempresas.precio','asc')->get();

            }elseif($criterio == 'producto'){
                $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
                ->join('pdempresas','empresas.id','=','pdempresas.id_empresa')
                ->join('productos','pdempresas.id_producto','=','productos.id')
                ->select('empresas.id','productos.nombre_producto as nombre_item','pdempresas.stock','empresas.id_vendedor','pdempresas.precio','empresas.nombre_empresa','vendedores.nombres','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
                ->where('productos.nombre_producto', 'like', '%'. $buscar .'%')
                ->orderBy('pdempresas.precio','asc')->get();
            }
        }
    
    
        return [
            'empresas' => $empresas
        ];

    }

    public function index_micrositio(Request $request){
        if (!$request->ajax()) return redirect('/');
       // return $request->all();
        $id = $request->id;
        $empresas = Empresa::join('vendedores','empresas.id_vendedor','=','vendedores.id')
        ->join('users','vendedores.id_usuario','=','users.id')
        ->select('empresas.id','empresas.id_vendedor','empresas.nombre_empresa','empresas.logo','vendedores.nombres as nombres','empresas.pais','empresas.ciudad','empresas.latitud','empresas.longitud')
        ->where('empresas.id','=',$id)->paginate(1);
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
