<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mbrp_questionnaire;
use App\BrsTest;
use App\UricaTest;
use App\DatcTest;
use App\SpsiTest;
use App\MhTest;

class Mbrp_questionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mbrp_questionnaire = Mbrp_questionnaire::with('client','mbrp_programme','brsTest','uricaTest')->orderBy('id', 'desc')->paginate(5);
        }
        else{
            $mbrp_questionnaire = Mbrp_questionnaire::with('client','mbrp_programme','brsTest','uricaTest')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
           /*  $mbrp_questionnaire = Mbrp_questionnaire::with('client','mbrp_programme')
                                    ->join('mbrp_programmes','mbrp_questionnaires.mbrp_programme_id','=','mbrp_programmes.id')
                                    ->where($criterio, 'like', '%'. $buscar . '%')->orderBy('mbrp_questionnaires.id', 'desc')->paginate(5);
 */       
         }
        

        return [
            'pagination' => [
                'total'        => $mbrp_questionnaire->total(),
                'current_page' => $mbrp_questionnaire->currentPage(),
                'per_page'     => $mbrp_questionnaire->perPage(),
                'last_page'    => $mbrp_questionnaire->lastPage(),
                'from'         => $mbrp_questionnaire->firstItem(),
                'to'           => $mbrp_questionnaire->lastItem(),
            ],
            'mbrp_questionnaire' => $mbrp_questionnaire
        ];
    }

    public function getQuestionnaire(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mbrp_questionnaire = Mbrp_questionnaire::findOrFail($request->id);
       return $mbrp_questionnaire;

    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mbrp_questionnaire = new Mbrp_questionnaire();
        $mbrp_questionnaire->client_id = $request->client_id;
        $mbrp_questionnaire->client_age = $request->client_age;
        $mbrp_questionnaire->stage = $request->stage;
        $mbrp_questionnaire->mbrp_programme_id = $request->mbrp_programme_id;
        $mbrp_questionnaire->date_engaged = $request->date_engaged;
        $mbrp_questionnaire->date_completed = $request->date_completed;
        $mbrp_questionnaire->is_completed = $request->is_completed;
        $mbrp_questionnaire->end_reason = $request->end_reason;
        $mbrp_questionnaire->brs_q = $request->brs_q;
        $mbrp_questionnaire->urica_q = $request->urica_q;
        $mbrp_questionnaire->datc_q = $request->datc_q;
        $mbrp_questionnaire->spsi_q = $request->spsi_q;
        $mbrp_questionnaire->mh_q = $request->mh_q;
        $mbrp_questionnaire->pf_q = $request->pf_q;
        $mbrp_questionnaire->pf1 = 0;
        $mbrp_questionnaire->pf2 = 0;
        $mbrp_questionnaire->pf3 = 0;
        $mbrp_questionnaire->pf4 = 0;
        $mbrp_questionnaire->pf5 = 0;
        $mbrp_questionnaire->pf6 = 0;
        $mbrp_questionnaire->pf7 = 0;
        $mbrp_questionnaire->pf8 = 0;
        $mbrp_questionnaire->pf9 = 0;
        $mbrp_questionnaire->pf10 = 0;
        $mbrp_questionnaire->pf11 = 0;
        $mbrp_questionnaire->pf_comments = '';
        $brs_test = new BrsTest();
        $brs_test->save();
        $mbrp_questionnaire->brs_test_id=$brs_test->id;
        $urica_test = new UricaTest();
        $urica_test->save();
        $mbrp_questionnaire->urica_test_id=$urica_test->id;
        
        $mbrp_questionnaire->save();
        return $mbrp_questionnaire;
    }

    

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mbrp_questionnaire = Mbrp_questionnaire::findOrFail($request->id);
        $mbrp_questionnaire->client_id = $request->client_id;
        $mbrp_questionnaire->client_age = $request->client_age;
        $mbrp_questionnaire->stage = $request->stage;
        $mbrp_questionnaire->mbrp_programme_id = $request->mbrp_programme_id;
        $mbrp_questionnaire->date_engaged = $request->date_engaged;
        $mbrp_questionnaire->date_completed = $request->date_completed;
        $mbrp_questionnaire->is_completed = $request->is_completed;
        $mbrp_questionnaire->end_reason = $request->end_reason;
        $mbrp_questionnaire->brs_q = $request->brs_q;
        $mbrp_questionnaire->urica_q = $request->urica_q;
        $mbrp_questionnaire->datc_q = $request->datc_q;
        $mbrp_questionnaire->spsi_q = $request->spsi_q;
        $mbrp_questionnaire->mh_q = $request->mh_q;
        $mbrp_questionnaire->pf_q = $request->pf_q;
        $mbrp_questionnaire->save();
    }
    public function registerBrs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $brs_test = new BrsTest();
        $brs_test->brs1 = $request->brs1;
        $brs_test->brs2 = $request->brs2;
        $brs_test->brs3 = $request->brs3;
        $brs_test->brs4 = $request->brs4;
        $brs_test->brs5 = $request->brs5;
        $brs_test->brs6 = $request->brs6;
        $brs_test->brs_score = $request->brs_score;
        $brs_test->save();
        $mbrp_questionnaire = Mbrp_questionnaire::findOrFail($request->id);
        $mbrp_questionnaire->brs_test_id=$brs_test->id;
        $mbrp_questionnaire->save();
        return $brs_test;
    }
    public function updateBrs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $brs_test = BrsTest::findOrFail($request->id);
        $brs_test->brs1 = $request->brs1;
        $brs_test->brs2 = $request->brs2;
        $brs_test->brs3 = $request->brs3;
        $brs_test->brs4 = $request->brs4;
        $brs_test->brs5 = $request->brs5;
        $brs_test->brs6 = $request->brs6;
        $brs_test->brs_score = $request->brs_score;
        $brs_test->save();
    }
    public function updateUrica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $urica_test = UricaTest::findOrFail($request->id);
        $urica_test->urica1 = $request->urica1;
        $urica_test->urica2 = $request->urica2;
        $urica_test->urica3 = $request->urica3;
        $urica_test->urica4 = $request->urica4;
        $urica_test->urica5 = $request->urica5;
        $urica_test->urica6 = $request->urica6;
        $urica_test->urica7 = $request->urica7;
        $urica_test->urica8 = $request->urica8;
        $urica_test->urica9 = $request->urica9;
        $urica_test->urica10 = $request->urica10;
        $urica_test->urica11 = $request->urica11;
        $urica_test->urica12 = $request->urica12;
        $urica_test->urica13 = $request->urica13;
        $urica_test->urica14 = $request->urica14;
        $urica_test->urica15 = $request->urica15;
        $urica_test->urica16 = $request->urica16;
        $urica_test->urica17 = $request->urica17;
        $urica_test->urica18 = $request->urica18;
        $urica_test->urica19 = $request->urica19;
        $urica_test->urica20 = $request->urica20;
        $urica_test->urica21 = $request->urica21;
        $urica_test->urica22 = $request->urica22;
        $urica_test->urica23 = $request->urica23;
        $urica_test->urica24 = $request->urica24;
        $urica_test->urica25 = $request->urica25;
        $urica_test->urica26 = $request->urica26;
        $urica_test->urica27 = $request->urica27;
        $urica_test->urica28 = $request->urica28;
        $urica_test->urica29 = $request->urica29;
        $urica_test->urica30 = $request->urica30;
        $urica_test->urica31 = $request->urica31;
        $urica_test->urica32 = $request->urica32;
        $urica_test->urica_highest = $request->urica_highest;
        $urica_test->pr_score = $request->pr_score;
        $urica_test->con_score = $request->con_score;
        $urica_test->ac_score = $request->ac_score;
        $urica_test->ma_score = $request->ma_score;
        $urica_test->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!$request->ajax()) return redirect('/');
        $mbrp_questionnaire = Mbrp_questionnaire::findOrFail($id);
        $mbrp_questionnaire -> delete();
   
    }
    public function delete(Request $request)
    {
        try 
        {
            $mbrp_questionnaire = Mbrp_questionnaire::findOrFail($request->id);
            $mbrp_questionnaire -> delete();
           
            return response()->json('Cuestionario borrado');
        }

        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
