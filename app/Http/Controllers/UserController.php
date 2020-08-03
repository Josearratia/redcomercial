<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendedor;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*Si esta vacia la vriable busqueda que busque por nnombre de usuario */
        if($buscar==''){
            $usuarios = User::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $usuarios = User::where($criterio, 'like', '%'. $buscar .'%')->orderBy('id', 'desc')->paginate(3);
        }
      

        return [
            'pagination' => [
                'total' => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page' => $usuarios->perPage(),
                'last_page' => $usuarios->lastPage(),
                'from' => $usuarios->firstItem(),
                'to' => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = bcrypt( $request->password );
        $usuario->rol = $request->rol;
        $usuario->condicion = '0';
        $usuario->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->email = $request->email;
        $usuario->password = bcrypt( $request->password );
        $usuario->rol = $request->rol;
        $usuario->condicion = '1';
        $usuario->save();
    }

    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = User::findOrFail($id);
        $usuario->condicion = '0';
        $usuario->save();
    }

    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = User::findOrFail($id);
        $usuario->condicion = '1';
        $usuario->save();
    }

      /**MUESTRA TODAS LOS USUARIOS  QUE ESTAN ACTIVOS* */
      public function selectUser(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $usuarios = User::where('condicion', '=', '1')->where('rol', '=' ,'2')
        ->select('id','email')->orderBy('email', 'asc')->get();
        return ['usuarios' => $usuarios];
    }

      /**SLECCIONAR CLIENTE USER DE TIPO CLIENTE QUE ESTAN ACTIVOS* */
      public function selectCliente(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $usuarios = User::where('condicion', '=', '1')->where('rol', '=' ,'3')
        ->select('id','email')->orderBy('email', 'asc')->get();
        return ['usuarios' => $usuarios];
    }


}
