<?php

namespace App\Http\Controllers;

use App\Models\Sede;
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
    public function index()
    {
       //muestra todos los usuarios
       $sede = DB::table('sedes') 
       ->join('ubicaciones','sedes.ciudad', '=', 'ubicaciones.id')
       ->select(DB::raw('sedes.id as sedeid, sedes.nombresede,sedes.direccion as direccionsede, sedes.telefono as telefonosede,ubicaciones.ciudad as ciudadsede'))
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
                'direccion' => 'required'
            ]);

            $sede = Sede::create([
                'nombresede' => $request->nombresede,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'ciudad' => $request->ciudad
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
            $infoSede-> ciudad=$request->input('ciudad');
            $infoSede ->save();
            return response()->json([$infoSede], 201);
       
    }

    
    public function destroySede($id, Request $request)
    {
    
            $infoSede = Sede::destroy($id);
            return response()->json([$infoSede], 201);
       
    }

    
}
