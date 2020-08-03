
<!--Iniciamos el componente de articulos-->
<template>
<div>

    

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><img class="card-img-top" style="width: 70%;" :src="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li @click="opcion=1" class="nav-item">
            <a class="nav-link" href="#">Servicios</a>
          </li>
          <li @click="opcion=2" class="nav-item">
            <a class="nav-link" href="#">Producto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


    <template  v-if="opcion==0">
      <mics :user_id="id_usuario" :empresa_id="id_empresa"></mics>
  </template>


            
  <template  v-if="opcion==1">
      <mics :user_id="id_usuario" :empresa_id="id_empresa"></mics>
  </template>
  

  <template  v-if="opcion==2">
      <micp :user_id="id_usuario" :empresa_id="id_empresa"></micp>      
  </template>


   <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
    </footer>

</div>    



	
            
</template>

<script>
    export default {
        props: ['userid','empresa'],
        data (){
            /*Variables que vamos a utilizar*/
            
            return {
                id_empresa : this.empresa,    
                vendedor_id : 0,//variable para que es utilizada para acutlizar datos del vendedor
                id_usuario : this.userid, //para saber a que usuario pertenece
                opcion : 0,
                logo : '',
                nombres : '',
                apellidos : '',
                estado : '',
                ciudad : '',
                id_vendedor : 0,
                latitud : 0,
                longitud : 0,
                pais : '',
                arrayEmpresa : []


            }           
        },


        methods : {
           
              Mostrardatos_empresa(){
                let me = this;
               var url = '/index_micrositio?id='+this.id_empresa;
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayEmpresa = respuesta.empresas.data; 

                     me.arrayEmpresa.forEach(datos => {
                         //me.nombres = datos.nombres;
                         //me.apellidos = datos.apellidos;
                         //me.empresa_id = datos.id;
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
                 

        }
        

    },
            mounted() {
            this.Mostrardatos_empresa();
            
           
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
