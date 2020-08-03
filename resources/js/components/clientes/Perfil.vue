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

                            <h5 class="card-title text-center">Cliente</h5>
                               
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Nombre(s)</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nombre" v-model="nombres" class="form-control" placeholder="Nombre Del Vendedor">
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="apellidos">Apellido(s)</label>
                                    <div class="col-md-9">
                                        <input type="text" id="apellidos" v-model="apellidos" class="form-control" placeholder="Apellidos Del Vendedor">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="pais">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" id="pais" v-model="pais" class="form-control" placeholder="Estado">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="ciudad">Ciudad</label>
                                    <div class="col-md-9">
                                        <input type="text" id="ciudad" v-model="ciudad" class="form-control" placeholder="Ciudad">
                                        
                                    </div>
                                </div>

                               


                                <div class="form-group row">
                                   
                                    <div class="col-md-9">
                                <button type="button" class="btn btn-primary" @click="actualizarCliente()">Actualizar</button>
                                  </div>
                                </div>
                                
                                <div v-show="errorCliente" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostarMsjCliente" :key="error" v-text="error">

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
                
                cliente_id : 0,//variable para que es utilizada para acutlizar datos del vendedor
                id_usuario : this.userid,//para saber a que usuario pertenece
                nombres : '',//mostrar el nombre del vendedor
                email : '',
                password : '',
                apellidos : '',//apellidos del vendedor
                ciudad : '',
                pais : '',
               

                
            /*almacenar los datos de los articulos para mostrarlos*/    
                arrayCliente : [],
                modal : 0,//variable modal para saber que opcion abrio el usuario si fue actualizar o registrar
                tituloModal : '',//titulo del modal actualizar o registrar
                tipoAccion : 0,//tipo de accion actualizar o registrar
                //guardamos los errores de los articulos
                errorCliente : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjCliente : []
            }           
        },


        methods : {
            //funcion para mostrar los vendedores
            listarCliente (){
                let me=this;
                var url = '/cuentav/'+this.id_usuario+'';
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayCliente = respuesta.cliente;  

                     me.arrayCliente.forEach(datos => {
                         me.nombres = datos.nombres;
                         me.apellidos = datos.apellidos;
                         
                         me.cliente_id = datos.id;
                         me.password = datos.password;
                         me.email = datos.email;
                         me.pais = datos.pais;
                         me.ciudad = datos.ciudad;
                     });
                     

                     
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },

                //funcion para actualizar vendedor
                actualizarCliente(){
                
                  //valdiamos el articulo
                    if(this.validarCliente()){
                        return;
                    }


                     swal({
                        title: 'Esta seguro de Actualizar su Perfil?',
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
                            axios.put('/cliente/actualizar/'+this.cliente_id+'',{
                                'id_usuario' : this.id_usuario,
                                'nombres' : this.nombres,
                                'apellidos' : this.apellidos,
                                'pais' : this.pais,
                                'ciudad' : this.ciudad,
                                
                            }).then(function (response) {
                                me.listarCliente();
                                swal(
                                'Actualizado!',
                                'Su perfil ha sido actualizado con éxito.',
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
                    validarCliente(){
                        
                        this.errorCliente = 0;
                        this.errorMostarMsjCliente = [];


                     
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                        if(!this.nombres) this.errorMostarMsjCliente.push("El nombre  no puede estar vacío.");
                         if(!this.apellidos) this.errorMostarMsjCliente.push("El apellido no puede estar vacío.");
                            if(!this.pais) this.errorMostarMsjCliente.push("El estado vacío.");
                             if(!this.ciudad) this.errorMostarMsjCliente.push("La ciudad no puede estar vacío.");
                    
                        //si el arreglo tiene datos entonces el error vendedor es = 1, etonces hay errores
                        if(this.errorMostarMsjCliente.length) this.errorCliente = 1;

                        return this.errorCliente;
                    }
           


        },
        mounted() {
            
            this.listarCliente();
           
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
   .mostrar{
       display: list-item !important;
       opacity: 1 !important;
       position: absolute !important;
       background-color: #3c29297a !important;
   } 
   .div-error{
       display: flex;
       justify-content: center;
   }
   .text-error{
       color:red !important;
       font-weight: bold;
   }
</style>
