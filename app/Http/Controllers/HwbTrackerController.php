<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\HwbTracker;

class HwbTrackerController extends Controller
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
            $hwb_tracker = HwbTracker::with('client')->orderBy('id', 'desc')->paginate(5);
        }
        else{
            $hwb_tracker = HwbTracker::with('client')->where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
       
         }
        

        return [
            'pagination' => [
                'total'        => $hwb_tracker->total(),
                'current_page' => $hwb_tracker->currentPage(),
                'per_page'     => $hwb_tracker->perPage(),
                'last_page'    => $hwb_tracker->lastPage(),
                'from'         => $hwb_tracker->firstItem(),
                'to'           => $hwb_tracker->lastItem(),
            ],
            'hwb_tracker' => $hwb_tracker
        ];
    }

    public function getTracker(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $hwb_tracker = HwbTracker::findOrFail($request->id);
       return $hwb_tracker;

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
        $hwb_tracker = new HwbTracker();
        $hwb_tracker->client_id = $request->client_id;
        $hwb_tracker->description = $request->description;
        $hwb_tracker->date_track = $request->date_track;
        $hwb_tracker->sn_value = $request->sn_value;
        $hwb_tracker->pcls_value = $request->pcls_value;
        $hwb_tracker->emp_value = $request->emp_value;
        $hwb_tracker->nps_value = $request->nps_value;
        $hwb_tracker->ips_value = $request->ips_value;
        $hwb_tracker->smk_value = $request->smk_value;
        $hwb_tracker->sh_value = $request->sh_value;
        $hwb_tracker->ph_value = $request->ph_value;
        $hwb_tracker->mh_value = $request->mh_value;
        $hwb_tracker->dau_value = $request->dau_value;
        $hwb_tracker->sn_notes = $request->sn_notes;
        $hwb_tracker->pcls_notes = $request->pcls_notes;
        $hwb_tracker->emp_notes = $request->emp_notes;
        $hwb_tracker->nps_notes = $request->nps_notes;
        $hwb_tracker->ips_notes = $request->ips_notes;
        $hwb_tracker->smk_notes = $request->smk_notes;
        $hwb_tracker->sh_notes = $request->sh_notes;
        $hwb_tracker->ph_notes = $request->ph_notes;
        $hwb_tracker->mh_notes = $request->mh_notes;
        $hwb_tracker->dau_notes = $request->dau_notes;
        
        $hwb_tracker->save();
        return $hwb_tracker;
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
        $hwb_tracker = HwbTracker::findOrFail($request->id);
        $hwb_tracker->client_id = $request->client_id;
        $hwb_tracker->description = $request->description;
        $hwb_tracker->date_track = $request->date_track;
        $hwb_tracker->sn_value = $request->sn_value;
        $hwb_tracker->pcls_value = $request->pcls_value;
        $hwb_tracker->emp_value = $request->emp_value;
        $hwb_tracker->nps_value = $request->nps_value;
        $hwb_tracker->ips_value = $request->ips_value;
        $hwb_tracker->smk_value = $request->smk_value;
        $hwb_tracker->sh_value = $request->sh_value;
        $hwb_tracker->ph_value = $request->ph_value;
        $hwb_tracker->mh_value = $request->mh_value;
        $hwb_tracker->dau_value = $request->dau_value;
        $hwb_tracker->sn_notes = $request->sn_notes;
        $hwb_tracker->pcls_notes = $request->pcls_notes;
        $hwb_tracker->emp_notes = $request->emp_notes;
        $hwb_tracker->nps_notes = $request->nps_notes;
        $hwb_tracker->ips_notes = $request->ips_notes;
        $hwb_tracker->smk_notes = $request->smk_notes;
        $hwb_tracker->sh_notes = $request->sh_notes;
        $hwb_tracker->ph_notes = $request->ph_notes;
        $hwb_tracker->mh_notes = $request->mh_notes;
        $hwb_tracker->dau_notes = $request->dau_notes;
        $hwb_tracker->save();
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
        $hwb_tracker = HwbTracker::findOrFail($id);
        $hwb_tracker -> delete();
   
    }
    public function delete(Request $request)
    {
        try 
        {
            $hwb_tracker = HwbTracker::findOrFail($request->id);
            $hwb_tracker -> delete();
           
            return response()->json('Cuestionario borrado');
        }

        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
