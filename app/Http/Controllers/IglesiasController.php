<?php

namespace App\Http\Controllers;

use App\Models\Iglesia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class IglesiasController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($id)
    {
       //muestra todos los usuarios
       $iglesia = DB::table('iglesias') 
       ->join('ciudades','iglesias.idciudad', '=', 'ciudades.id')
       ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
       ->where('departamentos.iddepartamento',$id)
       ->whereNull('iglesias.deleted_at')
       ->select(DB::raw('iglesias.id as iglesiaid, iglesias.nombre as nombreiglesia,iglesias.direccion direccioniglesia,ciudades.nombreciudad as ciudadiglesia,ciudades.idciudad as ciudadid,ciudades.id as idci'))
       ->get();
        return response() -> json([$iglesia], 200);
    }

    public function getAll()
    {
       //muestra todos los usuarios
       $iglesia = DB::table('iglesias') 
       ->join('ciudades','iglesias.idciudad', '=', 'ciudades.id')
       ->whereNull('iglesias.deleted_at')
       ->select(DB::raw('iglesias.id as iglesiaid, iglesias.nombre as nombreiglesia,iglesias.direccion direccioniglesia,ciudades.nombreciudad as ciudadiglesia,ciudades.idciudad as ciudadid,ciudades.id as idci'))
       ->orderBy('iglesias.id', 'desc')
       ->get();
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
            ],['required' =>'El campo es obligatorio.']);

            $iglesia = Iglesia::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'idciudad' => $request->ciudad
            ]);
            return response()->json($iglesia, 201);
        }
        return response()->json(['Error' => 'No est?? autorizado'], 401, []);
    }


    public function updateIglesia( $id, Request $request)
    {
    
            $infoIglesia = Iglesia::find($id);
            $infoIglesia-> nombre=$request->input('nombre');
            $infoIglesia-> direccion=$request->input('direccion');
            $infoIglesia-> idciudad=$request->input('ciudad');
            $infoIglesia ->save();
            return response()->json([$infoIglesia], 201);
       
    }

    
    public function destroyIglesia($id, Request $request)
    {
            $infoIglesia= Iglesia::find($id);
            $infoIglesia->delete();
            return response()->json('ok', 201);
       
    }

    
}
