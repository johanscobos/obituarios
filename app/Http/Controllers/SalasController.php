<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SalasController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($id)
    {
        $sala = DB::table('salas') 
        ->join('sedes','salas.sedeid','=','sedes.id')
        ->join('ciudades','sedes.idciudad','=','ciudades.id')
        ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
        ->where('departamentos.iddepartamento','=',$id)
        ->whereNull('salas.deleted_at')
        ->select(DB::raw('salas.id as salaid, salas.nombresala as nombresala, salas.direccionip as direccionip, sedes.id as sedeid,sedes.nombresede as nombresede'))
        ->get();
        return response() -> json([$sala], 200);
    }

    public function getAll()
    {
        $sala = DB::table('salas') 
        ->join('sedes','salas.sedeid','=','sedes.id')
        ->whereNull('salas.deleted_at')
        ->select(DB::raw('salas.id as salaid, salas.nombresala as nombresala, salas.direccionip as direccionip, sedes.id as sedeid,sedes.nombresede as nombresede'))
        ->get();
        return response() -> json([$sala], 200);
    }

    public function createSala(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombresala' => 'required',
                'sedeid' => 'required',
                'direccionip'=> array('regex:/^((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)$/')
            ],['required' =>'El campo es obligatorio.','regex'=>'Formato de direccion ip incorrecto(###.###.###).']);

            $sala = Sala::create([
                'nombresala' => $request->nombresala,
                'sedeid' => $request->sedeid,
                'direccionip' => $request->direccionip
            ]);
            return response()->json([$sala], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSala( $id, Request $request)
    {
    
            $infoSala = Sala::find($id);
            $infoSala-> nombresala=$request->input('nombresala');
            $infoSala-> sedeid=$request->input('sedeid');
            $infoSala-> direccionip=$request->input('direccionip');
            $infoSala ->save();
            return response()->json([$infoSala], 201);
       
    }

    
    public function destroySala($id, Request $request)
    {
    
            $infoSala = Sala::destroy($id);
            return response()->json([$infoSala], 201);
       
    }

    
}
