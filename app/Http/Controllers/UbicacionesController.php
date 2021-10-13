<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UbicacionesController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $ubicacion = Ubicacion::all();
        return response() -> json([$ubicacion], 200);
    }

    public function createUbicacion(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'Pais' => 'required',
                'Ciudad' => 'required',
                'Departamento' => 'required'
            ]);

            $ubicacion = Ubicacion::create([
                'Pais' => $request->Pais,
                'Ciudad' => $request->Ciudad,
                'Departamento' => $request->Departamento,
                'Direccion' => $request->Direccion
            ]);
            return response()->json([$ubicacion], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateUbicacion( $id, Request $request)
    {
    
            $infoUbicacion = Ubicacion::find($id);
            $infoUbicacion-> Pais=$request->input('Pais');
            $infoUbicacion-> Ciudad=$request->input('Ciudad');
            $infoUbicacion-> Departamento=$request->input('Departamento');
            $infoUbicacion-> Direccion=$request->input('Direccion');
            $infoUbicacion ->save();
            return response()->json([$infoUbicacion], 201);
       
    }

    
    public function destroyUbicacion($id, Request $request)
    {
    
            $infoUbicacion = Ubicacion::destroy($id);
            return response()->json([$infoUbicacion], 201);
       
    }

    
}
