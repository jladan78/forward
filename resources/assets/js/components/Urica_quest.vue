<template>
<div class="card-body">
                     <!-- <div class="row">
                        <div class="col-md-2"> <strong>URICA 1: </strong> </div>
                        <div class="col-md-8"> As far as I'm concerned I don't have any problems that need changing  </div>
                        <div class="col-md-2">
                            <select v-model="uricaValues[0]" @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select> 
                        </div>
                    </div> -->
    <div class="table-responsive col-md-12">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td colspan="7" align="left">Each statement describes how a person might feel when starting therapy or approaching 
                        problems in their lives. Please indicate the extent to which you tend to agree or disagree with each statement.
                        In each case, make your choice in terms of how you feel right now, not what you have felt in the past or would 
                        like to feel. For all the statements that refer to your "problem", answer in terms of problems related to your
                         drinking and/or drug use. </td>
                </tr>
                <tr>
                    <td width=80><strong>URICA 1: </strong> </td>
                    <td colspan="5" align="left">As far as I'm concerned I don't have any problems that need changing  </td>
                    <td>
                        <div class="brs_quest_value">
<!--                             <select v-model="uricaValues[0]" @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>   -->  
                             <el-select v-model="uricaValues[0]" @change="validarUrica()"  clearable placeholder="Select...">
                                <el-option
                                v-for="brs_up in arrayBrsUp"
                                :key="brs_up.order"
                                :label="brs_up.name"
                                :value="brs_up.score">
                                </el-option>
                            </el-select>

                        </div>  
                    </td> 
                </tr>
                <tr>
                    <td width=80> <strong>URICA 2: </strong> </td>
                    <td colspan="5" align="left">I think I might be ready for some self-improvement </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[1]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 3: </strong> </td>
                    <td colspan="5" align="left"> I am doing something about the problems that had been bothering me. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[2]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 4: </strong> </td>
                    <td colspan="5" align="left"> It might be worthwhile to work on my problem. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[3]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 5: </strong> </td>
                    <td colspan="5" align="left">I'm not the problem one. It doesn't make much sense for me to be here.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[4]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 6: </strong> </td>
                    <td colspan="5" align="left">It worries me that I might slip back on a problem I have already changed, so I am here to seek help.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[5]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 7: </strong> </td>
                    <td colspan="5" align="left">I am finally doing some work on my problem. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[6]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 8: </strong> </td>
                    <td colspan="5" align="left">I've been thinking that I might want to change something about myself.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[7]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 9: </strong> </td>
                    <td colspan="5" align="left">I have been successful in working on my problem but I'm not sure I can keep up the effort on my own. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[8]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 10: </strong> </td>
                    <td colspan="5" align="left">At times my problem is difficult, but I'm working on it.</td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[9]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 11: </strong> </td>
                    <td colspan="5" align="left">Tryinng to change is pretty much a waste of time for me because the problem doesn't have to do with me.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[10]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 12: </strong> </td>
                    <td colspan="5" align="left">I'm hoping this place will help me to better understand myself.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[11]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 13: </strong> </td>
                    <td colspan="5" align="left">I guess I have faults, but there's nothing that I really need to change. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[12]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 14: </strong> </td>
                    <td colspan="5" align="left">I am really working hard to change.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[13]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 15: </strong> </td>
                    <td colspan="5" align="left">I have a problem and I really think I should work at it. </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[14]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 16: </strong> </td>
                    <td colspan="5" align="left">I'm not following through with what I had already changed as well as I had hoped, and I'm here to prevent a relapse of the problem.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[15]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 17: </strong> </td>
                    <td colspan="5" align="left">Even though I'm not always successful in changing, I am at least working on my problem.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[16]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 18: </strong> </td>
                    <td colspan="5" align="left">I thought once I had resolved my problem I would be free of it, but sometimes I still find myself struggling with it.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[17]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 19: </strong> </td>
                    <td colspan="5" align="left">I wish I had more ideas on how to solve the problem.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[18]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 20: </strong> </td>
                    <td colspan="5" align="left">I have started working on my problems but I would like help.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[19]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 21: </strong> </td>
                    <td colspan="5" align="left">Maybe this place will be able to help me.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[20]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 22: </strong> </td>
                    <td colspan="5" align="left">I may need a boost right now to help me maintain the changes I've already made.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[21]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 23: </strong> </td>
                    <td colspan="5" align="left">I may be part of the problem, but I don't really think I am.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[22]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 24: </strong> </td>
                    <td colspan="5" align="left">I hope that someone here will have some good advice for me.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[23]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 25: </strong> </td>
                    <td colspan="5" align="left">Anyone can talk about changing; I'm actually doing something about it.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[24]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 26: </strong> </td>
                    <td colspan="5" align="left">All this talk about psychology is boring. Why can't people just forget about their problems?  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[25]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 27: </strong> </td>
                    <td colspan="5" align="left">I'm struggling to prevent myself from having a relapse of my problem.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[26]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 28: </strong> </td>
                    <td colspan="5" align="left">It is frustrating, but I feel I might be having a recurrence of a problem I thought I had resolved.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[27]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 29: </strong> </td>
                    <td colspan="5" align="left">I have worries but so does the next guy. Why spend time thinking about them?  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[28]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 30: </strong> </td>
                    <td colspan="5" align="left">I am actively working on my problem.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[29]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 31: </strong> </td>
                    <td colspan="5" align="left">I would rather cope with my faults than try to change them.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[30]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr>
                <tr>
                    <td width=80> <strong>URICA 32: </strong> </td>
                    <td colspan="5" align="left">After all I had done to try to change my problem, every now and again it comes back to haunt me.  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[31]"  @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>                                                    
                    </td>
                
                </tr> 
               <!--  
                <tr>
                    <td width=55><strong>URICA 30: </strong></td>
                    <td> I tend to bounce back quickly after hard times  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[29]" @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>
                    </td>
                    <td width=20></td>

                    <td width=55><strong>URICA 31: </strong></td>
                    <td>I tend to bounce back quickly after hard times2222  </td>
                    <td>
                        <div class="brs_quest_value">
                            <select v-model="uricaValues[30]" @change="validarUrica()" class="form-control form-control-sm">
                                <option value="0" disabled>Select...</option>
                                <option v-for="brs_up in arrayBrsUp" :key="brs_up.order" :value="brs_up.score" v-text="brs_up.name"></option>
                            </select>                                  
                        </div>
                    </td>
                
                </tr>
 -->
                <tr>
                    <td colspan="7" align="right"></td>
                </tr>
                <tr>
                    <td  colspan="6" align="center">
                        <div class="form-group row">
                            <h6 class="col-sm-2">PR : {{pr_score}}</h6>
                            <h6 class="col-sm-2">CON : {{con_score}} </h6>
                            <h6 class="col-sm-2">AC : {{ac_score}} </h6>
                            <h6 class="col-sm-2">MA : {{ma_score}} </h6>
                            <h6 class="col-sm-4">Highest: {{ urica_highest}}</h6>
                        </div>
                    </td>
                    <td  align="right"><button type="button" :disabled="!urica_ok" @click="calcularURICA()"  class="btn btn-success">Check Score</button></td>
                    
                </tr>
            </tbody>                                    
        </table>
    </div>
