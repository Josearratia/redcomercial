<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function Login(){
       return view('auth.login');
   }

   public function home(){
    return view('auth.home');
   }

   public function iniciar(Request $request){
        //echo $request;
        $this->validar($request);

        if(Auth::attempt(['email' => $request->email,
                          'password' => $request->password,
                          'condicion' => 1])){
                            return redirect()->route('main');
        }

        //si no se cumple la condicion regresar con los errrores
        return back()->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));

        
   }

   //funcion validar
   public function validar(Request $request){
         //validar que sean string
         $this->validate($request,[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
   }
   
   //funcion para salir de session
   public function logout(Request $request){
          Auth::logout();//metodo logout de auth
          $request->session()->invalidate();
          return redirect('/');//redereccionar a formulario login

   }

}
