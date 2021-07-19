<?php

namespace App\Http\Controllers;

use App\Models\Iglesia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class IglesiasController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los usuarios
        $iglesia = Iglesia::all();
        return response() -> json([$iglesia], 200);
    }

    public function createIglesia(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombre' => 'required',
                'direccion' => 'required',
                'ciudad' => 'required'
            ]);

            $iglesia = Iglesia::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad
            ]);
            return response()->json([$iglesia], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateIglesia( $id, Request $request)
    {
    
            $infoIglesia = Iglesia::find($id);
            $infoIglesia-> nombre=$request->input('nombre');
            $infoIglesia-> direccion=$request->input('direccion');
            $infoIglesia-> ciudad=$request->input('ciudad');
            $infoIglesia ->save();
            return response()->json([$infoIglesia], 201);
       
    }

    
    public function destroySede($id, Request $request)
    {
    
            $infoSede = Sede::destroy($id);
            return response()->json([$infoSede], 201);
       
    }

    
}