</div>
</template>

<script>
    import 'element-ui/lib/theme-chalk/index.css';
    import { Button, Select ,DatePicker,Table,Checkbox,Option} from 'element-ui';
    import lang from 'element-ui/lib/locale/lang/en';
    import locale from 'element-ui/lib/locale';
    import moment from 'moment'
    
    const booleanFilter = function(value, trueText, falseText) {
    return value ? trueText || 'Yes' : falseText || 'No';
    }

    locale.use(lang)
     export default {
            props:{
                uricaValues:{type: Array, required:true}
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
            'el-option': Option

            },
        data (){
            return {
                urica_highest:'',
                pr_score:0,
                con_score:0,
                ac_score:0,
                ma_score:0,
                urica_ok:false,
                arrayBrsUp:[],
                arrayBrsDown:[],
                pre_quest: 1,
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUricaTest : 0,
                errorMostrarMsjUricaTest : [],
            }
        },
        computed:{
            //Calcula los valores Urica
     
        },
        methods : {

            updateMbrp_UricaQuestionnaire(){
             
                let me = this;
                
                axios.put('/mbrp_questionnaire/updateurica',{
                    'urica1':this.uricaValues[0],
                    'urica2':this.uricaValues[1],
                    'urica3':this.uricaValues[2],
                    'urica4':this.uricaValues[3],
                    'urica5':this.uricaValues[4],
                    'urica6':this.uricaValues[5],
                    'urica7':this.uricaValues[6],
                    'urica8':this.uricaValues[7],
                    'urica9':this.uricaValues[8],
                    'urica10':this.uricaValues[9],
                    'urica11':this.uricaValues[10],
                    'urica12':this.uricaValues[11],
                    'urica13':this.uricaValues[12],
                    'urica14':this.uricaValues[13],
                    'urica15':this.uricaValues[14],
                    'urica16':this.uricaValues[15],
                    'urica17':this.uricaValues[16],
                    'urica18':this.uricaValues[17],
                    'urica19':this.uricaValues[18],
                    'urica20':this.uricaValues[19],
                    'urica21':this.uricaValues[20],
                    'urica22':this.uricaValues[21],
                    'urica23':this.uricaValues[22],
                    'urica24':this.uricaValues[23],
                    'urica25':this.uricaValues[24],
                    'urica26':this.uricaValues[25],
                    'urica27':this.uricaValues[26],
                    'urica28':this.uricaValues[27],
                    'urica29':this.uricaValues[28],
                    'urica30':this.uricaValues[29],
                    'urica31':this.uricaValues[30],
                    'urica32':this.uricaValues[31],
                    'urica_highest':this.urica_highest,
                    'pr_score':this.pr_score,
                    'con_score':this.con_score,
                    'ac_score':this.ac_score,                   
                    'ma_score':this.ma_score,                   
                    'id':this.$parent.urica_test_id
                }).then(function (response) {
                    console.log('URICA actualizado');
                  //  me.listMbrp_questionnaires(1,'','client_ref');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },

            
            
            calcularURICA(){
        
                this.pr_score = this.uricaValues[0]+ this.uricaValues[4]+ this.uricaValues[10] + this.uricaValues[12] + this.uricaValues[22] + this.uricaValues[25] + this.uricaValues[28] + this.uricaValues[30]
                this.con_score = this.uricaValues[1]+ this.uricaValues[3]+ this.uricaValues[7]+ this.uricaValues[11] + this.uricaValues[14] + this.uricaValues[18] + this.uricaValues[20] + this.uricaValues[23]
                this.ac_score = this.uricaValues[2]+ this.uricaValues[6]+ this.uricaValues[9] + this.uricaValues[13] + this.uricaValues[16] + this.uricaValues[19] + this.uricaValues[24] + this.uricaValues[29]
                this.ma_score = this.uricaValues[5]+ this.uricaValues[8]+ this.uricaValues[15] + this.uricaValues[17] + this.uricaValues[21] + this.uricaValues[26] + this.uricaValues[27] + this.uricaValues[31]
                
                if ((this.pr_score >= this.con_score) && (this.pr_score >= this.ac_score) && (this.pr_score >= this.ma_score)){
                    this.urica_highest = "PR";
                } else if ((this.con_score >= this.ac_score) && (this.con_score >= this.ma_score)){
                        this.urica_highest = "CON";
                    }else if (this.ac_score >= this.ma_score){
                        this.urica_highest = "AC";
                    }else{
                        this.urica_highest = "MA";
                        }
                this.updateMbrp_UricaQuestionnaire();
                this.$parent.urica_highest=this.urica_highest;
                this.$parent.urica_pr_score=this.pr_score;
                this.$parent.urica_con_score=this.con_score;
                this.$parent.urica_ac_score=this.ac_score;
                this.$parent.urica_ma_score=this.ma_score;
               //  console.log(this.urica_ok);
                this.$parent.urica_ok=this.urica_ok;
                // console.log( this.$parent.brs_ok);
                //this.$parent.comprobarMBRP();


            },
            validarUrica(){
                this.urica_ok=true;
                for(var x in this.uricaValues){
                    if ((this.uricaValues[x]==0)) 
                    {
                        this.urica_ok=false;
                    }
                }
                this.$parent.urica_ok=this.urica_ok;
                 
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
            
             this.selectBrsUp();
             this.selectBrsDown();
             this.validarUrica();

            
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
