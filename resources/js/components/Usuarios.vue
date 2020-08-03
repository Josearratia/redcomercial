<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Usuarios
                         <!--abrimos modal de categorias con una funcion  abrirModal recibiendo dos parametros-->
                        <button type="button" @click="abrirModal('usuario','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="email">Correo</option>
                                      
                                    </select>
                                    <!--@keyup.enter detecta si el usuario presiono la tecla enter-->
                                    <input type="text" v-model="buscar" @keyup.enter="listarUsuario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarUsuario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Correo Electronico</th>
                                    <th>Password</th>
                                    <th>Roll</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--mostramos las catgorias registradas-->
                                <tr v-for="usuario in arrayUsuario" :key="usuario.id">
                                    <td>
                                        <button type="button" @click="abrirModal('usuario','actualizar',usuario)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="usuario.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="usuario.email"></td>
                                    <td v-text="usuario.password"></td>
                                    <td v-if="usuario.rol == 1">Administrador</td>
                                    <td v-else-if="usuario.rol == 2">Vendedor</td>
                                    <td v-else-if="usuario.rol == 3">Cliente</td>
                                    <td>
                                        <div v-if="usuario.condicion">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Correo Electronico</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Correo">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Roll</label>
                                    <div class="col-md-9">
            
                                         <select class="form-control" v-model="rol" name="" id="">
                                            <option value="0" disabled>Roll Usuario</option>
                                            <option :value="1">Administrador</option>
                                            <option :value="2">Vendedor</option>
                                            <option :value="3">Cliente</option>
                                        </select>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUsuario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUsuario()">Actualizar</button>
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
                user_id : 0,//id categoria
                email : '',//nombre usuario
                password : '',
                rol : '',
                arrayUsuario : [],
            /*almacenar los datos de los usuarios para mostrarlos*/ 
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUsuario : 0,
                errorMostarMsjUsuario : [],
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
            //funcion para mostrar las categorias
            listarUsuario (page, buscar, criterio){
                let me=this;
                var url = 'usuario?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                     me.arrayUsuario = respuesta.usuarios.data;  //pasamos los datos al arrayUsuario
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
                    me.listarUsuario(page,buscar,criterio);

                },
                 //funcion para registrar Usuario
                registrarUsuario(){
                    
                    if(this.validarUsuario()){
                        return;
                    }
                    
                    let me = this;

                    axios.post('/usuario/registrar',{
                        'email' : this.email,
                        'password' : this.password,
                        'rol' : this.rol

                    }).then(function (response){
                        me.cerrarModal();
                        me.listarUsuario(1, '', 'email');
                    }).catch(function (error){
                        console.log(error);
                    });

                },
                //funcion para actualizar usuario
                actualizarUsuario(){
                  
                    if(this.validarUsuario()){
                        return;
                    }
                    
                    let me = this;

                    axios.put('/usuario/actualizar/'+this.user_id+'',{
                        'email' : this.email,
                        'password' : this.password,
                        'rol' : this.rol
                       
                    }).then(function (response){
                        me.cerrarModal();
                        me.listarUsuario(1, '', 'email');
                    }).catch(function (error){
                        console.log(error);
                    });
                },
                //funcion para desactivar usuario
                desactivarUsuario(id){
                      swal({
                        title: 'Esta seguro de desactivar este Usuario?',
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
                            axios.put('/usuario/desactivar/'+id+'',{
                                
                            }).then(function (response) {
                                me.listarUsuario(1, '', 'email');
                                swal(
                                'Desactivado!',
                                'El usuario ha sido Desactivado con éxito.',
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
                    //funcion para activar usuario
                      activarUsuario(id){
                      swal({
                        title: 'Esta seguro de activar este Usuario?',
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
                            axios.put('/usuario/activar/'+id+'',{
                                
                            }).then(function (response) {
                                me.listarUsuario(1, '', 'email');
                                swal(
                                'Activado!',
                                'El registro ha sido activado.',
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
                    //funcion para validar el usuario
                    validarUsuario(){
                        this.errorUsuario = 0;
                        this.errorMostarMsjUsuario = [];
                        //comprobamos si estan vacios estas variables en caso de que si hacemos un push al arreglo de errores
                        if(!this.email) this.errorMostarMsjUsuario.push("El correo no debe estar vacio.");
                        if(!this.password) this.errorMostarMsjUsuario.push("El contraseña no debe estar vacia.");
                        if(!this.rol) this.errorMostarMsjUsuario.push("Elige un Roll.");
                        //si el arreglo tiene datos entonces el error usuario es = 1, etonces hay errores
                        if(this.errorMostarMsjUsuario.length) this.errorUsuario = 1;

                        return this.errorUsuario;
                    },
                //funcion cerrar modal reset de variables    
                cerrarModal(){
                    this.modal = 0;
                    this.tituloModal = '';
                    this.email = '';
                    this.password = '';
                    this.rol = ''
                },
                //funcion para abrir modal recibe 3 parametros que son modelo, accion (actualiza, registrar,y datos)
                abrirModal(modelo , accion, data = []){
                    switch(modelo){
                        case "usuario":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Registrar Usuario';
                                        this.email = '';
                                        this.password = '';
                                        this.rol = '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                        //console.log(data);
                                        this.modal = 1;
                                        this.tituloModal = 'Actualizar Usuario';
                                        this.tipoAccion = 2;
                                        this.user_id=data['id'];
                                        this.email = data['email'];
                                        this.password = data['password'];
                                        this.rol = data['rol'];
                                        break;
                                    }    
                            }
                        }
                    }
                }
        },
        mounted() {
            this.listarUsuario(1,this.buscar,this.criterio);
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
