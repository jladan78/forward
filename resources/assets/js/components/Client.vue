<template>
        <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        </ol>
        <template v-if="listado">     
            <div class="container-fluid">
                <!-- Tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Clients
                        <button type="button" @click="abrirModal('client','register')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;New
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="first_name">First Name</option>
                                      <option value="last_name">Last Name</option>
                                      <option value="id_document">ID Document</option>
                                      <option value="reference">Reference</option>
                                      <option value="phone">Phone</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listClient(1,buscar,criterio)" class="form-control" placeholder="Search...">
                                    <button type="submit" @click="listClient(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                            <el-table
                                :data="arrayClient"
                                :default-sort = "{prop: 'id', order: 'descending'}"
                                style="width: 100%"  class="table table-responsive-sm table-sm">
                                <el-table-column label="Operations"  fixed="right" width="100">
                                    <template slot-scope="props">
                                        <button type="button" class="btn btn-warning btn-sm"  @click="abrirModal('client','update',props.row)">    
                                            <i class="icon-pencil"></i>
                                        </button> 
                                        <!-- <button type="button" class="btn btn-danger btn-sm" @click="deleteMbrp_questionnaire(props.row.id)">
                                            <i class="icon-trash"></i>
                                        </button> -->
                                    </template>
                                </el-table-column>
                                <el-table-column type="expand">
                                    <template slot-scope="props">
                                        <p>ID Document: {{ props.row.id_document }}</p>
                                        <p>Address: {{ props.row.address }}</p>                                            
                                        <p>Date of Birthday: {{ props.row.dob |moment("DD-MM-YYYY")}}</p>
                                        <p>Contact: {{ props.row.contact }}</p>
                                        <p>Contact Phone: {{ props.row.contact_phone }}</p>
                                    </template>
                                </el-table-column>
                                <!-- <el-table-column label="Ref." prop="reference" sortable ></el-table-column> -->
                                <el-table-column label="Ref"  prop="reference" sortable >
                                    <template slot-scope="props">
                                        <el-button @click="mostrarDetalle(props.row)" type="text" size="medium">{{props.row.reference}}</el-button>
                                    </template>
                                </el-table-column>
                                <el-table-column label="Initials"  prop="initials" sortable ></el-table-column>
                                <el-table-column label="First Name"  prop="first_name" sortable ></el-table-column>
                                <el-table-column label="Last Name"       prop="last_name" sortable >     </el-table-column>
                                <el-table-column label="Age" prop="dob"  :formatter="formatter_age" sortable>     </el-table-column>
                                <el-table-column label="Phone"   prop="phone" sortable >     </el-table-column> 
                                <el-table-column label="Email"   prop="email" sortable >     </el-table-column> 
                            
                            </el-table>
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
                <!-- Fin  tabla Listado -->
            </div>
            </template>
                <!-- FICHA CLIENTE  -->
            <template v-else> 
            <div class="container-fluid">
                <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <i class="fa fa-align-justify"></i> Client    
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">
                                        <i class="icon-action-undo"></i>&nbsp;Back to list
                                    </button> 
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <h3 class="">
                       <i class="icon-user icons font-2xl"></i> &nbsp; {{this.clientForm.first_name}}&nbsp;{{this.clientForm.last_name}} </h3>


                    <el-tabs type="border-card">
                    <el-tab-pane style="min-height: 300px;">
                        <span slot="label"><i class="el-icon-date"></i> About</span>
                        
