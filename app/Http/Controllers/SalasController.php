<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class SalasController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los usuarios
        $sala = Sala::all();
        return response() -> json([$sala], 200);
    }

    public function createSala(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombres_sala' => 'required',
                'telefono' => 'required',
                'password' => 'required'
            ]);

            $sala = Sala::create([
                'nombres_sala' => $request->nombres_sala,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'password' => $request->password
            ]);
            return response()->json([$sala], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSala( $id, Request $request)
    {
    
            $infoSala = Sala::find($id);
            $infoSala-> nombres_sala=$request->input('nombres_sala');
            $infoSala-> direccion=$request->input('direccion');
            $infoSala-> telefono=$request->input('telefono');
            $infoSala-> password=$request->input('password');
            $infoSala ->save();
            return response()->json([$infoSala], 201);
       
    }

    
    public function destroySala($id, Request $request)
    {
    
            $infoSala = Sala::destroy($id);
            return response()->json([$infoSala], 201);
       
    }

    
}
