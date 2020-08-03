<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Vendedor;
use App\Empresa;

class RegisterController extends Controller
{

    public function registrar(){
        return view('auth.registrar');
    }

    public function validar(Request $request)
    {
         //validar que sean string
         $this->validate($request,[
            'usuario' => 'required|unique:posts|max:255',
            'password' => 'required|string'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
            'password' => 'required|string',
            //'nombres' => 'required|string',
            //'apellidos' => 'required|string',
            'nombre_empresa' => 'required|string'//,
            //'pais' => 'required|string',
            //'ciudad' => 'required|string',
            //'longitud' =>  'required',
            //'latitud' =>  'required'
        ]);

        if ($validator->fails()) {
            return redirect('/registrar')->withErrors($validator, 'login');
                       
        }

       try{   
            DB::beginTransaction();  
            $user =  new User();  
            $user->email = $request->email;
            $user->rol = 2;
            $user->password = bcrypt($request->password);
            
            $user->save();

            $vendedor = new Vendedor();
            //$vendedor->nombres = $request->nombres;
            //$vendedor->apellidos = $request->apellidos;
            $vendedor->id_usuario = $user->id;
            $vendedor->save();

            $empresa =  new Empresa();
            $empresa->nombre_empresa = $request->nombre_empresa;
            //$empresa->pais = $request->pais;
            //$empresa->ciudad = $request->ciudad;
            //$empresa->longitud = $request->longitud;
            //$empresa->latitud = $request->latitud;
            $empresa->id_vendedor = $vendedor->id;
            $empresa->save();

            DB::commit();

        return redirect('/');//redereccionar a formulario login
       } catch (Excepction $e){

            DB::rollBack();
       }
   

    }
}
