<?php

namespace App\Http\Controllers;

use App\Models\Obituario;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ObituariosController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index()
    {
       //muestra todos los usuarios
        $obituario = Obituario::all();
        return response() -> json([$obituario], 200);
    }

    public function createObituario(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'ciudad' => 'required',
                'sede' => 'required',
                'nombre' => 'required'
            ]);

            $obituario = Obituario::create([
                'ciudad' => $request->ciudad,
                'sede' => $request->sede,
                'mensaje' => $request->mensaje,
                'nombre' => $request->nombre
            ]);
            return response()->json([$obituario], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateObituario( $id, Request $request)
    {
    
            $infoObituario = Obituario::find($id);
            $infoObituario-> ciudad=$request->input('ciudad');
            $infoObituario-> sede=$request->input('sede');
            $infoObituario-> mensaje=$request->input('mensaje');
            $infoObituario-> nombre=$request->input('nombre');
            $infoObituario ->save();
            return response()->json([$infoObituario], 201);
       
    }

    
    public function destroyObituario($id, Request $request)
    {
    
            $infoObituario = Obituario::destroy($id);
            return response()->json([$infoObituario], 201);
       
    }

    
}
