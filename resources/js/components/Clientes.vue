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
                        
                        <i class="fa fa-align-justify"></i> Clientes
                        <!--abrimos modal de articulos con una funcion  abrirModal recibiendo dos parametros-->
                        <button type="button" @click="abrirModal('cliente','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombres">Nombre</option>
                                      <option value="apellidos">Apellidos</option>
                                    
                                    </select>
                                    <!--@keyup.enter detecta si el usuario presiono la tecla enter-->
                                    <!--funcion para buscar articulos se busca por categoria o nombre del articulo-->
                                    <input type="text" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCliente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Correo Electronico</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Estado</th>
                                    <th>Ciudad</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <!--Listamos los aritculos que hay en la base de datos registrados-->
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td>
                                        <!--EN este caso si el usuario desea actualizar el articulo la funcion abrirModl recibe como segundo parametro actualizar-->
                                        <button type="button" @click="abrirModal('cliente','actualizar',cliente)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                      
                                    </td>
                                    <!--Mostramos los articulos-->
                                    
                                    <td v-text="cliente.email"></td>
                                    <td v-text="cliente.nombres"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.pais"></td>
                                    <td v-text="cliente.ciudad"></td>
                                    
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
                                    <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_usuario" name="" id="">
                                            <option value="0" disabled>Selecciona</option>
                                            <option v-for="usuario in arrayUser" :key="usuario.id" :value="usuario.id" v-text="usuario.email"></option>
                                        </select>
                                        
                                    </div>
                                </div>

                           
                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombres" class="form-control" placeholder="Nombre Del Vendedor">
                                        
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidos" class="form-control" placeholder="Apellidos Del Vendedor">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="pais" class="form-control" placeholder="Estado">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ciudad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ciudad" class="form-control" placeholder="Ciudad">
                                        
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCliente()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCliente()">Actualizar</button>
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
                
                cliente_id : 0,//variable para que es utilizada para acutlizar datos del cliente
                id_usuario : 0,//para saber a que usuario pertenece
                nombres : '',//mostrar el nombre del cliente
                usuario : '',
                apellidos : '',//apellidos del cliente
                pais : '',
                ciudad : '',
              

                
            /*almacenar los datos de los clientes para mostrarlos*/    
                arrayCliente : [],
                modal : 0,//variable modal para saber que opcion abrio el usuario si fue actualizar o registrar
                tituloModal : '',//titulo del modal actualizar o registrar
                tipoAccion : 0,//tipo de accion actualizar o registrar
                //guardamos los errores de los clientes
                errorCliente : 0,//si esta variable es mayor a cero entonces hay uno o mas errores
                errorMostarMsjCliente : [],
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
                arrayUser : []
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
            //funcion para mostrar los clientes
            listarCliente (page, buscar, criterio){
                let me=this;
                var url = '/cliente?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                     var respuesta = response.data;
                     me.arrayCliente = respuesta.clientes.data;  //pasamos los datos al arrayclientes 
                     me.pagination = respuesta.pagination; //pasamos los datos al arreglos pagination
                 })   
                 .catch(function (error){
                     console.log(error);
                 });
                },
                //funcion para seleccionar el usuario al quien pertenece
                selectUsuario(){
                let me=this;
                var url = '/usuario/selectUsuarioC';                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayUser = respuesta.usuarios;  //pasamos los datos al arrayusuario
                
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
                    me.listarCliente(page,buscar,criterio);

                },

               //funcion para registrar cliente
                registrarCliente(){
                    
                    //validamos los campos del cliente
                    if(this.validarCliente()){
                        return;
                    }
                    
                    let me = this;

                   //registramos el cliente 
                    axios.post('/cliente/registrar',{
                        'id_usuario' : this.id_usuario,
                       
                        'nombres' : this.nombres,

                        'apellidos' : this.apellidos,

                        'pais' : this.pais,

                        'ciudad' : this.ciudad,

                   
                        
                    }).then(function (response){
                        me.cerrarModal();
                        //mostramos el cliente que fue insertado 
                        me.listarCliente(1, '', 'nombres');
                    }).catch(function (error){
                        console.log(error);
                    });

                },

                //funcion para actualizar cliente
                actualizarCliente(){
                
                  //valdiamos el cliente
                    if(this.validarCliente()){
                        return;
                    }
                    
                    let me = this;

                    axios.put('/cliente/actualizar/'+this.cliente_id+'',{
                        'id_usuario' : this.id_usuario,
                        'nombres' : this.nombres,
                        'pais' : this.pais,
                        'ciudad' : this.ciudad,
                        'apellidos' : this.apellidos,
                      
                        
                
                    }).then(function (response){
                        me.cerrarModal();
                        me.listarCliente(1, '', 'nombres');
                    }).catch(function (error){
                        console.log(error);
                    });
                },

                    //funcion para validar el cliente
                    validarCliente(){
                        
                        this.errorVendedor = 0;
                        this.errorMostarMsjCliente = [];


                        //si idcategoria esta en cero entonces no ha seleccionado un usuario
                        if(this.id_usuario==0) this.errorMostarMsjCliente.push("Seleccione un Usuario.");
                        
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                        if(!this.nombres) this.errorMostarMsjCliente.push("El nombre del cliente no puede estar  vacío.");
                         if(!this.apellidos) this.errorMostarMsjCliente.push("Los Apellidos no pueden estar vacio .");
                            if(!this.pais) this.errorMostarMsjCliente.push("El Estado no puede esta vacío.");
                               if(!this.ciudad) this.errorMostarMsjCliente.push("La ciudad no puede estar vacío.");
                                    
                        
                        //si el arreglo tiene datos entonces el error clientes es = 1, etonces hay errores
                        if(this.errorMostarMsjCliente.length) this.errorCliente = 1;

                        return this.errorCliente;
                    },

                //funcion cerrar modal reset de variables
                cerrarModal(){
                    this.modal = 0;
                    this.tituloModal = '';
                    this.id_usuario=0;
                    this.usuario = '';
                    this.pais = '';
                    this.ciudad = '';
                   
                    this.nombres = '';
                    this.errorCliente = 0;
                },

                //funcion para abrir modal recibe 3 parametros que son modelo, accion (actualiza, registrar,y datos)
                abrirModal(modelo , accion, data = []){
                    switch(modelo){
                        
                        case "cliente":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Registrar Cliente';
                                        this.id_usuario = 0;
                                        this.usuario = '';
                                        this.nombres = '';
                                        this.apellidos = '';
                                        this.pais = '';
                                        this.ciudad = '';
                                       
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                       
                                        this.modal = 1;
                                        this.tituloModal = 'Actualizar Cliente';
                                        this.tipoAccion = 2;
                                        this.cliente_id=data['id'];
                                        this.id_usuario=data['id_usuario']; 
                                        this.nombres = data['nombres']
                                        this.apellidos = data['apellidos'];
                                        this.pais = data['pais'];
                                        this.ciudad = data['ciudad'];
                                       
                                       
                                        break;
                                    }    
                            }
                        }
                    }
                    /**LISTAMOS LLOS USUARIOS**/
                    this.selectUsuario();
                }
        },
        mounted() {
            this.listarCliente(1,this.buscar,this.criterio);
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
