@extends('auth.contenido')
@section('registrar')



<div class="row justify-content-center">
      <div class="col-md-6">
      
        <div class="card-group mb-0">
          <div class="card p-4">
            <form  class="form-horizontal  was-validated"  method="POST" action="{{ route('create') }}"> 
            {{ csrf_field() }}
        
            <div class="card-body">
              <h1 class="text-center">Registrar</h1>
              
              <!--si hay una excepcion en el input usuario-->
              <div class=" form-group  mb-4">
                
                <div class="input-group-prepend">
                          <span class="input-group-addon text-center">Correo</span>
                      </div>
                <input type="email" name="email" id="email" class="form-control form-control-sm mr-2" placeholder="Correo" >
                <!--si el usuario no existe mostramos un mensaje de que no existe-->

                {!!$errors->login->first('email','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
                
                
            
                </div>

            <div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Contraseña</span>
              </div>  
                <input type="password" name="password" id="password" class="form-control form-control-sm mr-2" placeholder="Password" >
                {!!$errors->login->first('password','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>

            <!--<div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Nombre(s)</span>
              </div>  
                <input type="text" name="nombres" id="nombres" class="form-control form-control-sm mr-2" placeholder="Nombre(s)" >
                {!!$errors->login->first('nombres','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->

            <!--<div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Apellido(s)</span>
              </div>  
                <input type="text" name="apellidos" id="apellidos" class="form-control form-control-sm mr-2" placeholder="Apellido(s)" >
                {!!$errors->login->first('apellidos','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->

            <div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Nombre Empresa</span>
              </div>  
                <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control form-control-sm mr-2" placeholder="Nombre Empresa" >
                {!!$errors->login->first('nombre_empresa','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
              </div>

           <!-- <div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Estado</span>
              </div>  
                <input type="text" name="pais" id="estado" class="form-control form-control-sm mr-2" placeholder="Estado" >
                {!!$errors->login->first('pais','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->

            <!--<div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Ciudad</span>
              </div>  
                <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm mr-2" placeholder="Ciudad" >
                {!!$errors->login->first('ciudad','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->

            <!--<div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Latitud</span>
              </div>  
                <input type="number" name="latitud" id="latitud" class="form-control form-control-sm mr-2" placeholder="latitud" >
                {!!$errors->login->first('latitud','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->

            <!--<div class=" form-group  mb-4">
              <div class="input-group-prepend">
                <span class="input-group-addon">Longitud</span>
              </div>  
                <input type="number"  name="longitud" id="longitud" class="form-control form-control-sm mr-2" placeholder="longitud" >
                {!!$errors->login->first('longitud','<span class="invalid-feedback alert alert-danger">:message</span>')!!}
            </div>-->


              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary px-4 align-content-center">Registrar</button>
                  
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

