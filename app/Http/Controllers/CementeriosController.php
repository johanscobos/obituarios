<?php

namespace App\Http\Controllers;

use App\Models\Cementerio;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CementeriosController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los usuarios
       $cementerio = DB::table('cementerios') 
       ->join('ubicaciones','cementerios.ciudad', '=', 'ubicaciones.id')
       ->select(DB::raw('cementerios.id as cementerioid, cementerios.nombre as nombrecementerio,cementerios.direccion direccioncementerio,ubicaciones.ciudad as ciudadcementerio, ubicaciones.id  as ciudadid'))
       ->get();
        return response() -> json([$cementerio], 200);
    }

    public function createCementerio(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombre' => 'required',
                'direccion' => 'required',
                'ciudad' => 'required'
            ]);

            $cementerio = Cementerio::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad
            ]);
            return response()->json([$cementerio], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateCementerio( $id, Request $request)
    {
    
            $infoSede = Cementerio::find($id);
            $infoSede-> nombre=$request->input('nombre');
            $infoSede-> direccion=$request->input('direccion');
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
