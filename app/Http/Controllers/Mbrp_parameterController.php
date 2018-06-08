<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mbrp_parameter;

class Mbrp_parameterController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $parameters = Mbrp_parameter::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $parameters = Mbrp_parameter::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $parameters->total(),
                'current_page' => $parameters->currentPage(),
                'per_page'     => $parameters->perPage(),
                'last_page'    => $parameters->lastPage(),
                'from'         => $parameters->firstItem(),
                'to'           => $parameters->lastItem(),
            ],
            'parameters' => $parameters
        ];
    }

    public function selectParameter(Request $request)
    {
 
       $field = $request->field;
        if (!$request->ajax()) return redirect('/');
        $Parameters = Mbrp_parameter::where('field', '=', $field)->where('active', '=', 1)
        ->select('id','name','code','description','score','order','param_type','bottom_value','top_value')
        ->orderBy('order', 'asc')->get();

        return ['parameters' => $Parameters];
    } 

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $parameter = new Mbrp_parameter();
        $parameter->name = $request->name;
        $parameter->code = $request->code;
        $parameter->description = $request->description;
        $parameter->score = $request->score;
        $parameter->active = '1';
        $parameter->field = $request->field;
        $parameter->order = $request->order;
        $parameter->param_type = $request->param_type;
        $parameter->bottom_value = $request->bottom_value;
        $parameter->top_value = $request->top_value;
        $parameter->opt_prison = $request->opt_prison;
        $parameter->opt_community = $request->opt_community;
        $parameter->save();
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
        $parameter = Mbrp_parameter::findOrFail($request->id);
        $parameter->name = $request->name;
        $parameter->code = $request->code;
        $parameter->description = $request->description;
        $parameter->score = $request->score;
        $parameter->active = $request->active;
        $parameter->field = $request->field;
        $parameter->order = $request->order;
        $parameter->param_type = $request->param_type;
        $parameter->bottom_value = $request->bottom_value;
        $parameter->top_value = $request->top_value;
        $parameter->opt_prison = $request->opt_prison;
        $parameter->opt_community = $request->opt_community;
        $parameter->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $parameter = Mbrp_parameter::findOrFail($request->id);
        $parameter->active = '0';
        $parameter->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $parameter = Mbrp_parameter::findOrFail($request->id);
        $parameter->active = '1';
        $parameter->save();
    }

}
