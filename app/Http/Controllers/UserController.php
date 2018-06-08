<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Person;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $persons = User::join('persons','users.id','=','persons.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('persons.id','persons.first_name','persons.last_name','persons.address','persons.phone','persons.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('persons.id', 'desc')->paginate(5);
        }
        else{
            $persons = User::join('persons','users.id','=','persons.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('persons.id','persons.first_name','persons.last_name','persons.address','persons.phone','persons.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->where('persons.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
        }
        
        return [
            'pagination' => [
                'total'        => $persons->total(),
                'current_page' => $persons->currentPage(),
                'per_page'     => $persons->perPage(),
                'last_page'    => $persons->lastPage(),
                'from'         => $persons->firstItem(),
                'to'           => $persons->lastItem(),
            ],
            'persons' => $persons
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $person = new Person();
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->address = $request->address;
            $person->phone = $request->phone;
            $person->email = $request->email;
            $person->save();

            $user = new User();
            $user->id = $person->id;
            $user->idrol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';            
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $person = Person::findOrFail($user->id);
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->address = $request->address;
            $person->phone = $request->phone;
            $person->email = $request->email;
            $person->save();

            
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
