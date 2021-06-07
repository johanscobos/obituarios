<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class OpcionController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los roles
        $opcion = Opcion::all();
        return response() -> json([$opcion], 200);
    }

    public function createOpcion(Request $request)
    {
        if ($request -> isJson())
        {

            $this->validate($request, [
                'tituloopcion' => 'required'
            ]);

            $opcion = Opcion::create([
                'tituloopcion' => $request->tituloopcion
            ]);
            return response()->json([$opcion], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateOpcion($id, Request $request)
    {
        if ($request -> isJson())
        {
            $infoOpcion = Opcion::find($id);
            $infoOpcion-> tituloopcion=$request->input('tituloopcion');
            $infoOpcion ->save();
            return response()->json([$infoOpcion], 201);
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }

    
    public function destroyOpcion( Request $request,$id)
    {
        
            $infoOpcion = Opcion::destroy($id);
            return response()->json([$infoOpcion], 201);
    
    }

}
