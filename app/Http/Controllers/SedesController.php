<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

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
        $sede = Sede::all();
        return response() -> json([$sede], 200);
    }

    public function createSede(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'numero_sede' => 'required',
                'nombre' => 'required',
                'telefono' => 'required'
            ]);

            $sede = Sede::create([
                'numero_sede' => $request->numero_sede,
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono
            ]);
            return response()->json([$sede], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSede( $id, Request $request)
    {
    
            $infoSede = Sede::find($id);
            $infoSede-> numero_sede=$request->input('numero_sede');
            $infoSede-> nombre=$request->input('nombre');
            $infoSede-> direccion=$request->input('direccion');
            $infoSede-> telefono=$request->input('telefono');
            $infoSede ->save();
            return response()->json([$infoSede], 201);
       
    }

    
    public function destroySede($id, Request $request)
    {
    
            $infoSede = Sede::destroy($id);
            return response()->json([$infoSede], 201);
       
    }

    
}
