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

                            <h5 class="card-title text-center">Mi Empresa</h5>
                               
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre_empresa">Nombre Empresa</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nombre_empresa" v-model="nombre_empresa" class="form-control" placeholder="Nombre de la empresa">
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
                                    <label class="col-md-3 form-control-label" for="longitud">Longitud</label>
                                    <div class="col-md-9">
                                        <input type="number" step="any" id="longitud" v-model="longitud" class="form-control" placeholder="Longitud">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="latitud">Latitud</label>
                                    <div class="col-md-9">
                                        <input type="number" step="any" id="latitud" v-model="latitud" class="form-control" placeholder="Latitud">
                                    </div>
                                </div>


                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="logo">Logo</label>
                                        <div class="col-md-3">
                                        <input type="file"  @change="obtenerimagen" class="form-control-file" id="logo">

                                        </div>

                                        <div class="col-md-6 d-flex justify-content-center">
                                            <img :src="logo" class="img-fluid" alt="Responsive image">
                                        </div>
                                </div>

                            

                                


                                <div class="form-group row">
                                   
                                    <div class="col-md-9">
                                <button type="button" class="btn btn-primary" @click="actualizarEmpresa()">Actualizar</button>
                                  </div>
                                </div>
                                
                                <div v-show="errorEmpresa" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostarMsjEmpresa" :key="error" v-text="error">

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
                
                empresa_id : 0,//variable para que es utilizada para acutlizar datos del vendedor
                id_usuario : this.userid,//para saber a que usuario pertenece
                nombre_empresa : '',//mostrar el nombre del vendedor
                pais : '',
                ciudad : '',
                latitud : '',
                longitud : '',
                id_vendedor : '',
                logo : '',


                
            /*almacenar los datos de los articulos para mostrarlos*/    
                arrayEmpresa : [],
             
               
            
                //guardamos los errores de los articulos
                errorEmpresa : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjEmpresa : []
            }           
        },


        methods : {
            //funcion para mostrar los vendedores
            listarEmpresa (){
                let me=this;
                var url = '/empresa?id='+this.id_usuario+'';
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayEmpresa = respuesta.empresas.data; 

                     me.arrayEmpresa.forEach(datos => {
                         //me.nombres = datos.nombres;
                         //me.apellidos = datos.apellidos;
                         me.empresa_id = datos.id;
                         me.id_vendedor = datos.id_vendedor;
                         me.nombre_empresa = datos.nombre_empresa;
                         me.pais = datos.pais;
                         me.ciudad = datos.ciudad;
                         me.latitud = datos.latitud;
                         me.longitud = datos.longitud;
                         me.logo = datos.logo; 
                         
                     });
                     

                     
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },
                obtenerimagen(e){
                    let file = e.target.files[0];
                
                    this.logo = file;
                },

                //funcion para actualizar vendedor
                actualizarEmpresa(){
                
                  //valdiamos el articulo
                    if(this.validarEmpresa()){
                        return;
                    }


                     swal({
                        title: 'Esta seguro de Actualizar los datos de la Empresa?',
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
                            let formData = new FormData();
                            formData.append('nombre_empresa', this.nombre_empresa);
                            formData.append('latitud', this.latitud);
                            formData.append('longitud', this.longitud);
                            formData.append('pais', this.pais);
                            formData.append('ciudad', this.ciudad);
                            formData.append('id_vendedor', this.id_vendedor);
                            formData.append('id', this.empresa_id)
                            formData.append('logo', this.logo);

                            axios.post('/empresa/actualizar/',formData,{
                                  headers: {
                                    'Content-Type': 'multipart/form-data'
                            }
                                
                            }).then(function (response) {
                                me.listarEmpresa();
                                me.logo='';
                                swal(
                                'Actualizadao!',
                                'Su Empresa ha sido actualizada con éxito.',
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
                    validarEmpresa(){
                        
                        this.errorEmpresa = 0;
                        this.errorMostarMsjEmpresa = [];


                     
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                       
                         
                            if(!this.longitud) this.errorMostarMsjEmpresa.push("La longitud no puede ir vacío");
                               if(!this.nombre_empresa) this.errorMostarMsjEmpresa.push("El nombre de la empresa no puede ir vacío.");
                                if(!this.latitud) this.errorMostarMsjEmpresa.push("La latitud no puede ir vacío");
                                    if(!this.pais) this.errorMostarMsjEmpresa.push("El estado no puede ir vacío");
                                        if(!this.ciudad) this.errorMostarMsjEmpresa.push("La Ciudad no puede ir vacío");
                        
                        //si el arreglo tiene datos entonces el error vendedor es = 1, etonces hay errores
                        if(this.errorMostarMsjEmpresa.length) this.errorEmpresa = 1;

                        return this.errorEmpresa;
                    }
           


        },
        mounted() {
            
            this.listarEmpresa();
           
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
