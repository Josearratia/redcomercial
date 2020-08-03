<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendedor;
class VendedorController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*Si esta vacia la vriable busqueda que busque por nombre */
        if($buscar==''){
            $vendedores = Vendedor::join('users','vendedores.id_usuario','=','users.id')
            ->select('vendedores.id','vendedores.id_usuario','vendedores.nombres','users.email as email','vendedores.apellidos')
            ->orderBy('vendedores.id', 'desc')->paginate(3);
        }
        else{
            $vendedores = Vendedor::join('users','vendedores.id_usuario','=','users.id')
            ->select('vendedores.id','vendedores.id_usuario','vendedores.nombres','users.email as email','vendedores.apellidos')
            ->where('vendedores.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('vendedores.id','desc')->paginate(3); 
        }
        
        return [
            'pagination' => [
                'total' => $vendedores->total(),
                'current_page' => $vendedores->currentPage(),
                'per_page' => $vendedores->perPage(),
                'last_page' => $vendedores->lastPage(),
                'from' => $vendedores->firstItem(),
                'to' => $vendedores->lastItem(),
            ],
            'vendedores' => $vendedores
        ];
    }

    /**FUNCION PARA ALAMCENAR NUEVO VENDEDOR**/
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Vendedor();
        $producto->id_usuario = $request->id_usuario;
        $producto->nombres = $request->nombres;
        $producto->apellidos = $request->apellidos;
        $producto->save();
    }

    /**FUNCION PARA ACTUALIZAR VENDEDOR**/
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Vendedor::findOrFail($id);
        $producto->id_usuario = $request->id_usuario;
        $producto->nombres = $request->nombres;
        $producto->apellidos = $request->apellidos;
        $producto->save();
        
    }

     /**MUESTRA TODAS LOS VENDEDORES  QUE ESTAN ACTIVOS* */
     public function selectVendedor(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        //SELECT users.usuario ,vendedores.nombres FROM users INNER JOIN vendedores ON users.id = vendedores.id_usuario AND users.rol = 1
        $vendedores = User::join('vendedores','users.id', '=', 'vendedores.id_usuario')
        ->select('vendedores.id','vendedores.nombres')
        ->where('users.condicion', '=', '1')->where('users.rol', '=' ,'2')
        ->orderBy('vendedores.id', 'desc')->get();


        return ['vendedores' => $vendedores];
    }

    public function showvendedor(Request $request,$id){
        
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $vendedor = Vendedor::join('users','vendedores.id_usuario','=','users.id')
        ->select('vendedores.id','vendedores.id_usuario','vendedores.nombres','users.email','users.password','vendedores.apellidos')
        ->where('users.id', '=', $id)->get();

        return ['vendedor' => $vendedor];
    }

}
