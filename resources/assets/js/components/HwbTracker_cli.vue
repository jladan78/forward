<template>
    <main class="mainHwb">

        <template v-if="listado"> 
            <div class="container-fluid tab">
                <!-- Tabla Listado -->   
                <div class="card">
                      
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Health & Well-Being Tracker
                        <button type="button" @click="mostrarDetalle('register')"  class="btn btn-secondary">
                             <!-- @click="abrirModal('hwbTracker','register')" -->
                            <i class="icon-plus"></i>&nbsp;New...
                        </button>
                    </div> 

                    <div class="card-body">
<!--                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                    <option value="client_id">Client Ref.</option>
                                    <option value="mbrp_programmes.name">Programme</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listHwbTracker(1,buscar,criterio)" class="form-control" placeholder="Search ... ">
                                    <button type="submit" @click="listHwbTracker(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div> 
-->
                        <!-- <div class="card-deck">  -->
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Health & well-Being tracker
                                    </div>
                                    <div class="card-body">                               
                                        <el-table
                                            ref="hwbtrackersTable"
                                            :data="arrayHwbTracker"
                                            :default-sort = "{prop: 'client_id', order: 'descending'}"
                                            style="width: 100%"  class="table table-responsive-sm table-sm"
                                            @selection-change="seleccionDatos">
                                            <el-table-column label="Ops."  fixed="right" width="90">
                                                <template slot-scope="props">
                                                    <!-- <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('hwbTracker','update',props.row)" > -->
                                                    <button type="button" class="btn btn-warning btn-sm"  @click="mostrarDetalle('update',props.row)">    
                                                        <i class="icon-pencil"></i>
                                                    </button> 
                                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteHwbTracker(props.row.id)">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </template>
                                            </el-table-column>
                                            <el-table-column   type="selection" width="40">
                                            </el-table-column>
                                            <el-table-column type="expand" width="35">
                                                <template slot-scope="props">

                                                    <p>Social Network notes: {{ props.row.sn_notes }}</p>
                                                </template>
                                            </el-table-column>
                                            <!-- <el-table-column label="Client Ref." prop="client.reference" sortable ></el-table-column> -->
                                            <el-table-column label="Date" prop="date_track"  :formatter="formatter_date" width="95" sortable>     </el-table-column> 
                                            <el-table-column label="Description"       prop="description" width="190" show-overflow-tooltip>     </el-table-column>
    <!--                                    
                                            <el-table-column label="S.N."   prop="sn_value" sortable >     </el-table-column>
                                            <el-table-column label="PCLS."   prop="pcls_value" sortable >     </el-table-column>
                                            <el-table-column label="EMP"   prop="emp_value" sortable >     </el-table-column>
                                            <el-table-column label="NPS"   prop="nps_value" sortable >     </el-table-column>
                                            <el-table-column label="IPS."   prop="ips_value" sortable >     </el-table-column>
                                            <el-table-column label="SMK."   prop="smk_value" sortable >     </el-table-column>
                                            <el-table-column label="SH."   prop="sh_value" sortable >     </el-table-column>
                                            <el-table-column label="PH."   prop="ph_value" sortable >     </el-table-column>
                                            <el-table-column label="MH."   prop="mh_value" sortable >     </el-table-column>
                                            <el-table-column label="DAU."   prop="dau_value" sortable >     </el-table-column>
    -->
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
                            </div>
     
                            <div class="col-sm-12 col-md-6">    
                                <div class="card"> 
                                    <div class="card-header">
	                                     Health & well-Being Star
                                    </div>
                                    <div class="card-body">
                                        <radar-example
                                            :chart-data="datacollection">
                                        </radar-example>
                                        
                                    </div> 
                                </div> 
                            </div>
                        </div>
                     </div> 
                </div>
            
            </div>
        </template>
            <!-- Editar Cuestionario   -->
        <template v-else>    
            <div class="container-fluid tab">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <i class="fa fa-align-justify"></i> H&WB Tracker    
                            <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">
                                <i class="icon-action-undo"></i>&nbsp;Back to list
                            </button> 
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-secondary" @click="ocultarDetalle()">Cancel</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerHwbTracker()">Save</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateHwbTracker()">Update</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Cliente Ref.</label>
                                <input type="text" v-model="client_ref"  class="form-control form-control-sm" placeholder="Client reference" readonly>
                            </div>
                        </div> 

                           
                        <div class="col-md-10">
                            <div class="form-group">    
                                <label>Description</label>
                                <input type="text" v-model="description" class="form-control form-control-sm" placeholder="Description">
                            </div>    
                        </div>
                    </div>
                     <div class="form-group row">   
                        <label class="col-md-2 form-control-label" for="date-input">Date tracker</label>
                        <div class="col-md-4">
                            <el-date-picker v-model="date_track" placeholder="date tracker" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                        </div>
                     </div>
                     <!-- inicio preguntas  -->
                     <div>
                        <div class="form-group row"> 
                            <label class="col-md-6 form-control-label"><b>Social networks </b></label>
                        </div>
                        
                        <div class="form-group row">   
                            <div class="col-md-2"> 
                                 <el-input-number v-model="sn_value"  size="small" :min="0" :max="10" ></el-input-number>
                                 <!-- <el-input-number v-model="sn_value"  size="mini" ></el-input-number> -->
                            </div>
                            <div class="col-md-4"> 
                                <el-input
                                    type="textarea" :autosize="{ minRows: 1, maxRows: 4}"  placeholder="Add note...."  v-model="sn_notes">
                                </el-input>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Personal care and life skills </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <!-- <el-input-number v-model="pcls_value"  size="small" :min="vbottom" :max="vtop"></el-input-number> -->
                                   <el-input-number v-model="pcls_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...." v-model="pcls_notes">
                                    </el-input>
                                </div>
                            </div>

                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Empowement </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="emp_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="emp_notes">
                                    </el-input>
                                </div>
                            </div>
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>NPS (New Psychoactive Substances or Legal Highs) </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="nps_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="nps_notes">
                                    </el-input>
                                </div>
                            </div>
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Impulsivity and problem solving </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="ips_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="ips_notes">
                                    </el-input>
                                </div>
                            </div>    
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Smoking </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="smk_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="smk_notes">
                                    </el-input>
                                </div>
                            </div> 
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Safe Housing </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="sh_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="sh_notes">
                                    </el-input>
                                </div>
                            </div>
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Physical health </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="ph_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="ph_notes">
                                    </el-input>
                                </div>
                            </div>
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Mental health </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="mh_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="mh_notes">
                                    </el-input>
                                </div>
                            </div>
                        <div class="form-group row"> 
                            <label class="col-md-12 form-control-label"><b>Drug and alcohol use </b></label>
                        </div>
                        
                            <div class="form-group row">   
                                <div class="col-md-2"> 
                                    <el-input-number v-model="dau_value"  size="small" :min="0" :max="10"></el-input-number>
                                </div>
                                <div class="col-md-10"> 
                                    <el-input
                                        type="textarea" :autosize="{ minRows: 1, maxRows: 4}" placeholder="Add note...."  v-model="dau_notes">
                                    </el-input>
                                </div>
                            </div>
                     <!-- fin preguntas-->   
                     </div>

                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" @click="ocultarDetalle()">Cancel</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerHwbTracker()">Save</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateHwbTracker()">Update</button>
                </div>
            </div> 
        </div>                   
            <!-- FIN cuestionarios  -->
        </template>

    <!--Inicio del modal agregar/actualizar-->
    
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" >
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                
                                <!--FIN lista de cuestionarios  -->
                                <div v-show="errorHwbTracker" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjHwbTracker" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerHwbTracker()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateHwbTracker()">Actualizar</button>
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
    import 'element-ui/lib/theme-chalk/index.css';
    import { Button, Select ,DatePicker,Table,Checkbox,InputNumber,Input} from 'element-ui';
    import lang from 'element-ui/lib/locale/lang/en';
    import locale from 'element-ui/lib/locale';
    import moment from 'moment';
    import vSelect from 'vue-select';
 

    const booleanFilter = function(value, trueText, falseText) {
    return value ? trueText || 'Yes' : falseText || 'No';
    }

    locale.use(lang)
     export default {
           props:{
            hwb_cli_id:{type: Number, required:true},
            hwb_cli_ref:{type: String, required:true}
            },
            filters: {
                boolean: booleanFilter
             }, 
           components:{
            'el-button': Button,
            'el-select': Select,
            'el-DatePicker': DatePicker,
            'el-table': Table,
            'el-checkbox': Checkbox,
            'el-input-number': InputNumber,
            'el-input':Input,
            vSelect
            },
        data (){
            return {
                hwbTracker_id: 0,
                client_id : '',
                client_ref : '',
                date_track : '',
                sn_value:0,
                pcls_value:0,
                emp_value:0,
                nps_value:0,
                ips_value:0,
                smk_value:0,
                sh_value:0,
                ph_value:0,
                mh_value:0,
                dau_value:0,
                sn_notes:'',
                pcls_notes:'',
                emp_notes:'',
                nps_notes:'',
                ips_notes:'',
                smk_notes:'',
                sh_notes:'',
                ph_notes:'',
                mh_notes:'',
                dau_notes:'',
            datacollection: null,    
            datahwb:null,
            serieHwb:[],
                arrayHwbTracker : [],
                arrayClient:[],
                arrayHwb_values:[],
                multipleSelection:[],
                vtop:0,
                vbottom:0,
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorHwbTracker : 0,
                errorMostrarMsjHwbTracker : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'client_id',
                buscar : this.hwb_cli_id
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

            },
        //    mbrp_completed: function(){
               
        //    } 
        },
        methods : {
            listHwbTracker (page,buscar,criterio){
                let me=this;
                var url= '/hwbTracker?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    // console.log(response);
                    me.arrayHwbTracker = respuesta.hwb_tracker.data;
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
                me.listHwbTracker(page,buscar,criterio);
            },
            registerHwbTracker(){
                if (this.validateHwbTracker()){
                    return;
                }
                
                let me = this;

                axios.post('/hwbTracker/register',{
                    'client_id': this.client_id,
                    'description': this.description,
                    'date_track': this.date_track,
                    'sn_value':this.sn_value,
                    'pcls_value':this.pcls_value,
                    'emp_value':this.emp_value,
                    'nps_value':this.nps_value,
                    'ips_value':this.ips_value,
                    'smk_value':this.smk_value,
                    'sh_value':this.sh_value,
                    'ph_value':this.ph_value,
                    'mh_value':this.mh_value,
                    'dau_value':this.dau_value,
                    'sn_notes':this.sn_notes,
                    'pcls_notes':this.pcls_notes,
                    'emp_notes':this.emp_notes,
                    'nps_notes':this.nps_notes,
                    'ips_notes':this.ips_notes,
                    'smk_notes':this.smk_notes,
                    'sh_notes':this.sh_notes,
                    'ph_notes':this.ph_notes,
                    'mh_notes':this.mh_notes,
                    'dau_notes':this.dau_notes
                }).then(function (response) {
                    me.ocultarDetalle();
                    me.listHwbTracker(1,me.buscar,'client_id');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateHwbTracker(){
               if (this.validateHwbTracker()){
                    return;
                }
                let me = this;

                axios.put('/hwbTracker/update',{
                    'client_id': this.client_id,
                    'description': this.description,
                    'date_track': this.date_track,
                    'sn_value':this.sn_value,
                    'pcls_value':this.pcls_value,
                    'emp_value':this.emp_value,
                    'nps_value':this.nps_value,
                    'ips_value':this.ips_value,
                    'smk_value':this.smk_value,
                    'sh_value':this.sh_value,
                    'ph_value':this.ph_value,
                    'mh_value':this.mh_value,
                    'dau_value':this.dau_value,
                    'sn_notes':this.sn_notes,
                    'pcls_notes':this.pcls_notes,
                    'emp_notes':this.emp_notes,
                    'nps_notes':this.nps_notes,
                    'ips_notes':this.ips_notes,
                    'smk_notes':this.smk_notes,
                    'sh_notes':this.sh_notes,
                    'ph_notes':this.ph_notes,
                    'mh_notes':this.mh_notes,
                    'dau_notes':this.dau_notes,
                    'id': this.hwbTracker_id
                }).then(function (response) {
                    me.ocultarDetalle();
                    me.listHwbTracker(1,me.buscar,'client_id');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },

            deleteHwbTracker(idborrar){
                
               swal({
                title: 'Are you sure you want to delete this tracker??',
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
// axios.delete('/hwbTracker/'+idborrar).then(function (response) {
//   axios.put('/hwbTracker/delete', {params: {'id': this.id}}).then(function (response) {

                    axios.delete('/hwbTracker/'+idborrar).then(function (response) {
                        me.listHwbTracker(1,me.buscar,'client_id');
                        swal(
                        'Deleted!',
                        'The Tracker has been successfully eliminated.',
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
            
            validateHwbTracker(){
                this.errorHwbTracker=0;
                this.errorMostrarMsjHwbTracker =[];

                if (!this.client_id) this.errorMostrarMsjHwbTracker.push("Error: The client code is empty");

                if (this.errorMostrarMsjHwbTracker.length) this.errorMbrp_questionnaire = 1;

                return this.errorHwbTracker;
            },
            mostrarDetalle(accion, data = []){
                switch(accion){
                    case 'register':
                    {
                        this.listado=0;
                        this.tipoAccion = 1;
                        this.client_id= this.hwb_cli_id;
                        this.client_ref=this.hwb_cli_ref;
                        this.description = '';
                        this.date_track='';
                        this.sn_value =0 
                        this.pcls_value = 0;
                        this.emp_value = 0;
                        this.nps_value = 0;
                        this.ips_value = 0;
                        this.smk_value = 0;
                        this.sh_value = 0; 
                        this.ph_value = 0;
                        this.mh_value = 0;
                        this.dau_value = 0;
                        this.sn_notes = '';
                        this.pcls_notes = '';
                        this.emp_notes = '';
                        this.nps_notes = '';
                        this.ips_notes = '';
                        this.smk_notes = '';
                        this.sh_notes = '';
                        this.ph_notes = '';
                        this.mh_notes = '';
                        this.dau_notes = '';
                        this.selectTrackerValue();
                        break;

                    }
                    case 'update':
                    {
                       
                        this.listado=0;
                        this.tipoAccion=2;
                        this.hwbTracker_id=data['id'];
                        this.client_id= data['client_id'];
                        
                        if (typeof data['client'] !== "undefined") {
                            this.client_ref=data['client']['reference']; 
                        }

                        this.description = data['description'];
                        this.date_track= data['date_track']
                        this.sn_value = data['sn_value'];
                        this.pcls_value = data['pcls_value'];
                        this.emp_value = data['emp_value'];
                        this.nps_value = data['nps_value'];
                        this.ips_value = data['ips_value'];
                        this.smk_value = data['smk_value'];
                        this.sh_value = data['sh_value'];
                        this.ph_value = data['ph_value'];
                        this.mh_value = data['mh_value'];
                        this.dau_value = data['dau_value'];
                        this.sn_notes = data['sn_notes'];
                        this.pcls_notes = data['pcls_notes'];
                        this.emp_notes = data['emp_notes'];
                        this.nps_notes = data['nps_notes'];
                        this.ips_notes = data['ips_notes'];
                        this.smk_notes = data['smk_notes'];
                        this.sh_notes = data['sh_notes'];
                        this.ph_notes = data['ph_notes'];
                        this.mh_notes = data['mh_notes'];
                        this.dau_notes = data['dau_notes'];
                        this.selectTrackerValue();
                        break;
                    }
                }

            },
            ocultarDetalle(){
                this.listado=1;
                this.client_id= '';
                this.client_ref= '';
                this.description = '';
                this.sn_value =0 
                this.pcls_value = 0;
                this.emp_value = 0;
                this.nps_value = 0;
                this.ips_value = 0;
                this.smk_value = 0;
                this.sh_value = 0; 
                this.ph_value = 0;
                this.mh_value = 0;
                this.dau_value = 0;
                this.sn_notes = '';
                this.pcls_notes = '';
                this.emp_notes = '';
                this.nps_notes = '';
                this.ips_notes = '';
                this.smk_notes = '';
                this.sh_notes = '';
                this.ph_notes = '';
                this.mh_notes = '';
                this.dau_notes = '';
    
                this.listHwbTracker(1,this.buscar,'client_id');
            },

            selectClient(search,loading){
                let me=this;
                loading(true)

                var url= '/client/selectClient?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayClient=respuesta.clients;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDataClient(val1){
                let me = this;
                me.loading = true;
                me.client_id = val1.id;
                me.client_ref= val1.reference;
            },

            seleccionDatos(val) {
                this.multipleSelection = val;
/* 
                this.multipleSelection.forEach(function(index){
                    data[index]
                }); */
                this.datahwb=[];
                var tempdata={
                        etiqueta:'',
                        datos:[]       
                        };

                    for (var index in this.multipleSelection){
                        
                       tempdata.etiqueta=moment( this.multipleSelection[index].date_track).format('DD/MM/YYYY');
                       tempdata.datos.push(this.multipleSelection[index].sn_value);
                       tempdata.datos.push(this.multipleSelection[index].pcls_value);
                       tempdata.datos.push(this.multipleSelection[index].emp_value);
                       tempdata.datos.push(this.multipleSelection[index].nps_value);
                       tempdata.datos.push(this.multipleSelection[index].ips_value);
                       tempdata.datos.push(this.multipleSelection[index].smk_value);
                       tempdata.datos.push(this.multipleSelection[index].sh_value);
                       tempdata.datos.push(this.multipleSelection[index].ph_value);
                       tempdata.datos.push(this.multipleSelection[index].mh_value);
                       tempdata.datos.push(this.multipleSelection[index].dau_value);
                        this.datahwb.push(tempdata)
                        tempdata={etiqueta:'', datos:[] };
                        }

                var colores=['rgba(179,181,198,0.2)','rgba(255, 99, 71, 0.2)','rgba(51, 102, 255, 0.2)','rgba(255, 153, 51,0.2)']
                var borde=['rgba(179,181,198,1)','rgba(255, 99, 71, 1)','rgba(51, 102, 255, 1)','rgba(255, 153, 51,1)']
                this.serieHwb=[];
                for (var x in this.datahwb){
                     var  tempserieHwb={
                                label: this.datahwb[x].etiqueta,
                                lineTension: 0.1,
                                backgroundColor: colores[x],
                                borderColor: borde[x],
                                pointBackgroundColor: borde[x],
                                pointBorderColor: '#fff',
                                pointRadius: 4,
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: borde[x],
                                data: this.datahwb[x].datos
                                };
                        this.serieHwb.push(tempserieHwb);
                    
                }



                this.cargaDatos();
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
            selectTrackerValue(){
                let me=this;
        
                axios.get('/mbrp_parameter/selectParameter', {
                    params: {
                    field: 'hwb_value'
                    }
                }).then(function (response) {
                //console.log(response);
                    var respuesta= response.data;
                    me.arrayHwb_values = respuesta.parameters;
                   /*   console.log(response);
                    console.log( me.arrayHwb_values[0].top_value);
                    */
                    me.vtop=me.arrayHwb_values[0].top_value;
                    me.vbottom=me.arrayHwb_values[0].bottom_value; 
                })
                .catch(function (error) {
                    console.log(error);
                });
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
        
            cargaDatos(){

                this.datacollection= {
                    labels: [['Social','Networks'], 'Personal Care', 'Empowerment', 'NPS', 'Impulsivity', 'Smoking', 'Safe Housing','Physical Health','Mental Health','Drug & Alcohol use' ],
                    datasets:this.serieHwb,
                };

            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.client_id= '';
                this.client_ref='';
                this.description = '';
               
            },
            abrirModal(modelo, accion, data = []){

                switch(modelo){
                    case "hwbTracker":
                    {
                        switch(accion){
                            case 'register':
                            {
                                this.modal = 1;
                                this.tituloModal = 'register Health & Well-Being Tracker';
                                this.tipoAccion = 1;
                                this.client_id= '';
                                this.client_ref= '';
                                this.description = '';
                                this.sn_value =0 
                                this.pcls_value = 0;
                                this.emp_value = 0;
                                this.nps_value = 0;
                                this.ips_value = 0;
                                this.smk_value = 0;
                                this.sh_value = 0; 
                                this.ph_value = 0;
                                this.mh_value = 0;
                                this.dau_value = 0;
                                this.sn_notes = '';
                                this.pcls_notes = '';
                                this.emp_notes = '';
                                this.nps_notes = '';
                                this.ips_notes = '';
                                this.smk_notes = '';
                                this.sh_notes = '';
                                this.ph_notes = '';
                                this.mh_notes = '';
                                this.dau_notes = '';
                               
                                break;

                            }
                            case 'update':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='update Questionnaire';
                                this.tipoAccion=2;
                                this.hwbTracker_id=data['id'];
                                this.client_id= data['client_id'];
                                this.description = data['description'];
                                this.sn_value = data['sn_value'];
                                this.pcls_value = data['pcls_value'];
                                this.emp_value = data['emp_value'];
                                this.nps_value = data['nps_value'];
                                this.ips_value = data['ips_value'];
                                this.smk_value = data['smk_value'];
                                this.sh_value = data['sh_value'];
                                this.ph_value = data['ph_value'];
                                this.mh_value = data['mh_value'];
                                this.dau_value = data['dau_value'];
                                this.sn_notes = data['sn_notes'];
                                this.pcls_notes = data['pcls_notes'];
                                this.emp_notes = data['emp_notes'];
                                this.nps_notes = data['nps_notes'];
                                this.ips_notes = data['ips_notes'];
                                this.smk_notes = data['smk_notes'];
                                this.sh_notes = data['sh_notes'];
                                this.ph_notes = data['ph_notes'];
                                this.mh_notes = data['mh_notes'];
                                this.dau_notes = data['dau_notes'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listHwbTracker(1,this.buscar,this.criterio);
            this.cargaDatos();
            
             
            
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
   
    .modal-body{
        /* height: 470px;*/ 
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
    .el-table td, .el-table th {
        padding: 5px 0;
    }
    .sw {
        padding-bottom: 3px;
        padding-top: 3px;
        margin-bottom: 0px;
    }
</style>
