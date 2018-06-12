<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Client;
use App\Person;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $persons = Client::join('persons','clients.id','=','persons.id')
            ->select('persons.id','clients.reference', 'clients.initials',
            'persons.first_name', 'persons.last_name',
            'persons.id_document','persons.address','persons.phone',
            'persons.email','clients.dob','clients.contact','clients.contact_phone')
            ->orderBy('persons.id', 'desc')->paginate(10);
        }
        else{
            $persons = Client::join('persons','clients.id','=','persons.id')
            ->select('persons.id','clients.reference', 'clients.initials',
            'persons.first_name', 'persons.last_name',
            'persons.id_document','persons.address','persons.phone',
            'persons.email','clients.dob','clients.contact','clients.contact_phone')   
            ->where('persons.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('persons.id', 'desc')->paginate(10);
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

    public function selectClient(Request $request){
     if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $clients = Client::join('persons','clients.id','=','persons.id')
        ->where('clients.reference', 'like', '%'. $filtro . '%')
        ->orWhere('persons.id_document', 'like', '%'. $filtro . '%')
        ->orWhere('persons.last_name', 'like', '%'. $filtro . '%')
        ->orWhere('clients.initials', 'like', '%'. $filtro . '%')
        ->select('clients.id','clients.reference','clients.initials', 'clients.dob')
        ->orderBy('clients.reference', 'asc')->get();

        return ['clients' => $clients];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
            $person = new Person();
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->id_document = $request->id_document;
            $person->address = $request->address;
            $person->phone = $request->phone;
            $person->email = $request->email;
            $person->save();

            $client = new Client();
            $client->reference = $request->reference;
            $client->initials = $request->initials;
            $client->dob = $request->dob;
            $client->contact = $request->contact;
            $client->contact_phone = $request->contact_phone;
            $client->id = $person->id;
            $client->save();

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

            $client = Client::findOrFail($request->id);

            $person = Person::findOrFail($client->id);

            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->id_document = $request->id_document;
            $person->address = $request->address;
            $person->phone = $request->phone;
            $person->email = $request->email;
            $person->save();

            $client->reference = $request->reference;
            $client->initials = $request->initials;
            $client->dob = $request->dob;
            $client->contact = $request->contact;
            $client->contact_phone = $request->contact_phone;
            $client->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
}
