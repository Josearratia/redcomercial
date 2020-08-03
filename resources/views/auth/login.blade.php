@extends('auth.contenido')

@section('login')

<div class="row justify-content-center">
      <div class="col-md-6">
      
        <div class="card-group mb-0">
          <div class="card p-4">
            <form  class="form-horizontal was-validated"  method="POST" action="{{ route('login') }}"> 
            {{ csrf_field() }}
        
            <div class="card-body">
              <h1 class="text-center">Iniciar Sesión</h1>
            
              <!--si hay una excepcion en el input usuario-->
              <div class=" form-group  mb-4{{$errors->has('email' ? 'is-invalid' : '')}}">
                
                     <div class="input-group-prepend">
                          <label class="">Correo</label>
                      </div>
                <input type="email" value="{{old('email')}}" name="email" id="email" class="form-control form-control-sm mr-2" placeholder="Correo">
                <!--si el usuario no existe mostramos un mensaje de que no existe-->
                
              {!!$errors->first('email','<span class="invalid-feedback alert alert-danger">:message</span>')!!} 
                
            
                </div>
              <div class=" form-group  mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
              <div class="input-group-prepend">
                <label class="text-center">Contraseña</label>
              </div>  
                <input type="password" name="password" id="password" class="form-control form-control-sm mr-2" placeholder="Password">
                {!!$errors->first('password','<span class="invalid-feedback alert alert-danger">:message</span>')!!}  
            </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary px-4 align-content-center">Ingresar</button>
                  
                </div>
                <!--<div class="col-6 text-right">
                  <button type="button" class="btn btn-link px-0">Olvidaste tu password?</button>
                </div>-->
              </div>
            </div>
          </form>  
          </div>
         
        </div>
      </div>
    </div>
@endsection

