<template>
    
    <main class="main">
        <div class="container-fluid row">
            <div class="col-6">
                <select class="form-control" v-model="criterio">
                                      <option selected>SELECCIONE...</option>  
                                      <option value="servicio">Servicio</option>  
                                      <option value="producto">Producto</option>                    
                </select>
                
                <div>
                <input class="form-control " type="text" v-model="buscar" @keyup.enter="buscarproducto(buscar,criterio)" placeholder="Buscar..">
                </div>
            </div>

        <template v-if="arrayitems">

            <div class="col-6 table-responsive-sm" style="overflow-y: scroll; height: 12rem;">
                <table class="table">
                     <caption>Empresas</caption>
                     <thead>
                        <tr>
                        <th scope="col">Empresa</th>
                        <th scope="col">Producto/Servicio</th>
                        <th scope="col">Precio</th>
                     
                        
                        </tr>
                    </thead>


                     <tbody>
                         <tr  v-for="item in arrayitems" :key="item.id">
                            <td><a href="#" @click="irmicrositio(item.id)"> <p v-text="item.nombre_empresa"></p></a></td>
                            <td v-text="item.nombre_item"></td>
                            <td v-text="item.precio"></td>
                            <template v-if="item.stock">
                               <td><span class="badge badge-primary badge-pill" v-text="item.stock"></span></td>
                            </template>
                         </tr>
                     </tbody>    
                </table>
            </div>
       
            <!--<div class="col-6" style=" overflow-y: hidden; height:13rem;">
                    <ul class="list-group" v-for="item in arrayitems" :key="item.id">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p v-text="item.nombre_empresa"></p>
                            <p v-text="item.nombre_item"></p>
                            <p v-text="item.precio"></p>
                            <template v-if="item.stock">
                                <span class="badge badge-primary badge-pill" v-text="item.stock">14</span>
                            </template>
                        </li>
                    </ul>
            </div>-->
             </template>
            </div>

            <div id="map"></div>
      
    </main>
        
   
      
  


</template>



<script>
  export default {
      data (){
            return {
                criterio : '',
                buscar : '',
                map : null,
                L : null,
                layer : '',
            /*almacenar los datos de la categoria para mostrarlos*/    
                arrayitems : []
            }
      },
        methods : {
            quitar(){
                map.remove();
                this.mapa();
                this.arrayitems = [];

            },
            irmicrositio(id){
                 
                 window.location = 'micrositio?id='+id;

            },
            buscarproducto(buscar,criterio){

                let me = this;
                var url = '/mapa?buscar=' + buscar + '&criterio=' + criterio;   
                me.quitar();  
                 axios.get(url).then(function(response){
                    if(response == "no"){
                      console.log('no');
                    }else{  
                    var respuesta = response.data;
                    me.arrayitems = respuesta.empresas;

                    me.arrayitems.forEach(datos => {

                    L.marker([datos.latitud, datos.longitud], {
                        draggable: true,
                        title: datos.nombre_empresa + ' $' + datos.precio
                    }).addTo(map);
                    
                    });
                    }
                })   
                 .catch(function (error){
                     console.log(error);
                 });
                   

            },
            mapa(){
                map = L.map('map').
                 setView([23.74174, -99.14599], 15);    
                 L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                 maxZoom: 18
                 }).addTo(map);

                L.control.scale().addTo(map);
              
            }

        },
       mounted() {
                this.mapa();

        }
       
      

 }
</script>