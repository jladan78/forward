<template>
    <main class="mainMbrp">

        <template v-if="listado"> 
            <div class="container-fluid tab">
                <!-- Tabla Listado -->   
                <div class="card">
                      
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> MBRP Questionnaire
                        <button type="button" @click="abrirModal('mbrp_questionnaire','register')" class="btn btn-secondary">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listMbrp_questionnaires(1,buscar,criterio)" class="form-control" placeholder="Search ... ">
                                    <button type="submit" @click="listMbrp_questionnaires(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div> 
-->
                        <el-table
                            :data="arrayMbrp_questionnaire"
                            :default-sort = "{prop: 'client_id', order: 'descending'}"
                            style="width: 100%"  class="table table-responsive-sm table-sm">
                            <el-table-column label="Operations"  fixed="right" width="100">
                                <template slot-scope="props">
                                    <!-- <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('mbrp_questionnaire','update',props.row)" > -->
                                    <button type="button" class="btn btn-warning btn-sm"  @click="mostrarDetalle(props.row)">    
                                        <i class="icon-pencil"></i>
                                    </button> 
                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteMbrp_questionnaire(props.row.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                            </el-table-column>
                            <el-table-column type="expand">
                                <template slot-scope="props">
                                    <template v-if="props.row.stage =='Pre-Programme'">
                                        <p>Programme: {{ props.row.mbrp_programme.name }}</p>
                                        <p>Date engaged: {{ props.row.date_engaged |moment("DD-MM-YYYY")}}</p>
                                    </template>
                                    <template v-else>
                                        <p>Programme: {{ props.row.mbrp_programme.name }}</p>
                                        <p>Completed: {{ props.row.is_completed|boolean }}</p>                                            
                                        <p>Date Completed: {{ props.row.date_completed |moment("DD-MM-YYYY")}}</p>
                                        <p>Non completion reason: {{ props.row.end_reason }}</p>
                                    </template>
                                    <p>BRS Score: {{ props.row.brs_score }}</p>
                                </template>
                            </el-table-column>
                            <el-table-column label="Client Ref." prop="client.reference" sortable width="120"></el-table-column>
                            <el-table-column label="Client age"  prop="client_age" sortable width="120"></el-table-column>
                            <el-table-column label="Stage"       prop="stage" sortable >     </el-table-column>
                            <el-table-column label="Programme"   prop="mbrp_programme.name" sortable >     </el-table-column>
                            <el-table-column label="Date engaged" prop="date_engaged"  :formatter="formatter_date">     </el-table-column> 
                        
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
                <!-- Tabla Listado -->
            </div>
        </template>
            <!-- Editar Cuestionario   -->
        <template v-else>    
            <div class="container-fluid">
            <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <i class="fa fa-align-justify"></i> MBRP Questionnaire    
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">
                                    <i class="icon-action-undo"></i>&nbsp;Back to list
                                </button> 
                            </div>
                            <div class="col-md-2">
                                <h5>
                                <span v-show="mbrp_completed" class="badge badge-success">Success</span>
                                <span v-show="!mbrp_completed" class="badge badge-danger">Not Completed</span> 
                                </h5>
                            </div> 
                        </div>
                    </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cliente Ref.</label>
                                <input type="text" v-model="client_ref"  class="form-control form-control-sm" placeholder="Client reference" readonly>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">    
                                <label>Client age</label>
                                <input type="text" v-model="client_age" class="form-control form-control-sm" placeholder="client age">
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stage</label>
                                <select v-model="stage"  @change="cambiarPreQuest(stage)" class="form-control form-control-sm">
                                    <option value="Pre-Programme">Pre-Programme</option>
                                    <option value="Post-Programme">Post-Programme</option>
                                </select> 
                            </div>                                       
                        </div>
                    </div>
                <template v-if="pre_quest">
                        <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Programme</label>
                                <div class="col-md-4">
                                <!-- <input type="text" v-model="programme" class="form-control form-control-sm" placeholder="Programme"> -->
                                    <select v-model="mbrp_programme_id" class="form-control form-control-sm">
                                        <option value="0" disabled>Select...</option>
                                        <option v-for="program in arrayProgram" :key="program.name" :value="program.id" v-text="program.name"></option>
                                    </select>
                                        
                                </div>
                                <label class="col-md-2 form-control-label" for="date-input">Date engaged</label>
                                <div class="col-md-4">
                                    <el-date-picker v-model="date_engaged" placeholder="date engaged" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Programme</label>
                                <div class="col-md-4">
                                <!-- <input type="text" v-model="programme" class="form-control form-control-sm" placeholder="Programme"> -->
                                    <select v-model="mbrp_programme_id" class="form-control form-control-sm">
                                        <option value="0" disabled>Select...</option>
                                        <option v-for="program in arrayProgram" :key="program.name" :value="program.id" v-text="program.name"></option>
                                    </select>
                                        
                                </div>
                                <label class="col-md-2 form-control-label" for="date-input">Date engaged</label>
                                <div class="col-md-4">
                                    <el-date-picker v-model="date_engaged" placeholder="date engaged" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Is Completed </label><br>
                                    &nbsp;&nbsp;&nbsp;
                                    <label class="switch switch-lg switch-label switch-primary ">
                                        <input type="checkbox" v-model="is_completed" class="switch-input " checked>
                                        <span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>
                                    </label> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date Comppleted</label>
                                    <el-date-picker v-model="date_completed" placeholder="date Completed" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Non-completion reason(*)</label>
                                        <select v-model="end_reason" class="form-control form-control-sm">
                                        <option value="0" disabled>Select...</option>
                                        <option v-for="reason in arrayReason" :key="reason.code" :value="reason.code" v-text="reason.description"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </template>  
                <!-- lista decuestionarios-->
                    <div id="accordion" role="tablist">
                        <div class="card" v-if=brs_q>
                            <div class="card-header" role="tab" id="headingOne">
                                <div class="row">
                                    <div class="col-md-6">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        BRS Questionnaire 
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <span v-show="brs_ok" class="badge badge-success">Success</span>
                                        <span v-show="!brs_ok" class="badge badge-danger">Not Completed</span>
                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="mb-0"> BRS Score: {{ brs_score}} </h5>
                                    </div>
                                </div>
                            </div>
                            <div ref="brstest" id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" >
                                <brs_quest
                                    :brsValues="this.brsValues">
                                </brs_quest>                                    
                            </div> 
                            
                        </div>
                        <div class="card"  v-if=urica_q>
                             <div class="card-header" role="tab" id="headingTwo">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                URICA Questionnaire
                                                </a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <span v-show="urica_ok" class="badge badge-success">Success</span>
                                                <span v-show="!urica_ok" class="badge badge-danger">Not Completed</span>
                                            </h5>
                                        </div>
                                         <div class="col-md-1"><h6 class="mb-0 align-middle">PR : {{urica_pr_score}}</h6></div>
                                         <div class="col-md-1"><h6 class="mb-0 align-middle">CON : {{urica_con_score}} </h6></div>
                                         <div class="col-md-1"><h6 class="mb-0 align-middle">AC : {{urica_ac_score}} </h6></div>
                                         <div class="col-md-1"><h6 class="mb-0 align-bottom">MA : {{urica_ma_score}} </h6></div>
                                         <div class="col-md-2"><h5 class="mb-0">Highest: {{ urica_highest}}</h5></div>
                                            
                                    </div>
                                </div>
                            <div ref="UricaTest" id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <urica_quest
                                    :uricaValues="this.uricaValues">
                                </urica_quest>
                            </div>    
                        </div>
                        <div class="card"  v-if=datc_q>
                            <div class="card-header" role="tab" id="headingSix">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Drug / Alcohol Taking Confidence
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span v-show="datc_ok" class="badge badge-success">Success</span>
                                <span v-show="!datc_ok" class="badge badge-danger">Not Completed</span>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    Campos Test Drug / Alcohol Taking Confidence
                                </div>
                            </div>
                        </div>
                        <div class="card"  v-if=spsi_q>
                            <div class="card-header" role="tab" id="headingFour">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapse">
                                SPSI-R:S Questionnaire
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span v-show="spsi_ok" class="badge badge-success">Success</span>
                                <span v-show="!spsi_ok" class="badge badge-danger">Not Completed</span>
                            </h5>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                Campos Test SPSI-R:S Questionnaire
                            </div>
                            </div>
                        </div>
                        <div class="card"  v-if=mh_q>
                            <div class="card-header" role="tab" id="headingFive">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Mental Helth Questionnaire
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span v-show="mh_ok" class="badge badge-success">Success</span>
                                <span v-show="!mh_ok" class="badge badge-danger">Not Completed</span>
                            </h5>
                            </div>
                            <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                Campos Test Mental Helth Questionnaire
                            </div>
                            </div>
                        </div>
                        <div class="card"  v-if=pf_q>
                            <div class="card-header" role="tab" id="headingSix">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Participant Feedback
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span v-show="pf_ok" class="badge badge-success">Success</span>
                                <span v-show="!pf_ok" class="badge badge-danger">Not Completed</span>
                            </h5>
                            </div>
                            <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                Campos Test Participant Feedback
                            </div>
                            </div>
                        </div>                
                    </div>
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
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label " for="text-input">Cliente Ref.</label>
                                    <div class="col-md-6">
                                        <!-- <input type="text" v-model="client_id" class="form-control form-control-sm" placeholder="Client reference"> -->
                                        <v-select
                                            :on-search="selectClient"
                                            label="reference"
                                            :options="arrayClient"
                                            placeholder="Search Clients..."
                                            :onChange="getDataClient"                                        
                                        >
                                            <template slot="option" slot-scope="client">
                                               {{ client.reference }} - {{ client.initials }} - {{ client.dob |moment("DD-MM-YYYY") }}
                                            </template>
                                        </v-select>


                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Client age</label>
                                    <div class="col-md-2">
                                        <input type="text" v-model="client_age" class="form-control form-control-sm" placeholder="client age">
                                    </div>
                                </div>
                                <div class="form-group row sw">
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" >Stage</label>
                                            <select v-model="stage"  @change="cambiarPreQuest(stage)" class="form-control form-control-sm">
                                                <option value="Pre-Programme">Pre-Programme</option>
                                                <option value="Post-Programme">Post-Programme</option>
                                            </select>                                    
                                        </div>
                                     </div>  
                                    <div class="col-md-5">    
                                        <div class="form-group">
                                            <label class="form-control-label" >Programme</label>
                                            <select v-model="mbrp_programme_id"  @change="loadQuest(mbrp_programme_id)" class="form-control form-control-sm">
                                                <option value="0" disabled>Select...</option>
                                                <option v-for="program in arrayProgram" :key="program.name" :value="program.id" v-text="program.name"></option>
                                            </select>
                                        </div>        
                                    </div>
                                    <div class="col-md-4">    
                                        <div class="form-group">    
                                            <label class="form-control-label" >Date engaged</label>
                                            <el-date-picker v-model="date_engaged" placeholder="date engaged" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                        </div>
                                    </div>
                                </div>
                                <div v-show="pre_quest===0" class="form-group row sw">
                                    <div class="col-md-2">
                                        <div class="form-group sw">
                                            <label>Is Completed </label><br>
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="switch switch-lg switch-label switch-primary ">
                                                <input type="checkbox" v-model="is_completed" class="switch-input " checked>
                                                <span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>
                                            </label> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group sw">
                                            <label>Date Comppleted</label>
                                            <el-date-picker v-model="date_completed" placeholder="date Completed" size="small" format="dd/MM/yyyy"  value-format="yyyy-MM-dd"></el-date-picker>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group sw">
                                            <label>Non-completion reason(*)</label>
                                                <select v-model="end_reason" class="form-control form-control-sm">
                                                <option value="0" disabled>Select...</option>
                                                <option v-for="reason in arrayReason" :key="reason.code" :value="reason.code" v-text="reason.description"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <!-- lista de cuestionarios  -->
                            <div class="card ">
                                <div class="card-header sw">
                                    Select the questionnaires
                                </div>
                                <div class="card-body">
                                    <div class="form-group row sw"> 
                                        <div class="col-md-1">
                                        </div>    
                                        <div class="col-md-3">
                                                <div class="form-group sw">
                                                    <label>BRS Questionnaire</label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch switch-sm switch-3d switch-primary ">
                                                        <input type="checkbox"   v-model="brs_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group sw">
                                                    <label>URICA Questionnaire</label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch  switch-sm switch-3d switch-primary">
                                                        <input type="checkbox" v-model="urica_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group sw">
                                                    <label>Drug/Alcohol Taking Confidence </label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch switch-sm switch-3d switch-primary">
                                                        <input type="checkbox"  v-model="datc_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group row sw">
                                        <div class="col-md-1">
                                        </div>    
                                        <div class="col-md-3">    
                                                <div class="form-group sw">
                                                    <label>SPSI-R:S Quest. </label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch switch-sm switch-3d switch-primary">
                                                        <input type="checkbox"  v-model="spsi_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group sw">
                                                    <label>Mental Health Quest. </label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch switch-sm switch-3d switch-primary">
                                                        <input type="checkbox"  v-model="mh_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group sw">
                                                    <label>Participant Feedback </label><br>
                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <label class="switch switch-sm switch-3d switch-primary">
                                                        <input type="checkbox"  v-model="pf_q" class="switch-input form-control form-control-sm" checked>
                                                        <span class="switch-slider"></span>
                                            
                                                    </label> 
                                                </div>
                                        </div>
                                    </div>       
                                </div>
                                </div>
                                <!--FIN lista de cuestionarios  -->
                                <div v-show="errorMbrp_questionnaire" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMbrp_questionnaire" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerMbrp_questionnaire()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateMbrp_questionnaire()">Actualizar</button>
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
    import { Button, Select ,DatePicker,Table,Checkbox} from 'element-ui';
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
            mbrp_cli_id:{type: Number, required:true}
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
            vSelect
            },
        data (){
            return {
                mbrp_questionnaire_id: 0,
                client_id : '',
                client_ref : '',
                client_age : 0,
                stage : '',
                mbrp_programme_id : '',
                date_engaged : '',
                is_completed: 0,
                date_completed:'',
                end_reason:'',
                brs_q : 0,
                urica_q : 0,
                datc_q : 0,
                spsi_q : 0,
                mh_q : 0,
                pf_q : 0,
               // mbrp_completed:false,
                brs_test_id: 0,
                brsValues:[],
                brs_score:0,
                urica_test_id: 0,
                uricaValues:[],
                urica_highest:'',
                urica_pr_score:0,
                urica_con_score:0,
                urica_ac_score:0,
                urica_ma_score:0,
                brs_ok:false,
                urica_ok:false,
                datc_ok:false,
                spsi_ok:false,
                mh_ok:false,
                pf_ok:false,
                mbrp_ok:'',
                arrayMbrp_questionnaire : [],
                arrayClient:[],
                arrayProgram:[],
                arrayReason:[],
                arrayBrsUp:[],
                arrayBrsDown:[],
                pre_quest: 1,
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMbrp_questionnaire : 0,
                errorMostrarMsjMbrp_questionnaire : [],
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
                buscar : this.mbrp_cli_id
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
          mbrp_completed: function(){

               this.comprobarMBRP();
               return  this.mbrp_ok.indexOf("2")==-1;
        
          } 
        },
        methods : {
            listMbrp_questionnaires (page,buscar,criterio){
                let me=this;
                var url= '/mbrp_questionnaire?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMbrp_questionnaire = respuesta.mbrp_questionnaire.data;
                    me.pagination= respuesta.pagination;
                  //  console.log(response);
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
                me.listMbrp_questionnaires(page,buscar,criterio);
            },
            registerMbrp_questionnaire(){
                if (this.validateMbrp_questionnaire()){
                    return;
                }
                
                let me = this;

                axios.post('/mbrp_questionnaire/register',{
                    'client_id': this.client_id,
                    'client_age': this.client_age,
                    'stage': this.stage,
                    'mbrp_programme_id': this.mbrp_programme_id,
                    'date_engaged': this.date_engaged,
                    'is_completed':this.is_completed,
                    'date_completed':this.date_completed,
                    'end_reason':this.end_reason,
                    'brs_q':this.brs_q,
                    'urica_q':this.urica_q,
                    'datc_q':this.datc_q,
                    'spsi_q':this.spsi_q,
                    'mh_q':this.mh_q,
                    'pf_q':this.pf_q
                }).then(function (response) {
                    me.cerrarModal();
                    // console.log(response);
                    me.mostrarDetalle(response.data);
                   // me.listMbrp_questionnaires(1,'','client_id');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateMbrp_questionnaire(){
               if (this.validateMbrp_questionnaire()){
                    return;
                }
                let me = this;

                axios.put('/mbrp_questionnaire/update',{
                    'client_id': this.client_id,
                    'client_age': this.client_age,
                    'stage': this.stage,
                    'mbrp_programme_id': this.mbrp_programme_id,
                    'date_engaged': this.date_engaged,
                    'is_completed':this.is_completed,
                    'date_completed':this.date_completed,
                    'end_reason':this.end_reason,
                    'brs_q':this.brs_q,
                    'urica_q':this.urica_q,
                    'datc_q':this.datc_q,
                    'spsi_q':this.spsi_q,
                    'mh_q':this.mh_q,
                    'pf_q':this.pf_q,
                    'id': this.mbrp_questionnaire_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listMbrp_questionnaires(1,me.buscar,'client_id');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },

            deleteMbrp_questionnaire(idborrar){
                
               swal({
                title: 'Are you sure you want to delete this questionnaire??',
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
// axios.delete('/mbrp_questionnaire/'+idborrar).then(function (response) {
//   axios.put('/mbrp_questionnaire/delete', {params: {'id': this.id}}).then(function (response) {

                    axios.delete('/mbrp_questionnaire/'+idborrar).then(function (response) {
                        me.listMbrp_questionnaires(1,me.buscar,'client_id');
                        swal(
                        'Deleted!',
                        'The questionnaire has been successfully eliminated.',
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
            
            validateMbrp_questionnaire(){
                this.errorMbrp_questionnaire=0;
                this.errorMostrarMsjMbrp_questionnaire =[];

                if (!this.client_id) this.errorMostrarMsjMbrp_questionnaire.push("Error: The client code is empty");

                if (this.errorMostrarMsjMbrp_questionnaire.length) this.errorMbrp_questionnaire = 1;

                return this.errorMbrp_questionnaire;
            },
            mostrarDetalle(data = []){
              
                this.listado=0;
                this.mbrp_questionnaire_id=data['id'];
                this.client_id= data['client_id'];
                
                if (typeof data['client'] !== "undefined") {
                    this.client_ref=data['client']['reference']; 
                }
                
               // this.client_ref=this.arrayClient[0]['reference'];
               this.client_age = data['client_age'];
                this.stage = data['stage'];
                this.mbrp_programme_id = data['mbrp_programme_id'];
                this.date_engaged = data['date_engaged'];
                this.is_completed = data['is_completed'];
                this.date_completed = data['date_completed'];
                this.end_reason = data['end_reason'];
                this.brs_q=data['brs_q'];
                this.urica_q=data['urica_q'];
                this.datc_q=data['datc_q'];
                this.spsi_q=data['spsi_q'];
                this.mh_q=data['mh_q'];
                this.pf_q=data['pf_q']; 
                this.brs_test_id=data['brs_test_id'];
                if (typeof data['brs_test'] !== "undefined") {
                    this.brsValues[0]=data['brs_test']['brs1'];
                    this.brsValues[1]=data['brs_test']['brs2'];
                    this.brsValues[2]=data['brs_test']['brs3'];
                    this.brsValues[3]=data['brs_test']['brs4'];
                    this.brsValues[4]=data['brs_test']['brs5'];
                    this.brsValues[5]=data['brs_test']['brs6'];
                    this.brs_score=data['brs_test']['brs_score'];
                }else{
                    this.brsValues[0]=0;
                    this.brsValues[1]=0;
                    this.brsValues[2]=0;
                    this.brsValues[3]=0;
                    this.brsValues[4]=0;
                    this.brsValues[5]=0;
                    this.brs_score=0;
                }
                this.urica_test_id=data['urica_test_id'];
                if (typeof data['urica_test'] !== "undefined") {
                    this.uricaValues[0]=data['urica_test']['urica1'];
                    this.uricaValues[1]=data['urica_test']['urica2'];
                    this.uricaValues[2]=data['urica_test']['urica3'];
                    this.uricaValues[3]=data['urica_test']['urica4'];
                    this.uricaValues[4]=data['urica_test']['urica5'];
                    this.uricaValues[5]=data['urica_test']['urica6'];
                    this.uricaValues[6]=data['urica_test']['urica7'];
                    this.uricaValues[7]=data['urica_test']['urica8'];
                    this.uricaValues[8]=data['urica_test']['urica9'];
                    this.uricaValues[9]=data['urica_test']['urica10'];
                    this.uricaValues[10]=data['urica_test']['urica11'];
                    this.uricaValues[11]=data['urica_test']['urica12'];
                    this.uricaValues[12]=data['urica_test']['urica13'];
                    this.uricaValues[13]=data['urica_test']['urica14'];
                    this.uricaValues[14]=data['urica_test']['urica15'];
                    this.uricaValues[15]=data['urica_test']['urica16'];
                    this.uricaValues[16]=data['urica_test']['urica17'];
                    this.uricaValues[17]=data['urica_test']['urica18'];
                    this.uricaValues[18]=data['urica_test']['urica19'];
                    this.uricaValues[19]=data['urica_test']['urica20'];
                    this.uricaValues[20]=data['urica_test']['urica21'];
                    this.uricaValues[21]=data['urica_test']['urica22'];
                    this.uricaValues[22]=data['urica_test']['urica23'];
                    this.uricaValues[23]=data['urica_test']['urica24'];
                    this.uricaValues[24]=data['urica_test']['urica25'];
                    this.uricaValues[25]=data['urica_test']['urica26'];
                    this.uricaValues[26]=data['urica_test']['urica27'];
                    this.uricaValues[27]=data['urica_test']['urica28'];
                    this.uricaValues[28]=data['urica_test']['urica29'];
                    this.uricaValues[29]=data['urica_test']['urica30'];
                    this.uricaValues[30]=data['urica_test']['urica31'];
                    this.uricaValues[31]=data['urica_test']['urica32'];
                    
                    this.urica_highest=data['urica_test']['urica_highest'];
                    this.urica_pr_score=data['urica_test']['pr_score'];
                    this.urica_con_score=data['urica_test']['con_score'];
                    this.urica_ac_score=data['urica_test']['ac_score'];
                    this.urica_ma_score=data['urica_test']['ma_score'];
                }else{
                    this.uricaValues[0]=0;
                    this.uricaValues[1]=0;
                    this.uricaValues[2]=0;
                    this.uricaValues[3]=0;
                    this.uricaValues[4]=0;
                    this.uricaValues[5]=0;
                    this.uricaValues[6]=0;
                    this.uricaValues[7]=0;
                    this.uricaValues[8]=0;
                    this.uricaValues[9]=0;
                    this.uricaValues[10]=0;
                    this.uricaValues[11]=0;
                    this.uricaValues[12]=0;
                    this.uricaValues[13]=0;
                    this.uricaValues[14]=0;
                    this.uricaValues[15]=0;
                    this.uricaValues[16]=0;
                    this.uricaValues[17]=0;
                    this.uricaValues[18]=0;
                    this.uricaValues[19]=0;
                    this.uricaValues[20]=0;
                    this.uricaValues[21]=0;
                    this.uricaValues[22]=0;
                    this.uricaValues[23]=0;
                    this.uricaValues[24]=0;
                    this.uricaValues[25]=0;
                    this.uricaValues[26]=0;
                    this.uricaValues[27]=0;
                    this.uricaValues[28]=0;
                    this.uricaValues[29]=0;
                    this.uricaValues[30]=0;
                    this.uricaValues[31]=0;
                    this.urica_highest='';
                    this.urica_pr_score=0;
                    this.urica_con_score=0;
                    this.urica_ac_score=0;
                    this.urica_ma_score=0;
                }
                this.cambiarPreQuest(data['stage']);
                this.selectProgram();
                this.selectReason();
                this.selectBrsUp();
                this.selectBrsDown();
                //this.comprobarMBRP();
            },
            ocultarDetalle(){
                this.listado=1;
                this.mbrp_ok='';
                this.client_id= '';
                this.client_ref= '';
                this.client_age = '';
                this.stage = '';
                this.mbrp_programme_id = '';
                this.date_engaged = '';
                this.is_completed = 0;
                this.date_completed ='';
                this.end_reason='';
                this.brs_q=0;
                this.brs_ok=false;
                this.urica_q=0;
                this.urica_ok=false;
                this.datc_q=0;
                this.datc_ok=false;
                this.spsi_q=0;
                this.spsi_ok=false;
                this.mh_q=0;
                this.mh_ok=false;
                this.pf_q=0;
                this.pf_ok=false;
                this.brs_test_id=0;
                this.brsValues=[];
                this.brs_score=0;
                this.urica_test_id=0;
                this.uricaValues=[];
                this.urica_highest='';
                this.urica_pr_score=0;
                this.urica_con_score=0;
                this.urica_ac_score=0;
                this.urica_ma_score=0;
                this.listMbrp_questionnaires(1,this.buscar,'client_id');
            },

            comprobarMBRP(){
                this.mbrp_ok='';

               if (this.brs_q==0){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.brs_q==1) && (this.brs_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    } 
               if (this.urica_q==0){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.urica_q==1) && (this.urica_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    } 
                if (!this.datc_q){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.datc_q) && (this.datc_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    } 
                if (!this.spsi_q){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.spsi_q) && (this.datc_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    } 
                if (!this.mh_q){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.mh_q) && (this.mh_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    } 
                if (!this.pf_q){
                        this.mbrp_ok=this.mbrp_ok+'0'; 
                    }else if((this.pf_q) && (this.pf_ok)){
                        this.mbrp_ok=this.mbrp_ok+'1'
                    } else{
                        this.mbrp_ok=this.mbrp_ok+'2'
                    }         
/*                 var pos = this.mbrp_ok.indexOf("2");
            
                if (pos==-1){
                   this.mbrp_completed=true;
                } else{
                   this.mbrp_completed=false;
                } */
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
                me.client_age= me.calculateAge(val1.dob);
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
            selectProgram(){
                let me=this;
             /*    var url= '/mbrp_parameter/selectParameter?field=programme'
                 axios.get(url). */
                
                axios.get('/mbrp_programme/selectProgrammes').then(function (response) {
               // console.log(response);
                    var respuesta= response.data;
                    me.arrayProgram = respuesta.programmes;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectReason(){
                let me=this;
        
                axios.get('/mbrp_parameter/selectParameter', {
                    params: {
                    field: 'end_reason'
                    }
                }).then(function (response) {
                // console.log(response);
                    var respuesta= response.data;
                    me.arrayReason = respuesta.parameters;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectBrsUp(){
                let me=this;
        
                axios.get('/mbrp_parameter/selectParameter', {
                    params: {
                    field: 'brs_up'
                    }
                }).then(function (response) {
                //console.log(response);
                    var respuesta= response.data;
                    me.arrayBrsUp = respuesta.parameters;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectBrsDown(){
                let me=this;
        
                axios.get('/mbrp_parameter/selectParameter', {
                    params: {
                    field: 'brs_down'
                    }
                }).then(function (response) {
                //console.log(response);
                    var respuesta= response.data;
                    me.arrayBrsDown = respuesta.parameters;
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
            cambiarPreQuest(stage){
                switch(stage){
                    case 'Pre-Programme':
                    {
                        this.pre_quest=1                        
                        break;
                    }
                    case 'Post-Programme':
                    {
                        this.pre_quest=0                        
                        break;
                    }
                }

            },
            loadQuest(mbrp_programme_id){

                for(var i=0;i<this.arrayProgram.length;i++){
                    if(this.arrayProgram[i].id==mbrp_programme_id){
                        //console.log(this.arrayProgram[i]);
                        this.brs_q=this.arrayProgram[i].brs_q;
                        this.urica_q=this.arrayProgram[i].urica_q;
                        this.datc_q=this.arrayProgram[i].datc_q;
                        this.spsi_q=this.arrayProgram[i].spsi_q;
                        this.mh_q=this.arrayProgram[i].mh_q;
                        this.pf_q=this.arrayProgram[i].pf_q;
                    }
                }

            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.client_id= '';
                this.client_age = '';
                this.stage = '';
                this.mbrp_programme_id = '';
                this.date_engaged = '';
                this.is_completed = 0;
                this.date_completed ='';
                this.end_reason='';
                this.brs_q=0;
                this.urica_q=0;
                this.datc_q=0;
                this.spsi_q=0;
                this.mh_q=0;
                this.pf_q=0;
            },
            abrirModal(modelo, accion, data = []){
                 this.selectProgram();
                 this.selectReason();
                switch(modelo){
                    case "mbrp_questionnaire":
                    {
                        switch(accion){
                            case 'register':
                            {
                                this.modal = 1;
                                this.tituloModal = 'register Questionnaire';
                                this.tipoAccion = 1;
                                this.pre_quest = 1;
                                this.client_id= '';
                                this.client_age = '';
                                this.stage = '';
                                this.mbrp_programme_id = '';
                                this.date_engaged = '';
                                this.is_completed = 0;
                                this.date_completed ='';
                                this.end_reason='';
                                this.brs_q=0;
                                this.urica_q=0;
                                this.datc_q=0;
                                this.spsi_q=0;
                                this.mh_q=0;
                                this.pf_q=0;
                                break;

                            }
                            case 'update':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='update Questionnaire';
                                this.tipoAccion=2;
                                this.mbrp_questionnaire_id=data['id'];
                                this.client_id= data['client_id'];
                                this.client_age = data['client_age'];
                                this.stage = data['stage'];
                                this.mbrp_programme_id = data['mbrp_programme_id'];
                                this.date_engaged = data['date_engaged'];
                                this.is_completed = data['is_completed'];
                                this.date_completed = data['date_completed'];
                                this.end_reason = data['end_reason'];
                                this.brs_q=data['brs_q'];
                                this.urica_q=data['urica_q'];
                                this.datc_q=data['datc_q'];
                                this.spsi_q=data['spsi_q'];
                                this.mh_q=data['mh_q'];
                                this.pf_q=data['pf_q'];
                                this.cambiarPreQuest(data['stage']);

                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listMbrp_questionnaires(1,this.buscar,this.criterio);
            
             
            
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
        /* height: 470px; */
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
