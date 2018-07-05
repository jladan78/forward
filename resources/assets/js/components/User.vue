<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Users
                        <button type="button" @click="abrirModal('person','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;New
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="name">Name</option>
                                      <option value="email">Email</option>
                                      <option value="Phone">Phone</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Text to search">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Ops</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>User</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="person in arrayPersona" :key="person.id">
                                    <td>
                                        <button type="button" @click="abrirModal('person','update',person)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="person.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(person.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(person.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="person.first_name"></td>
                                    <td v-text="person.last_name"></td>
                                    <td v-text="person.phone"></td>
                                    <td v-text="person.email"></td>
                                    <td v-text="person.usuario"></td>
                                    <td v-text="person.rol"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/update-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <el-form :model="userForm" :rules="rules" ref="userForm" size="small"  label-width="120px" label-position="right" class="classUserForm">
                            
                                        <el-form-item label="First name: " prop="first_name" style="margin-bottom:15px;">
                                            <el-input v-model="userForm.first_name"></el-input>
                                        </el-form-item>
                                        
                                        <el-form-item label="Last name: " prop="last_name" class="wmb" style="margin-bottom:15px;">
                                            <el-input v-model="userForm.last_name"></el-input>
                                        </el-form-item>
                                        
                                        <el-form-item label="Address: " prop="address" style="margin-bottom:15px;">
                                            <el-input v-model="userForm.address"></el-input>
                                        </el-form-item>

                                        <el-form-item label="Phone " prop="phone"  style="margin-bottom:15px;">
                                            <el-input v-model="userForm.phone"></el-input>
                                        </el-form-item>
                                    
                                        <el-form-item label="Email " prop="email"  style="margin-bottom:15px;">
                                            <el-input v-model="userForm.email"></el-input>
                                        </el-form-item>
                                    
                                        <el-form-item label="Role" prop="idrol">
                                            <el-select v-model="userForm.idrol" placeholder="select user role">
                                                <el-option
                                                v-for="role in arrayRol"  :key="role.id" :label="role.nombre" :value="role.id">
                                                </el-option>
                                            </el-select>
                                        </el-form-item> 
                                    
                                        <el-form-item label="User: " prop="usuario" style="margin-bottom:15px;">
                                            <el-input v-model="userForm.usuario"></el-input>
                                        </el-form-item>
                                    
                                        <el-form-item label="Password:" prop="password">
                                            <el-input type="password" v-model="userForm.password" ></el-input>
                                        </el-form-item>
                                    
                            </el-form>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancel</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Save</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updatePersona()">Update</button>
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
    import lang from 'element-ui/lib/locale/lang/en';
    import locale from 'element-ui/lib/locale';
    import moment from 'moment';
 
    locale.use(lang)
    export default {
        data (){
            return {
                person_id: 0,
                userForm:{
                    first_name : '',
                    last_name : '',
                    address : '',
                    phone : '',
                    email : '',
                    usuario: '',
                    password:'',
                    idrol: ''
                },
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'name',
                buscar : '',
                rules: {
                        first_name: [
                            { required: true, message: 'Please input first name of user', trigger: 'blur' }
                        ],
                        last_name: [
                            { required: true, message: 'Please input last name of user', trigger: 'blur' }
                        ],
                        email: [
                            { required: true, message: 'Please input email of client', trigger: 'blur' }
                        ],
                        idrole: [
                            { required: true, message: 'Please select the user´s role', trigger: 'change' }
                        ],
                        usuario: [
                            { required: true, message: 'Please input a user name', trigger: 'blur' },
                            { min: 4, message: 'Length should be  4 or more chars', trigger: 'blur' }

                        ],
                        password: [
                            { required: true, message: 'Please input the password', trigger: 'blur' },
                            { min: 4, message: 'Length should be  3 or more chars', trigger: 'blur' }

                        ]
                        }
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarPersona (page,buscar,criterio){
                let me=this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.persons.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPersona(page,buscar,criterio);
            },

            resetForm(formName) {

                this.$refs[formName].resetFields();
            },

            registrarPersona(){

                this.$refs["userForm"].validate((valid) => {
                if (valid) {
                        let me = this;

                        axios.post('/user/registrar',{
                            'first_name': this.userForm.first_name,
                            'last_name': this.userForm.last_name,
                            'address' : this.userForm.address,
                            'phone' : this.userForm.phone,
                            'email' : this.userForm.email,
                            'idrol' : this.userForm.idrol,
                            'usuario': this.userForm.usuario,
                            'password': this.userForm.password

                        }).then(function (response) {
                            me.cerrarModal();
                            me.listarPersona(1,'','name');
                        }).catch(function (error) {
                            console.log(error);
                        });
                }else{
                     console.log('error submit!!');
                    return false;
                }
                });
            },
            updatePersona(){

                this.$refs["userForm"].validate((valid) => {
                if (valid) {
                        let me = this;
                        axios.put('/user/update',{
                            'first_name': this.userForm.first_name,
                            'last_name': this.userForm.last_name,
                            'address' : this.userForm.address,
                            'phone' : this.userForm.phone,
                            'email' : this.userForm.email,
                            'idrol' : this.userForm.idrol,
                            'usuario': this.userForm.usuario,
                            'password': this.userForm.password,
                            'id': this.person_id
                        }).then(function (response) {
                            me.cerrarModal();
                            me.listarPersona(1,'','name');
                        }).catch(function (error) {
                            console.log(error);
                        }); 
                }else{
                    console.log('error submit!!');
                    return false;
                }
                });
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.userForm.first_name) this.errorMostrarMsjPersona.push("El name de la pesona no puede estar vacío.");
                if (!this.user) this.errorMostrarMsjPersona.push("El name de user no puede estar vacío.");
                if (!this.userForm.password) this.errorMostrarMsjPersona.push("La password del user no puede estar vacía.");
                if (this.userForm.idrol==0) this.errorMostrarMsjPersona.push("Seleccione una Role.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.userForm.first_name='';
                this.userForm.last_name='';
                this.userForm.address='';
                this.userForm.phone='';
                this.userForm.email='';
                this.userForm.usuario='';
                this.userForm.password='';
                this.userForm.idrol='';
                this.errorPersona=0;
                 this.resetForm('userForm');
            },
            abrirModal(modelo, accion, data = []){
                this.selectRol();
                switch(modelo){
                    case "person":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Register User';
                                this.userForm.first_name= '';
                                this.userForm.last_name='';
                                this.userForm.address='';
                                this.userForm.phone='';
                                this.userForm.email='';
                                this.userForm.usuario='';
                                this.userForm.password='';
                                this.userForm.idrol='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Update User';
                                this.tipoAccion=2;
                                this.person_id=data['id'];
                                this.userForm.first_name = data['first_name'];
                                this.userForm.last_name = data['last_name'];
                                this.userForm.address = data['address'];
                                this.userForm.phone = data['phone'];
                                this.userForm.email = data['email'];
                                this.userForm.usuario = data['usuario'];
                                this.userForm.password=data['password'];
                                this.userForm.idrol=data['idrol'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarUsuario(id){
               swal({
                title: 'Are you sure of disabled this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK!',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','name');
                        swal(
                        'Disabled!',
                        'The user has been disabled succesfully.',
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
            activarUsuario(id){
               swal({
                title: 'Are you sure of enabled this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','name');
                        swal(
                        'Enabled!',
                        'The user has been enabled succsessfully.',
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
            this.listarPersona(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
     .modal {
         overflow-y: scroll;
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
        color: red !important;
        font-weight: bold;
    }
</style>
