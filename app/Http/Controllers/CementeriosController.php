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
    public function index($id)
    {
       //muestra todos los usuarios
       $cementerio = DB::table('cementerios') 
       ->join('ciudades','cementerios.idciudad', '=', 'ciudades.id')
       ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
       ->where('departamentos.iddepartamento',$id)
       ->whereNull('cementerios.deleted_at')
       ->select(DB::raw('cementerios.id as cementerioid, cementerios.nombre as nombrecementerio,cementerios.direccion direccioncementerio,ciudades.nombreciudad as ciudadcementerio, ciudades.idciudad  as ciudadid, ciudades.id as idci'))
       ->get();
        return response() -> json([$cementerio], 200);
    }

    public function getAll()
    {
       //muestra todos los usuarios
       $cementerio = DB::table('cementerios') 
       ->join('ciudades','cementerios.idciudad', '=', 'ciudades.id')
       ->whereNull('cementerios.deleted_at')
       ->select(DB::raw('cementerios.id as cementerioid, cementerios.nombre as nombrecementerio,cementerios.direccion direccioncementerio,ciudades.nombreciudad as ciudadcementerio, ciudades.idciudad  as ciudadid, ciudades.id as idci'))
       ->orderBy('cementerios.id', 'desc')
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
            ],['required' =>'El campo es obligatorio.']);

            $cementerio = Cementerio::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'idciudad' => $request->ciudad
            ]);
            return response()->json($cementerio, 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateCementerio( $id, Request $request)
    {
    
            $infoCementerio = Cementerio::find($id);
            $infoCementerio-> nombre=$request->input('nombre');
            $infoCementerio-> direccion=$request->input('direccion');
            $infoCementerio-> idciudad=$request->input('ciudad');
            $infoCementerio ->save();
            return response()->json([$infoCementerio], 201);
       
    }

    
    public function destroyCementerio($id, Request $request)
    {
        $infoCementerio= Cementerio::find($id);
        $infoCementerio->delete();
        return response()->json('ok', 201);
       
    }

    
}
