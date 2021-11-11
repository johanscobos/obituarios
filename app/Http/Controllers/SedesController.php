<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SedesController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($id)
    {
       //muestra todos los usuarios
       $sede = DB::table('sedes') 
       ->join('ciudades','sedes.idciudad', '=', 'ciudades.id')
       ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
       ->where('departamentos.iddepartamento','=',$id)
       ->whereNull('sedes.deleted_at')
       ->select(DB::raw('sedes.id as sedeid, sedes.nombresede,sedes.direccion as direccionsede, sedes.telefono as telefonosede,ciudades.nombreciudad as ciudadsede, ciudades.idciudad as ciudadid,ciudades.id as ciud'))
       ->get();
        return response() -> json([$sede], 200);
    }

    public function getAll()
    {
       //muestra todos los usuarios
       $sede = DB::table('sedes') 
       ->join('ciudades','sedes.idciudad', '=', 'ciudades.id')
       ->whereNull('sedes.deleted_at')
       ->select(DB::raw('sedes.id as sedeid, sedes.nombresede,sedes.direccion as direccionsede, sedes.telefono as telefonosede,ciudades.nombreciudad as ciudadsede, ciudades.idciudad as ciudadid,ciudades.id as ciud'))
       ->orderBy('sedes.id', 'desc')
       ->get();
        return response() -> json([$sede], 200);
    }

    public function createSede(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombresede' => 'required',
                'direccion' => 'required',
                'ciudad' => 'required'
            ],['required' =>'El campo es obligatorio.']);

            $sede = Sede::create([
                'nombresede' => $request->nombresede,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'idciudad' => $request->ciudad
            ]);
            return response()->json([$sede], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSede( $id, Request $request)
    {
    
            $infoSede = Sede::find($id);
            $infoSede-> nombresede=$request->input('nombresede');
            $infoSede-> direccion=$request->input('direccion');
            $infoSede-> telefono=$request->input('telefono');
            $infoSede-> idciudad=$request->input('ciudad');
            $infoSede ->save();
            return response()->json([$infoSede], 201);
       
    }

    
    public function destroySede($id, Request $request)
    {
    
            $infoSede = Sede::destroy($id);
            $salas = Sala::where('sedeid',$id)->get();
            $infoSala= Sala::destroy($salas);
            
            return response()->json([$infoSede], 201);
   
    }

    
}
