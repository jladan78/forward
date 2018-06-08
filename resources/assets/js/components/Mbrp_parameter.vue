<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboards</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Parameters
                        <button type="button" @click="abrirModal('parameter','register')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="name">Name</option>
                                      <option value="descripcion">description</option>
                                      <option value="field">field</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarParameter(1,buscar,criterio)" class="form-control" placeholder="Text to search">
                                    <button type="submit" @click="listarParameter(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> search...</button>
                                </div>
                            </div>
                        </div>
                <!-- table-responsive-sm  -->
                        <el-table
                                :data="arrayParameter"
                                :default-sort = "{prop: 'cliente_ref', order: 'descending'}"
                                border
                                style="width: 100%"  class="table table-responsive-sm table-sm">
                            <el-table-column label="Operations"  fixed="right" width="80">
                                    <template slot-scope="props">
                                        <!-- <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('mbrp_questionnaire','update',props.row)" > -->
                                        <button type="button" class="btn btn-warning btn-sm"  @click="abrirModal('parameter','actualizar',props.row)">    
                                            <i class="icon-pencil"></i>
                                        </button> 
                                        <template v-if="props.row.active">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarParameter(props.row.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarParameter(props.row.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </template>
                                </el-table-column>
                                <el-table-column label="Name" prop="name" sortable width="120" resizable ></el-table-column>
                                <el-table-column label="Code"  prop="code" sortable width="70"></el-table-column>
                                <el-table-column label="Description"       prop="description" sortable width="200">     </el-table-column>
                                <el-table-column label="Score"   prop="score" sortable >     </el-table-column>
                                <el-table-column label="Field" prop="field" sortable>     </el-table-column> 
                                <el-table-column label="Order" prop="order" sortable>     </el-table-column> 
                                <el-table-column label="Type" prop="param_type" sortable>     </el-table-column> 
                                <el-table-column label="Bottom v." prop="bottom_value" sortable>     </el-table-column> 
                                <el-table-column label="Top v." prop="top_value" sortable>     </el-table-column> 
                                <el-table-column label="Prison" prop="opt_prison"  :formatter="formatter_check" sortable>     </el-table-column> 
                                <el-table-column label="Community" prop="opt_community" :formatter="formatter_check" sortable>     </el-table-column> 
                                <el-table-column label="Active" prop="active" sortable>     
                                     <template slot-scope="props"> 
                                        <div v-if="props.row.active">
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Disabled</span>
                                        </div>
                                     </template>    
                                </el-table-column>
                            </el-table>
<!--
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Score</th>
                                    <th>Field</th>
                                    <th>Order</th>
                                    <th>Param.Type</th>
                                    <th>Bottom value</th>
                                    <th>Top value</th>
                                    <th>Prison</th>
                                    <th>Community</th>
                                    <th>Active</th>                                                                        
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="parameter in arrayParameter" :key="parameter.id">
                                    <td>
                                        <button type="button" @click="abrirModal('parameter','actualizar',parameter)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="parameter.active">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarParameter(parameter.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarParameter(parameter.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="parameter.name"></td>
                                    <td v-text="parameter.code"></td>
                                    <td v-text="parameter.description"></td>
                                    <td v-text="parameter.score"></td>
                                    <td v-text="parameter.field"></td>
                                    <td v-text="parameter.order"></td>
                                    <td v-text="parameter.param_type"></td>
                                    <td v-text="parameter.bottom_value"></td>
                                    <td v-text="parameter.top_value"></td>
                                    <td v-text="parameter.opt_prison"></td>
                                    <td v-text="parameter.opt_community"></td> 
                                    <td>
                                        <div v-if="parameter.active">
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Disabled</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
-->
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
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-2 form-control-label" for="text-input">Name:</label>
                                    <div class="col-md-4">
                                        <input type="text" v-model="name" class="form-control" placeholder="Parameter´s name">
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Code:</label>
                                    <div class="col-md-4">
                                        <input type="text" v-model="code" class="form-control" placeholder="Parameter´s code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="email-input">Descriptión:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="description" class="form-control" placeholder="insert the parameter's description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Field:</label>
                                    <div class="col-md-4">
                                        <input type="text" v-model="field" class="form-control" placeholder="">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Score:</label>
                                    <div class="col-md-2">
                                        <input type="number" value="0" step="any" class="form-control" v-model="score">
                                    </div>
                                     <label class="col-md-1 form-control-label" for="text-input">Order:</label>
                                    <div class="col-md-2">
                                        <input type="number" value="0" step="any" class="form-control" v-model="order">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Param. type:</label>
                                    <div class="col-md-2">
                                        <select v-model="param_type"  class="form-control form-control-sm">
                                            <option value="numeric">Numeric</option>
                                            <option value="boolean">Yes/No</option>
                                        </select>     
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Bottom Value:</label>
                                    <div class="col-md-2">
                                        <input type="number" value="0" step="any" class="form-control" v-model="bottom_value">
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Top Value:</label>
                                    <div class="col-md-2">
                                        <input type="number" value="0" step="any" class="form-control" v-model="top_value">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Options :</label>
                                    <div class="form-check form-check-inline col-md-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox"  v-model="opt_prison">
                                            Prison Opt.
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox"  v-model="opt_community">
                                            Community Opt.
                                        </label>
                                    </div>
                                </div>    
                                <div v-show="errorParameter" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjParameter" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarParameter()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarParameter()">Actualizar</button>
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
    import moment from 'moment'
   
    const booleanFilter = function(value, trueText, falseText) {
    return value ? trueText || 'Yes' : falseText || 'No';
    }

    locale.use(lang)    

    export default {
        filters: {
                boolean: booleanFilter
             }, 
        components:{
            'el-button': Button,
            'el-select': Select,
            'el-DatePicker': DatePicker,
            'el-table': Table,
            'el-checkbox': Checkbox
            },
        data (){
            return {
                parameter_id: 0,
                name : '',
                code:'',
                description : '',
                active: 1,
                field:'',
                order:0,
                score:0,
                param_type:'',
                bottom_value : 0,
                top_value : 0,
                opt_prison : 0,
                opt_community : 0,
                arrayParameter : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorParameter : 0,
                errorMostrarMsjParameter : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
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
            listarParameter (page,buscar,criterio){
                let me=this;
                var url= '/mbrp_parameter?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayParameter = respuesta.parameters.data;
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
                me.listarParameter(page,buscar,criterio);
            },
            registrarParameter(){
                if (this.validarParameter()){
                    return;
                }
                
                let me = this;

                axios.post('/mbrp_parameter/register',{
                    'name': this.name,
                    'code': this.code,
                    'description':this.description,
                    'score':this.score,
                    'active':this.active,
                    'field':this.field,
                    'order':this.order,
                    'param_type':this.param_type,
                    'bottom_value':this.bottom_value,
                    'top_value':this.top_value,
                    'opt_prison':this.opt_prison,
                    'opt_community':this.opt_community
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarParameter(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarParameter(){
               if (this.validarParameter()){
                    return;
                }
                
                let me = this;

                axios.put('/mbrp_parameter/update',{
                    'name': this.name,
                    'code': this.code,
                    'description':this.description,
                    'score':this.score,
                    'active':this.active,
                    'field':this.field,
                    'order':this.order,
                    'param_type':this.param_type,
                    'bottom_value':this.bottom_value,
                    'top_value':this.top_value,
                    'opt_prison':this.opt_prison,
                    'opt_community':this.opt_community,
                    'id': this.parameter_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarParameter(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarParameter(id){
               swal({
                title: 'Are you sure of disabled this parameter?',
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

                    axios.put('/mbrp_parameter/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarParameter(1,'','name');
                        swal(
                        'Disable!',
                        'The record has been successfully disabled.',
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
            activarParameter(id){
               swal({
                title: 'Are you sure of enabled this parameter?',
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

                    axios.put('/mbrp_parameter/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarParameter(1,'','nombre');
                        swal(
                        'Enable!',
                        'The record has ben successfully enabled.',
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
            validarParameter(){
                this.errorParameter=0;
                this.errorMostrarMsjParameter =[];

                if (!this.name) this.errorMostrarMsjParameter.push("The name of parameter don't be empty.");

                if (this.errorMostrarMsjParameter.length) this.errorParameter = 1;

                return this.errorParameter;
            },
            formatter_check(row, column) {
                 const property = column['property'];
                 return row[property]==0 ? 'No' : 'Yes';

            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.name='';
                this.code='';
                this.description='';
                this.score=0;
                this.order=0;
                this.active=1;
                this.field='';
                this.param_type='';
                this.bottom_value=0;
                this.top_value=0;
                this.opt_prison=0;
                this.opt_community=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "parameter":
                    {
                        switch(accion){
                            case 'register':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Register Parameter';
                                this.name='';
                                this.code='';
                                this.description='';
                                this.score=0;
                                this.order=0;
                                this.active=1;
                                this.field='';
                                this.param_type='';
                                this.bottom_value=0;
                                this.top_value=0;
                                this.opt_prison=0;
                                this.opt_community=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Update parameter';
                                this.tipoAccion=2;
                                this.name=data['name'];
                                this.code=data['code'];
                                this.description=data['description'];
                                this.score=data['score'];
                                this.order=data['order'];
                                this.active=data['active'];
                                this.field=data['field'];
                                this.param_type=data['param_type'];
                                this.bottom_value=data['bottom_value'];
                                this.top_value=data['top_value'];
                                this.opt_prison=data['opt_prison'];
                                this.opt_community=data['opt_community'];
                                this.parameter_id=data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarParameter(1,this.buscar,this.criterio);
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
        color: red !important;
        font-weight: bold;
    }
    .el-table thead th .cell{
    padding-left: 2px;
    padding-right: 2px;
    word-wrap: normal;
    white-space: nowrap;
    text-overflow: ellipsis;
    }
    .el-table .cell{
    padding-left: 2px;
    padding-right: 2px;
    }
</style>
