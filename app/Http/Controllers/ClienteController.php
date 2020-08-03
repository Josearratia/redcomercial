<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente; //hacemos uso de nuestro modelo cliente
class ClienteController extends Controller
{
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax por seguridad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*busqueda*/
        if($buscar==''){
            $clientes = Cliente::join('users','clientes.id_usuario','=','users.id')
            ->select('clientes.id','clientes.id_usuario','clientes.nombres','users.email as email','clientes.apellidos','clientes.pais','clientes.ciudad')
            ->orderBy('clientes.id', 'desc')->paginate(3);
        }
        else{
            $clientes = Cliente::join('users','clientes.id_usuario','=','users.id')
            ->select('clientes.id','clientes.id_usuario','clientes.nombres','users.email as email','clientes.apellidos','clientes.pais','clientes.ciudad')
            ->where('clientes.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('clientes.id','desc')->paginate(3); 
        }
        
        return [
            'pagination' => [
                'total' => $clientes->total(),
                'current_page' => $clientes->currentPage(),
                'per_page' => $clientes->perPage(),
                'last_page' => $clientes->lastPage(),
                'from' => $clientes->firstItem(),
                'to' => $clientes->lastItem(),
            ],
            'clientes' => $clientes
        ];
    }

    /**FUNCION PARA ALAMCENAR NUEVO CLIENTE**/
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = new Cliente();
        $cliente->id_usuario = $request->id_usuario;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->ciudad = $request->ciudad;
        $cliente->pais = $request->pais;
 
        $cliente->save();
    }

    /**FUNCION PARA ACUTLIZAR CLIENTE**/
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = Cliente::findOrFail($id);
        $cliente->id_usuario = $request->id_usuario;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->ciudad = $request->ciudad;
        $cliente->pais = $request->pais;

        $cliente->save();
        
    }

    public function showcliente(Request $request,$id){
        
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::join('users','clientes.id_usuario','=','users.id')
        ->select('clientes.id','clientes.id_usuario','clientes.nombres','users.email','users.password','clientes.apellidos','clientes.ciudad','clientes.pais')
        ->where('users.id', '=', $id)->get();

        return ['cliente' => $cliente];
    }

 
}
