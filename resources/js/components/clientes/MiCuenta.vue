<!--Iniciamos el componente de articulos-->
<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/"> HOME </a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-body">
                         <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <h5 class="card-title text-center">Mi cuenta</h5>
                               
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="correo">Correo Electronico</label>
                                    <div class="col-md-9">
                                        <input type="email" id="nombre" v-model="email" class="form-control" placeholder="correo">
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="password">Contraseña de usuario</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" v-model="password" class="form-control" placeholder="Contraseña">
                                        
                                    </div>
                                </div>

                                


                                <div class="form-group row">
                                   
                                    <div class="col-md-9">
                                <button type="button" class="btn btn-primary" @click="actualizarUsuario()">Actualizar</button>
                                  </div>
                                </div>
                                
                                <div v-show="errorUsuario" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostarMsjUsuario" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            
            
            
        </main>
</template>

<script>
    export default {
         props: ['userid'],
        data (){
            /*Variables que vamos a utilizar*/
            
            return {
                
                vendedor_id : 0,//variable para que es utilizada para acutlizar datos del vendedor
                id_usuario : this.userid,//para saber a que usuario pertenece
                nombres : '',//mostrar el nombre del vendedor
                
                password : '',
                apellidos : '',//apellidos del vendedor
                email : '',

                
            /*almacenar los datos de los articulos para mostrarlos*/    
                arrayUsuario : [],
                modal : 0,//variable modal para saber que opcion abrio el usuario si fue actualizar o registrar
                tituloModal : '',//titulo del modal actualizar o registrar
                tipoAccion : 0,//tipo de accion actualizar o registrar
                //guardamos los errores de los articulos
                errorUsuario : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjUsuario : []
            }           
        },


        methods : {
            //funcion para mostrar los vendedores
            listarUsuario (){
                let me=this;
                var url = '/cuentav/'+this.id_usuario+'';
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayUsuario = respuesta.cliente;  

                     me.arrayUsuario.forEach(datos => {
                         //me.nombres = datos.nombres;
                         //me.apellidos = datos.apellidos;
                         //me.email = datos.email;
                        // me.vendedor_id = datos.id;
                         me.password = datos.password;
                         me.email = datos.email;
                     });
                     

                     
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },

                //funcion para actualizar vendedor
                actualizarUsuario(){
                
                  //valdiamos el articulo
                    if(this.validarUsuario()){
                        return;
                    }


                     swal({
                        title: 'Esta seguro de Actualizar su Cuenta?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value) {
                            let me = this;
                            axios.put('/usuario/actualizar/'+this.id_usuario+'',{
                                'email' : this.email,
                                'password' : this.password,
                                'rol' : 3
                            }).then(function (response) {
                                me.listarUsuario();
                                swal(
                                'Actualizado!',
                                'Su Cuenta ha sido actualizada con éxito.',
                                'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                            
                        } else if (
                            // Read more about handling dismissals
                            result.dismiss === swal.DismissReason.cancel
                        ) {
                        
                        }
                        }) 



                },

                  //funcion para validar el vendedor
                    validarUsuario(){
                        
                        this.errorUsuario = 0;
                        this.errorMostarMsjUsuario = [];


                     
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                       
                         
                            if(!this.email) this.errorMostarMsjUsuario.push("El Correo  no puede estar vacíó");
                               if(!this.password) this.errorMostarMsjUsuario.push("La contraseña no puede estar vacío.");
                        
                        //si el arreglo tiene datos entonces el error vendedor es = 1, etonces hay errores
                        if(this.errorMostarMsjUsuario.length) this.errorUsuario = 1;

                        return this.errorUsuario;
                    }
           


        },
        mounted() {
            
            this.listarUsuario();
           
        }
    }
</script>

<style>
   .div-error{
       display: flex;
       justify-content: center;
   }
   .text-error{
       color:red !important;
       font-weight: bold;
   }
</style>
