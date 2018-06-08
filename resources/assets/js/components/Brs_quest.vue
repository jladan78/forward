<template>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td width=55><strong>BRS 1: </strong> </td>
                        <td> I tend to bounce back quickly after hard times </td>
                        <td width=155 >
                            <div class="brs_quest_value">
                                <select v-model="brsValues[0]" @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                                </select>                                  
                            </div>  
                        </td>
                        <td width=20> </td>
                        <td width=55> <strong>BRS 2: </strong> </td>
                        <td> I have a hard time making through stressful event  </td>
                        <td  width=155 >
                            <div class="brs_quest_value">
                                <select v-model="brsValues[1]"  @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_down in arrayBrsDown" :key="brs_down.order" :value="brs_down.score" v-text="brs_down.name"></option>
                                </select>                                  
                            </div>                                                    
                        </td>
                    
                    </tr>
                    <tr>
                        <td width=55><strong>BRS 3: </strong></td>
                        <td>It does not take me long to recover from a stressful event  </td>
                        <td>
                        <div class="brs_quest_value">
                                <select v-model="brsValues[2]" @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                                </select>                                  
                            </div>
                        </td><td width=20></td>

                        <td width=55><strong>BRS 4: </strong></td>
                        <td>I tend to bounce back quickly after hard times2222 </td>
                        <td>
                            <div class="brs_quest_value">
                                <select v-model="brsValues[3]" @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_down in arrayBrsDown" :key="brs_down.order" :value="brs_down.score" v-text="brs_down.name"></option>
                                </select>                                  
                            </div>
                        </td>
                    
                    </tr>
                    <tr>
                        <td width=55><strong>BRS 5: </strong></td>
                        <td> I tend to bounce back quickly after hard times  </td>
                        <td>
                            <div class="brs_quest_value">
                                <select v-model="brsValues[4]" @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                                </select>                                  
                            </div>
                        </td>
                        <td width=20></td>

                        <td width=55><strong>BRS 6: </strong></td>
                        <td>I tend to bounce back quickly after hard times2222  </td>
                        <td>
                            <div class="brs_quest_value">
                                <select v-model="brsValues[5]" @change="validarBrs()" class="form-control form-control-sm">
                                    <option value="0" disabled>Select...</option>
                                    <option v-for="brs_down in arrayBrsDown" :key="brs_down.order" :value="brs_down.score" v-text="brs_down.name"></option>
                                </select>                                  
                            </div>
                        </td>
                    
                    </tr>                                                
                    <tr>
                        <td colspan="7" align="right"></td>
                    </tr>
                    <tr>
                        
                        <td colspan="6" align="right"><button type="button" :disabled="!brs_ok" @click="calcularBRS()"  class="btn btn-success">Check Score</button></td>
                        <td align="right"><h6> BRS Score: {{ brs_score}}</h6></td>
                    </tr>
                </tbody>                                    
            </table>
        </div>
</div>
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
        props:{
            brsValues:{type: Array, required:true}
            },
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
                mbrp_questionnaire_id:0,
                arrayBrsUp:[],
                arrayBrsDown:[],
                pre_quest: 1,
                brs_ok:false,
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorBrsTest : 0,
                errorMostrarMsjBrsTest : [],
            }
        },
        computed:{
            //Calcula el valor brs
             brs_score: function(){
                 return ((this.brsValues[0]+this.brsValues[1]+this.brsValues[2]+this.brsValues[3]+this.brsValues[4]+this.brsValues[5])/6).toFixed();
               
          } 
        },
        methods : {

            updateMbrp_BrsQuestionnaire(){
             
                let me = this;
                
                axios.put('/mbrp_questionnaire/updatebrs',{
                    'brs1':this.brsValues[0],
                    'brs2':this.brsValues[1],
                    'brs3':this.brsValues[2],
                    'brs4':this.brsValues[3],
                    'brs5':this.brsValues[4],
                    'brs6':this.brsValues[5], 
                    'brs_score':this.brs_score,                   
                    'id': this.$parent.brs_test_id
                }).then(function (response) {
                     console.log('BRS actualizado');
                    
                   // me.listMbrp_questionnaires(1,'','client_ref');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },

            
            
            calcularBRS(){
            
                //this.brs_score=((this.brsValues[0]+this.brsValues[1]+this.brsValues[2]+this.brsValues[3]+this.brsValues[4]+this.brsValues[5])/6).toFixed();
                this.updateMbrp_BrsQuestionnaire();
                this.$parent.brs_score=this.brs_score;
               //  console.log(this.brs_ok);
                this.$parent.brs_ok=this.brs_ok;
                // console.log( this.$parent.brs_ok);
               // this.$parent.comprobarMBRP();

            },
            validarBrs(){
                 
                if ((this.brsValues[0]>0) && (this.brsValues[1]>0) && (this.brsValues[2]>0) && (this.brsValues[3]>0) && (this.brsValues[4]>0) && (this.brsValues[5]>0) )
                {
                    this.brs_ok=true;
                } else{
                    this.brs_ok=false;
                }
               
               this.$parent.brs_ok=this.brs_ok;
                 
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

        },
        mounted() {
           // this.listMbrp_questionnaires(1,this.buscar,this.criterio);
          // this.brs_score=this.brs_score1;
            this.selectBrsUp();
            this.selectBrsDown();
            this.validarBrs(); 
             
            
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
    .el-table td, .el-table th {
        padding: 5px 0;
    }
    .sw {
        padding-bottom: 3px;
        padding-top: 3px;
        margin-bottom: 0px;
    }
</style>
