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
                        
                        <i class="fa fa-align-justify"></i> Empresas
                        <!--abrimos modal de vendedores con una funcion  abrirModal recibiendo dos parametros-->
                        <button type="button" @click="abrirModal('empresa','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_empresa">Nombre Empresa</option>
                                      <option value="ciudad">Ciudad</option>
                                    
                                    </select>
                                    <!--@keyup.enter detecta si el usuario presiono la tecla enter-->
                                    <!--funcion para buscar articulos se busca por categoria o nombre del articulo-->
                                    <input type="text" v-model="buscar" @keyup.enter="listarEmpresa(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEmpresa(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Dueño</th>
                                    <th>Nombre Empresa</th>
                                    <th>Pais</th>
                                    <th>Ciudad</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listamos las empresas que hay en la base de datos registrados-->
                                <tr v-for="empresa in arrayEmpresa" :key="empresa.id">
                                    <td>
                                        <!--EN este caso si el usuario desea actualizar el articulo la funcion abrirModl recibe como segundo parametro actualizar-->
                                        <button type="button" @click="abrirModal('empresa','actualizar',empresa)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                      
                                    </td>
                                    <!--Mostramos las empresas-->
                                    
                                    <td v-text="empresa.nombres"></td>
                                    <td v-text="empresa.nombre_empresa"></td>
                                    <td v-text="empresa.pais"></td>
                                    <td v-text="empresa.ciudad"></td>
                                    <td v-text="empresa.latitud"></td>
                                    <td v-text="empresa.longitud"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Dueño Empresa</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_vendedor" name="" id="">
                                            <option value="0" disabled>Selecciona</option>
                                            <option v-for="vendedor in arrayVendedor" :key="vendedor.id" :value="vendedor.id" v-text="vendedor.nombres"></option>
                                        </select>
                                        
                                    </div>
                                </div>

                           
                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre Empresa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre_empresa" class="form-control" placeholder="Nombre Del la empresa">
                                        
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Pais</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="pais" class="form-control" placeholder="pais">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ciudad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ciudad" class="form-control" placeholder="ciudad">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Latitud</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="latitud" class="form-control" placeholder="Latitud">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Longitud</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="longitud" class="form-control" placeholder="Longitud">
                                        
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEmpresa()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEmpresa()">Actualizar</button>
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
                
                empresa_id : 0,//variable para que es utilizada para acutlizar datos del la empresas
                id_vendedor : 0,//para saber a que vendedor pertenece
                nombre_empresa : '',//mostrar el nombre del la empresa
                pais : '',
                ciudad : '',
                latitud : '',//apellidos del vendedor
                longitud : '',
                nombres : '', 
                
            /*almacenar los datos de los vendedores para mostrarlos*/    
                arrayEmpresa : [],
                modal : 0,//variable modal para saber que opcion abrio la empresa si fue actualizar o registrar
                tituloModal : '',//titulo del modal actualizar o registrar
                tipoAccion : 0,//tipo de accion actualizar o registrar
                //guardamos los errores de las empresas
                errorEmpresa : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjEmpresa : [],
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
                arrayVendedor : []
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
            //funcion para mostrar las empresas
            listarEmpresa (page, buscar, criterio){
                let me=this;
                var url = '/empresa?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayEmpresa = respuesta.empresas.data;  //pasamos los datos al arrayempresas 
                     me.pagination = respuesta.pagination; //pasamos los datos al arreglos pagination
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },
                //funcion para seleccionar al vendedor al quien pertenece
                selectVendedor(){
                let me=this;
                var url = '/vendedor/selectVendedor';                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayVendedor = respuesta.vendedores;  //pasamos los datos al arrayvendedor
                
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
                    me.listarEmpresa(page,buscar,criterio);

                },

               //funcion para registrar empresa
                registrarEmpresa(){
                    
                    //validamos los campos de la empresa
                    if(this.validarEmpresa()){
                        return;
                    }
                    
                    let me = this;

                   //registramos a la empresa 
                    axios.post('/empresa/registrar',{
                        'id_vendedor' : this.id_vendedor,
                       
                        'nombre_empresa' : this.nombre_empresa,

                        'pais' : this.pais,

                        'ciudad' : this.ciudad,

                        'latitud' : this.latitud,

                        'longitud' : this.longitud,
                        
                    }).then(function (response){
                        me.cerrarModal();
                        //mostramos el vendedor que fue insertado 
                        me.listarEmpresa(1, '', 'nombre_empresa');
                    }).catch(function (error){
                        console.log(error);
                    });

                },

                //funcion para actualizar empresa
                actualizarEmpresa(){
                
                  //valdiamos el articulo
                    if(this.validarEmpresa()){
                        return;
                    }
                    
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
                
                    }).then(function (response){
                        me.cerrarModal();
                        me.listarEmpresa(1, '', 'nombre_empresa');
                    }).catch(function (error){
                        console.log(error);
                    });
                },

                    //funcion para validar Empresa
                    validarEmpresa(){
                        
                        this.errorEmpresa = 0;
                        this.errorMostarMsjEmpresa = [];


                        //si id_vendedor esta en cero entonces no ha seleccionado un vendedor
                        if(this.id_vendedor==0) this.errorMostarMsjEmpresa.push("Seleccione un Vendedor.");
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                        if(!this.nombre_empresa) this.errorMostarMsjEmpresa.push("El nombre del la empresa no puede estar vacío.");
                         if(!this.pais) this.errorMostarMsjEmpresa.push("El pais no puede estar vacío.");
                          if(!this.ciudad) this.errorMostarMsjEmpresa.push("La ciudad no puede ir vacío.");
                           if(!this.latitud) this.errorMostarMsjEmpresa.push("Latitud no puede ir vacío.");
                            if(!this.longitud) this.errorMostarMsjEmpresa.push("Longitud no puede ir vacío");
                        
                        //si el arreglo tiene datos entonces el error empresa es = 1, etonces hay errores
                        if(this.errorMostarMsjEmpresa.length) this.errorEmpresa = 1;

                        return this.errorEmpresa;
                    },

                //funcion cerrar modal reset de variables
                cerrarModal(){
                    this.modal = 0;
                    this.tituloModal = '';
                    this.id_vendedor=0;
                    this.nombres = '';
                    this.nombre_empresa = '';
                    this.pais = '';
                    this.ciudad = '';
                    this.longitud = '';
                    this.latitud = '';
                    this.errorEmpresa = 0;
                },

                //funcion para abrir modal recibe 3 parametros que son modelo, accion (actualiza, registrar,y datos)
                abrirModal(modelo , accion, data = []){
                    switch(modelo){
                        
                        case "empresa":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Registrar Empresa';
                                        this.id_vendedor = 0;
                                        this.nombres = '';
                                        this.nombre_empresa = '';
                                        this.pais = '';
                                        this.ciudad= '';
                                        this.latitud = '';
                                        this.longitud = '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                       
                                        this.modal = 1;
                                        this.tituloModal = 'Actualizar Empresa';
                                        this.tipoAccion = 2;
                                        this.empresa_id = data['id'];
                                        this.id_vendedor = data['id_vendedor']; 
                                        this.nombre_empresa = data['nombre_empresa']
                                        this.pais = data['pais'];
                                        this.ciudad = data['ciudad'];
                                        this.longitud = data['longitud'];
                                        this.latitud = data['latitud'];
                                       
                                        break;
                                    }    
                            }
                        }
                    }
                    /**LISTAMOS LOS VENDEDORES**/
                    this.selectVendedor();
                }
        },
        mounted() {
            this.listarEmpresa(1,this.buscar,this.criterio);
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
