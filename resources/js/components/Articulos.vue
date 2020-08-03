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
                        
                        <i class="fa fa-align-justify"></i> Productos
                        <!--abrimos modal de articulos con una funcion  abrirModal recibiendo dos parametros-->
                        <button type="button" @click="abrirModal('articulo','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_producto">Nombre</option>
                                    
                                    </select>
                                    <!--@keyup.enter detecta si el usuario presiono la tecla enter-->
                                    <!--funcion para buscar articulos se busca por categoria o nombre del articulo-->
                                    <input type="text" v-model="buscar" @keyup.enter="listarArticulo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarArticulo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    
                                    <th>Nombre Producto</th>
                                    <th>Imagen</th>
                                    <th>Categoria</th>
                                   
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listamos los aritculos que hay en la base de datos registrados-->
                                <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                                    <td>
                                        <!--EN este caso si el usuario desea actualizar el articulo la funcion abrirModl recibe como segundo parametro actualizar-->
                                        <button type="button" @click="abrirModal('articulo','actualizar',articulo)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <!--Funcion para desactivar el articulo-->
                                        <template v-if="articulo.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarArticulo(articulo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <!--Funcion para activar el articulo-->
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarArticulo(articulo.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <!--Mostramos los articulos-->
                                    
                                    <td v-text="articulo.nombre_producto"></td>
                                    
                                    <td>   
                                        ​<img :src="articulo.imagen_producto" width="100px" alt="..." class="img-thumbnail">
                                    </td>
                                    <td v-text="articulo.nombre_categoria"></td>
                                    <td>
                                        <div v-if="articulo.condicion">
                                             <span class="badge badge-success">Activo</span>
                                        </div>

                                        <div v-else>
                                             <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                       
                                    </td>
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
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()"  aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                               
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_categoria" name="" id="">
                                            <option value="0" disabled>Selecciona</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre_categoria"></option>
                                        </select>
                                        
                                    </div>
                                </div>

                           
                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre_producto" class="form-control" placeholder="Nombre Producto">
                                        
                                    </div>
                                </div>


                                
                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="imagen_producto">Imagen</label>
                                        <div class="col-md-9">
                                        <input type="file" @change="obtenerimagen" class="form-control-file" id="imagen_producto">

                                        </div>
                                </div>
                                

                       
                                
                                <div v-show="errorArticulo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostarMsjArticulo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                             
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarArticulo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarArticulo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
            
        </main>
</template>

<script>
    export default {
        data (){
            /*Variables que vamos a utilizar*/
            return {
                
                articulo_id : 0,//variable para que es utilizada para acutlizar , desactivar, activar articulos
                id_categoria : 0,//variable para ser utilizada el la funcion crear y actulaizar articulo para ver que categoria selecciono para ese articulo
                nombre_categoria : '',//mostrar el nombre de la categoria 
                imagen_producto : '',
                nombre_producto : '',//nombre del aritculo
                imagen_anterior : '',//

                
            /*almacenar los datos de los articulos para mostrarlos*/    
                arrayArticulo : [],
                modal : 0,//variable modal para saber que opcion abrio el usuario si fue actualizar o registrar
                tituloModal : '',//titulo del modal actualizar o registrar
                tipoAccion : 0,//tipo de accion actualizar o registrar
                //guardamos los errores de los articulos
                errorArticulo : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjArticulo : [],
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
                buscar : '',
                arrayCategoria : []
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
            listarArticulo (page, buscar, criterio){
                let me=this;
                var url = '/articulo?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayArticulo = respuesta.productos.data;  //pasamos los datos al arrayproductos 
                     me.pagination = respuesta.pagination; //pasamos los datos al arreglos pagination
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },
                obtenerimagen(e){
                    let file = e.target.files[0];
                
                    this.imagen_producto = file;
                },
                //funcion para seleccionar categoria
                selectCategoria(){
                let me=this;
                var url = '/categoria/selectCategoria';                
                axios.get(url).then(function(response){
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;  //pasamos los datos al arraycategoria
                    //me.pagination = respuesta.pagination; //pasamos los datos al arreglos pagination
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
                    me.listarArticulo(page,buscar,criterio);

                },

               //funcion para registrar articulo
                registrarArticulo(){
                    
                    //validamos los campos del articulo 
                    if(this.validarArticulo()){
                        return;
                    }
                    
                    let me = this;
                    let formData = new FormData();
                    formData.append('imagen', this.imagen_producto);
                    formData.append('id_categoria', this.id_categoria);
                    formData.append('nombre_producto', this.nombre_producto);
                   //registramos el articulo 
                    axios.post('/articulo/registrar',formData,{
                        
                            headers: {
                                    'Content-Type': 'multipart/form-data'
                            }
                        
                    }).then(function (response){
                        me.cerrarModal();
                        //mostramos el articulo que fue insertado 
                        me.listarArticulo(1, '', 'nombre_producto');
                    }).catch(function (error){
                        console.log(error);
                    });

                },

                //funcion para actualizar articulo
                actualizarArticulo(){
                  //console.log(this.categoria_id);
                  //valdiamos el articulo
                    if(this.validarArticulo()){
                        return;
                    }
                    
                    let me = this;
                    let formData = new FormData();
                    formData.append('imagen', this.imagen_producto);
                    formData.append('id_categoria', this.id_categoria);
                    formData.append('nombre_producto', this.nombre_producto);
                    formData.append('id', this.articulo_id);
                    formData.append('imagen_anterior', this.imagen_anterior);
                    axios.post('/articulo/actualizar/',formData,{
                            headers: {
                                    'Content-Type': 'multipart/form-data'
                            }
                        //'id' : this.categoria_id
                    }).then(function (response){
                        me.cerrarModal();
                        me.listarArticulo(1, '', 'nombre_producto');
                    }).catch(function (error){
                        console.log(error);
                    });
                },
                
                //funcion para desactivar el articulo
                desactivarArticulo(id){
                      swal({
                        title: 'Esta seguro de desactivar este Producto?',
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
                            axios.put('/articulo/desactivar/'+id+'',{
                                
                            }).then(function (response) {
                                me.listarArticulo(1, '', 'nombre_producto');
                                swal(
                                'Desactivado!',
                                'El registro ha sido Desactivado con éxito.',
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

                        //funcion para activar el articulo
                      activarArticulo(id){
                      swal({
                        title: 'Esta seguro de activar este Producto?',
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
                            axios.put('/articulo/activar/'+id+'',{
                                
                            }).then(function (response) {
                                me.listarArticulo(1, '', 'nombre_producto');
                                swal(
                                'Activado!',
                                'El registro ha sido activado con éxito.',
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

                    //funcion para validar el articulo
                    validarArticulo(){
                        
                        this.errorArticulo = 0;
                        this.errorMostarMsjArticulo = [];


                        //si idcategoria esta en cero entonces no ha seleccionado un articulo
                        if(this.id_categoria==0) this.errorMostarMsjArticulo.push("Seleccione una categoria.");
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                        if(!this.nombre_producto) this.errorMostarMsjArticulo.push("El nombre del producto no puede estar vacio vacío.");
                        
                        //si el arreglo tiene datos entonces el error articulo es = 1, etonces hay errores
                        if(this.errorMostarMsjArticulo.length) this.errorArticulo = 1;

                        return this.errorArticulo;
                    },

                //funcion cerrar modal reset de variables
                cerrarModal(){
                    this.modal = 0;
                    this.tituloModal = '';
                    this.id_categoria=0;
                    this.nombre_categoria = '';
                    this.imagen_producto = '';
                    this.nombre_producto = ''; 
                    this.errorArticulo = 0;
                    this.imagen_anterior = '';
                },

                //funcion para abrir modal recibe 3 parametros que son modelo, accion (actualiza, registrar,y datos)
                abrirModal(modelo , accion, data = []){
                    switch(modelo){
                        
                        case "articulo":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Registrar Artículo';
                                        this.id_categoria = 0;
                                        this.nombre_categoria = '';
                                        this.imagen_producto = '';
                                        this.nombre_producto = '';
                                      
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                        //console.log(data);
                                        this.modal = 1;
                                        this.tituloModal = 'Actualizar Artículo';
                                        this.tipoAccion = 2;
                                        this.articulo_id=data['id'];
                                        this.id_categoria=data['id_categoria'];
                                        this.imagen_anterior = data['imagen_producto'];
                                        this.nombre_producto = data['nombre_producto'];
                                       
                                        break;
                                    }    
                            }
                        }
                    }
                    /**LISTAMOS LAS CATEGORIAS**/
                    this.selectCategoria();
                }
        },
        mounted() {
            this.listarArticulo(1,this.buscar,this.criterio);
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