<div class="row">
    <div class="col-sm-6 col-md-3 col-lg-2">
        <div class="card">
            <div class="card-body">
              
                <h6 class="card-title"> Reference:</h6>
                <div class="text-value text-right">{{this.clientForm.reference}}</div>
                <!-- <div class="card-text">
                    <h4>{{this.clientForm.reference}}</h4>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">  Reference:</h3>
                <div class="card-text text-right">
                   <h4>{{this.clientForm.reference}}</h4> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-2">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"></h3>
                <div class="card-text">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-2">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"></h3>
                <div class="card-text">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Address</h6>
               
                    <div class="text-value"> Address: <div class="text-value text-right">{{this.clientForm.address}}</div> </div>
                    <div class="text-value"> Email: </div><div class="text-value  text-right">{{this.clientForm.email}}</div>
                    <div class="text-value"> Phone: </div><div class="text-value text-right">{{this.clientForm.phone}}</div>
              
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">The title</h3>
                <div class="card-text">
                    The text
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-3">
    <div class="card text-white bg-info">
        <div class="card-body">
        <div class="h1 text-muted text-right mb-4">
            <i class="icon-people"></i>
        </div>
        <div class="text-value">87.500</div>
        <small class="text-muted text-uppercase font-weight-bold">Visitors</small>
        <div class="progress progress-white progress-xs mt-3">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </div>
    </div>
    </div>
    <!--/.col-->
    <div class="col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
            <div class="text-value">89.9%</div>
            <div>Lorem ipsum...</div>
            <div class="progress progress-xs my-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">Lorem ipsum dolor sit amet enim.</small>
            </div>
        </div>
    </div>

    <!--/.col-->
    <div class="col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body text-center">
            <div class="text-muted small text-uppercase font-weight-bold">Title</div>
            <div class="text-value-lg py-3">1,123</div>
            <div class="chart-wrapper mx-auto" style="height:40px;width:80px">
                <canvas id="sparkline-chart-1" class="chart chart-bar" height="40" width="80"></canvas>
            </div>
            </div>
        </div>
    </div>
    <!--/.col-->
    <div class="col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body p-3 d-flex align-items-center">
            <i class="fa fa-cogs bg-primary p-3 font-2xl mr-3"></i>
            <div>
                <div class="text-value-sm text-primary">$1.999,50</div>
                <div class="text-muted text-uppercase font-weight-bold small">Income</div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- -->

                    </el-tab-pane>
                    <el-tab-pane label="MBRP Questionnaires" name='MB' style="min-height: 500px;">
                        <mbrp_quest_cli
                            :mbrp_cli_id ="this.person_id"
                        >
                        </mbrp_quest_cli>  
                    </el-tab-pane>
                    <el-tab-pane label="Health & well-being Tracker" name='HW' style="min-height: 300px;">
                        <hwbTracker_cli
                            :hwb_cli_id ="this.person_id"
                            :hwb_cli_ref ="this.clientForm.reference">
                        </hwbTracker_cli>

                    </el-tab-pane>
                    <el-tab-pane label="Task" style="min-height: 300px;">Task</el-tab-pane>
                    </el-tabs>

                    </div>
                </div>
               
            </div>
            </template>

            <!--Inicio del modal agregar/update-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body cli">

                            <el-form :model="clientForm" :rules="rules" ref="clientForm" size="small"  label-position="left" class="classclientForm">
                               <div class="form-group row sw">
                                    <div class="col-md-4">
                                        <el-form-item label="First name " prop="first_name" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.first_name"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-6">
                                         <el-form-item label="Last name " prop="last_name" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.last_name"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-2">
                                        <el-form-item label="Initials " prop="initials" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.initials"></el-input>
                                        </el-form-item>
                                    </div>
                               </div>
                                <div class="form-group row sw">
                                    <div class="col-md-4">
                                         <el-form-item label="Reference " prop="reference" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.reference"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-4">
                                        <el-form-item label="ID document " prop="id_document" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.id_document"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-4">
                                        <el-form-item label="Date of Birth" prop="dob" class="wmb" style="margin-bottom:0px;">
                                            <el-date-picker type="date" placeholder="Pick a date" v-model="clientForm.dob" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                        </el-form-item>
                                    </div>
                                </div>
                                 <div class="form-group row sw">
                                    <div class="col-md-12">
                                        <el-form-item label="Address " prop="address" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.address"></el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                                <div class="form-group row sw">
                                     <div class="col-md-6">
                                        <el-form-item label="Phone " prop="phone" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.phone"></el-input>
                                        </el-form-item>
                                     </div> 
                                     <div class="col-md-6">
                                        <el-form-item label="Email " prop="email" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.email"></el-input>
                                        </el-form-item>
                                     </div>   
                                </div>
                                <div class="form-group row sw">
                                     <div class="col-md-6">
                                        <el-form-item label="Contact " prop="contact" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.contact" placeholder="add a contact name"></el-input>
                                        </el-form-item> 
                                     </div>  
                                    <div class="col-md-6"> 
                                        <el-form-item label="Contact Phone " prop="contact_phone" class="wmb" style="margin-bottom:0px;">
                                            <el-input v-model="clientForm.contact_phone"></el-input>
                                        </el-form-item> 
                                    </div>  
                                </div>


                            </el-form>
                            <!-- <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">      
                            </form> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cancel</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerClient()">Save</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateClient()">Update</button>
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
 

    const booleanFilter = function(value, trueText, falseText) {
    return value ? trueText || 'Yes' : falseText || 'No';
    }

    locale.use(lang)
     export default {
            filters: {
                boolean: booleanFilter
             }, 
           components:{
            // 'el-button': Button,
            // 'el-select': Select,
            // 'el-DatePicker': DatePicker,
            // 'el-table': Table,
            // 'el-checkbox': Checkbox,
            // 'el-tabs': Tabs
            },
        data (){
            return {
                person_id: 0,
                clientForm:{
                    first_name : '',
                    last_name : '',
                    id_document : '',
                    address : '',
                    phone : '',
                    email : '',
                    reference : '',
                    initials : '',
                    dob : '',
                    contact:'',
                    contact_phone :''
                },
                arrayClient : [],
                modal : 0,
                listado : 1,
                tituloModal : '',
                tipoAccion : 0,
                errorClient : 0,
                errorMostrarMsjClient : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'first_name',
                buscar : '',
                rules: {
                        first_name: [
                            { required: true, message: 'Please input first name of client', trigger: 'blur' }
                        ],
                        last_name: [
                            { required: true, message: 'Please input last name of client', trigger: 'blur' }
                        ],
                        initials: [
                            { required: true, message: 'Please input initials of client', trigger: 'blur' }
                        ],
                        reference: [
                            { required: true, message: 'Please input a reference for the client', trigger: 'blur' },
                            { min: 5, max: 5, message: 'Length should be  5', trigger: 'blur' }

                        ],
                         dob: [
                            { required: true, message: 'Please pick a DOB', trigger: 'change' }
                        ],
                        /*type: [
                            { type: 'array', required: true, message: 'Please select at least one activity type', trigger: 'change' }
                        ],
                        resource: [
                            { required: true, message: 'Please select activity resource', trigger: 'change' }
                        ],
                        desc: [
                            { required: true, message: 'Please input activity form', trigger: 'blur' }
                        ] */
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
            listClient (page,buscar,criterio){
                let me=this;
                var url= '/client?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayClient = respuesta.persons.data;
                    me.pagination= respuesta.pagination;
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
                me.listClient(page,buscar,criterio);
            },
            
            resetForm(formName) {

                this.$refs[formName].resetFields();
            },

            registerClient(){
/*                 if (this.validateClient()){
                    return;
                } */

                this.$refs["clientForm"].validate((valid) => {
                if (valid) {
                      let me = this;

                        axios.post('/client/register',{
                            'first_name': this.clientForm.first_name,
                            'last_name': this.clientForm.last_name,
                            'id_document' : this.clientForm.id_document,
                            'address' : this.clientForm.address,
                            'phone' : this.clientForm.phone,
                            'email' : this.clientForm.email,
                            'reference':this.clientForm.reference,
                            'initials':this.clientForm.initials,
                            'dob':this.clientForm.dob,
                            'contact':this.clientForm.contact,
                            'contact_phone':this.clientForm.contact_phone
                        }).then(function (response) {
                            me.cerrarModal();
                            me.listClient(1,'','first_name');
                        }).catch(function (error) {
                            console.log(error);
                        });
                } else {
                    console.log('error submit!!');
                    return false;
                }
                });
            
            },
            updateClient(){
            //    if (this.validateClient()){
            //         return;
            //     }
                this.$refs["clientForm"].validate((valid) => {
                if (valid) {
                    let me = this;

                    axios.put('/client/update',{
                        'first_name': this.clientForm.first_name,
                        'last_name': this.clientForm.last_name,
                        'id_document' : this.clientForm.id_document,
                        'address' : this.clientForm.address,
                        'phone' : this.clientForm.phone,
                        'email' : this.clientForm.email,
                        'reference':this.clientForm.reference,
                        'initials':this.clientForm.initials,
                        'dob':this.clientForm.dob,
                        'contact':this.clientForm.contact,
                        'contact_phone':this.clientForm.contact_phone,
                        'id': this.person_id
                    }).then(function (response) {
                        me.cerrarModal();
                        me.listClient(1,'','first_name');
                    }).catch(function (error) {
                        console.log(error);
                    }); 
                }else{
                    console.log('error submit!!');
                    return false;
                }
                });
                
            },            
            validateClient(){
                this.errorClient=0;
                this.errorMostrarMsjClient =[];

                if (!this.clientForm.first_name) this.errorMostrarMsjClient.push("The first_name can´t be empty");
                if (!this.clientForm.reference) this.errorMostrarMsjClient.push("The reference can´t be empty");
                if (!this.clientForm.dob) this.errorMostrarMsjClient.push("The date of birth can´t be empty");

                if (this.errorMostrarMsjClient.length) this.errorClient = 1;

                return this.errorClient;
            },
            calculateAge(date) {
                var today = new Date();
                var birthdate = new Date(date);
                var age = today.getFullYear() - birthdate.getFullYear();
                var m = today.getMonth() - birthdate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }

                return age;
            },
            formatter_check(row, column) {
                 const property = column['property'];
                 return row[property]==0 ? 'No' : 'Yes';

            },
            formatter_date(row, column) {
                const property = column['property'];
                if (!row[property]) {
                    return 'N/A'
                    }
                return moment(row[property], 'YYYY-MM-DD').format('DD/MM/YYYY');

            },
            formatter_age(row, column) {
                const property = column['property'];
                if (!row[property]) {
                    return 'N/A'
                    }
                return this.calculateAge(row[property]);

            },
            mostrarDetalle(data = []){

                this.listado=0;
                this.person_id=data['id'];
                this.clientForm.reference=data['reference'];
                this.clientForm.first_name=data['first_name'];
                this.clientForm.last_name=data['last_name'];
                this.clientForm.initials=data['initials'];
                this.clientForm.dob=data['dob'];
                this.clientForm.id_document=data['id_document'];
                this.clientForm.address=data['address'];
                this.clientForm.email=data['email'];
                this.clientForm.phone=data['phone'];
                this.clientForm.contact=data['contact'];
                this.clientForm.contact_phone=data['contact_phone'];


            },
            ocultarDetalle(){
                this.listado=1;
                this.person_id=0;
                this.clientForm.reference='';
                this.clientForm.first_name='';
                this.clientForm.last_name='';
                this.clientForm.initials='';
                this.clientForm.dob='';
                this.clientForm.id_document='';
                 this.clientForm.address='';
                this.clientForm.email='';
                this.clientForm.phone='';
                this.clientForm.contact='';
                this.clientForm.contact_phone='';


                this.listClient(1,'','first_name');
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.clientForm.first_name='';
                this.clientForm.last_name='';
                this.clientForm.id_document='';
                this.clientForm.address='';
                this.clientForm.phone='';
                this.clientForm.email='';
                this.clientForm.reference='';
                this.clientForm.initials='';
                this.clientForm.dob='';
                this.clientForm.contact='';
                this.clientForm.contact_phone='';
                this.errorClient=0;
                 this.resetForm('clientForm');

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "client":
                    {
                        switch(accion){
                            case 'register':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Register Client';
                                this.clientForm.first_name= '';
                                this.clientForm.last_name='';
                                this.clientForm.id_document='';
                                this.clientForm.address='';
                                this.clientForm.phone='';
                                this.clientForm.email='';
                                this.clientForm.reference='';
                                this.clientForm.initials='';
                                this.clientForm.dob='';
                                this.clientForm.contact='';
                                this.clientForm.contact_phone='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Update Client';
                                this.tipoAccion=2;
                                this.person_id=data['id'];
                                this.clientForm.first_name = data['first_name'];
                                this.clientForm.last_name = data['last_name'];
                                this.clientForm.id_document = data['id_document'];
                                this.clientForm.address = data['address'];
                                this.clientForm.phone = data['phone'];
                                this.clientForm.email = data['email'];
                                this.clientForm.reference = data['reference'];
                                this.clientForm.initials = data['initials'];
                                this.clientForm.dob = data['dob'];
                                this.clientForm.contact = data['contact'];
                                this.clientForm.contact_phone = data['contact_phone'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listClient(1,this.buscar,this.criterio);
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
   
    .modal-body .cli{
         height: 470px; 
       /* height: 100%;*/
        width: 100%;
        overflow-y: auto;
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
    .sw {
        padding-bottom: 3px;
        padding-top: 3px;
        margin-bottom: 0px;
    }
   .el-form-item--mini.el-form-item, .el-form-item--small.el-form-item .wmb {
    margin-bottom: 0px;
    }
    .main .container-fluid .tab {
    padding: 0 10px;
    }
</style>
