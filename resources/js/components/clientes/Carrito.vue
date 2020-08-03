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
                    <div class="card-header">
                        
                        <i class="fa fa-align-justify"></i> Carrito
                        <!--abrimos modal de articulos con una funcion  abrirModal recibiendo dos parametros-->
                       
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_empresa">Nombre Empresa</option>
                                    
                                    </select>
                                    <!--@keyup.enter detecta si el usuario presiono la tecla enter-->
                                    <!--funcion para buscar articulos se busca por categoria o nombre del articulo-->
                                    <input type="text" v-model="buscar" @keyup.enter="listarCarritos(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCarritos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre Producto</th>
                                    <th>Empresa</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <!--total?-->
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listamos los aritculos que hay en la base de datos registrados-->
                                <tr v-for="carrito in arrayCarritos" :key="carrito.id">
                                    <td>
                                       
                                        <button type="button" @click="eliminar(carrito)" class="btn btn-danger btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                     
                                    </td>
                                    <!--Mostramos los articulos-->
                                    
                                    <td v-text="carrito.nombre_producto"></td>
                                    <td v-text="carrito.nombre_empresa"></td>
                                    <td v-text="carrito.cantidad"></td>  
                                    <td v-text="carrito.total"></td>                                
                                    
                                  
                                </tr>
                               
      
                              
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar,criterio)">Ant</a>
                                </li>

                                <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                              
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
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
                user_id : this.userid,
                

                
            /*almacenar los datos de los articulos para mostrarlos*/    
                arrayCarritos : [],
                modal : 0,//variable modal para saber que opcion abrio el usuario si fue actualizar o registrar
              
                pagination : {
                    'total' : 0, /*los registros que existen */
                    'current_page' : 0,/*pagina actual */
                    'per_page' : 0, /*cuantas paginas se deben monstrar*/
                    'last_page' : 0, /*ultima pagina  ala pagina 4*/
                    'from' : 0, /*de que a que pagina se deben de mostrar para dar el valor deseado de la pgina 1*/
                    'to' : 0, /*total de cuantos registro se estan vizualizando*/
                },
                offset : 3,
                
                criterio : '',
                buscar : ''
            }
        },

        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //calcula los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return[];
                }

                /* commprobar si la pagina actual es -0 o igual a cero si se cumple le damos valor a 1 */
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                   from = 1;
                }

                /*comprobar si las paginas que se estan visualizando es mayor a la ultima pagina que no debe de cumplirse 
                si es ene este caso to la igualamos al valor de la ultima pagina */
                var to = from + (this.offset * 2);
               if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
                }

                /*llenar el arreglo pagesArray desde donde estamos hasta la ultima pagina que se vizualize,
                */
                   var pagesArray = [];
                   while(from <= to){
                   pagesArray.push(from);
                   from++;
                }
                return pagesArray;


            }
        },

        methods : {
            //funcion para mostrar los articulos
            listarCarritos (page, buscar, criterio){
                let me=this;
                var url = '/carrito?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio + '&id=' + this.user_id;
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayCarritos = respuesta.carritos.data;  //pasamos los datos al arrayproductos 
                     me.pagination = respuesta.pagination; //pasamos los datos al arreglos pagination
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },

                

                //funcion para el pagination
                cambiarPagina(page, buscar,criterio){
                    let me = this;
                    //actualiza la página atual
                    me.pagination.current_page = page;
                    //envia la petición visualizar la data de esa página
                    me.listarCarritos(page,buscar,criterio);

                },


                eliminar(carrito){

                     swal({
                        title: 'Esta seguro de Eliminar este producto del Carrito?',
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
                            axios.delete('carrito/destroy/' + carrito.id + '',{
                               
                            }).then(function (response) {
                                me.listarCarritos(1, '', 'nombre_empresa');
                                swal(
                                'Eliminado!',
                                'El producto ha sido eliminado con éxito.',
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
                

        },
        mounted() {
            this.listarCarritos(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
  
</style>
