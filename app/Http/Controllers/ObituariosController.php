<?php

namespace App\Http\Controllers;

use App\Models\Obituario;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ObituariosController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index($id)
    {
        $obituario = DB::table('obituarios') 
        ->join('sedes','obituarios.sedeid', '=', 'sedes.id')
        ->join('salas','obituarios.salaid', '=', 'salas.id')
        ->join('iglesias','obituarios.iglesiaid', '=', 'iglesias.id')
        ->join('cementerios','obituarios.cementerioid', '=', 'cementerios.id')
        ->join('ciudades','obituarios.idciudad','=','ciudades.id')
        ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
        ->where('departamentos.iddepartamento','=',$id)
        ->whereNull('obituarios.deleted_at')
        ->select(DB::raw('obituarios.id as idobituario,obituarios.nombre as nombreobituario,obituarios.apellidos as apellidosobituario,obituarios.mensaje as mensajeobituario, sedes.nombresede,sedes.id as sedeid, sedes.direccion as direccionsede,salas.nombresala,salas.id as salaid, iglesias.nombre as nombreiglesia,iglesias.id as iglesiaid,obituarios.horamisa,cementerios.nombre as nombrecementerio, cementerios.id as cementerioid, obituarios.horadestinofinal,obituarios.virtual,obituarios.fechaexequias,iglesias.idciudad as ciudadiglesia, obituarios.iniciopublicacion,obituarios.finpublicacion ,iglesias.direccion as direccioniglesias, cementerios.direccion as direccioncementerio, ciudades.nombreciudad as ciudadobituario,ciudades.idciudad as idciudad, ciudades.id as ciud'))
        ->get();
        return response() -> json([$obituario],200);
    }

    public function getAll()
    {
        $obituario = DB::table('obituarios') 
        ->join('sedes','obituarios.sedeid', '=', 'sedes.id')
        ->join('salas','obituarios.salaid', '=', 'salas.id')
        ->join('iglesias','obituarios.iglesiaid', '=', 'iglesias.id')
        ->join('cementerios','obituarios.cementerioid', '=', 'cementerios.id')
        ->join('ciudades','obituarios.idciudad','=','ciudades.id')
        ->whereNull('obituarios.deleted_at')
        ->select(DB::raw('obituarios.id as idobituario,obituarios.nombre as nombreobituario,obituarios.apellidos as apellidosobituario,obituarios.mensaje as mensajeobituario, sedes.nombresede,sedes.id as sedeid, sedes.direccion as direccionsede,salas.nombresala,salas.id as salaid, iglesias.nombre as nombreiglesia,iglesias.id as iglesiaid,obituarios.horamisa,cementerios.nombre as nombrecementerio, cementerios.id as cementerioid, obituarios.horadestinofinal,obituarios.virtual,obituarios.fechaexequias,iglesias.idciudad as ciudadiglesia, obituarios.iniciopublicacion,obituarios.finpublicacion ,iglesias.direccion as direccioniglesias, cementerios.direccion as direccioncementerio, ciudades.nombreciudad as ciudadobituario,ciudades.idciudad as idciudad, ciudades.id as ciud'))
        ->orderBy('obituarios.id', 'desc')
        ->get();
        return response() -> json([$obituario],200);
    }
    public function showObituariosHome(){
        $date = Carbon::now()->toDateString();

        $obituario = DB::table('obituarios') 
        ->join('sedes','obituarios.sedeid', '=', 'sedes.id')
        ->join('salas','obituarios.salaid', '=', 'salas.id')
        ->join('iglesias','obituarios.iglesiaid', '=', 'iglesias.id')
        ->join('cementerios','obituarios.cementerioid', '=', 'cementerios.id')
        ->join('ciudades','obituarios.idciudad','=','ciudades.id')
        ->where('obituarios.finpublicacion', '>=' , $date)
        ->whereNull('obituarios.deleted_at')      
        ->select(DB::raw('obituarios.id as idobituario,obituarios.nombre as nombreobituario,obituarios.apellidos as apellidosobituario,obituarios.mensaje as mensajeobituario, sedes.nombresede,sedes.id as sedeid, sedes.direccion as direccionsede,salas.nombresala,salas.id as salaid,salas.direccionip as direccionip, iglesias.nombre as nombreiglesia,iglesias.id as iglesiaid,obituarios.horamisa,cementerios.nombre as nombrecementerio, cementerios.id as cementerioid, obituarios.horadestinofinal,obituarios.virtual,obituarios.fechaexequias,iglesias.idciudad as ciudadiglesia, obituarios.iniciopublicacion,obituarios.finpublicacion ,iglesias.direccion as direccioniglesias, cementerios.direccion as direccioncementerio, ciudades.nombreciudad as ciudadobituario,ciudades.idciudad as idciudad, ciudades.id as ciud'))
        ->orderBy('obituarios.id', 'desc')
        ->get();
        return response() -> json([$obituario],200);
        }
    
    public function createObituario(Request $request)
    {
        if ($request -> isJson())
        {
            $this->validate($request, [
                'nombre' => 'required',
                'apellidos' => 'required',
                'ciudad' => 'required',
                'sedeid' => 'required',
                'salaid' => 'required',
                'iglesiaid' => 'required',
                'horamisa' => 'required',
                'cementerioid' => 'required',
                'fechaexequias' => 'required',
                'iniciopublicacion' => 'required',
                'finpublicacion' => 'required'
            ]);

            $obituario = Obituario::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'mensaje' => $request->mensaje,
                'idciudad' => $request->ciudad,
                'sedeid' => $request->sedeid,
                'salaid' => $request->salaid,
                'iglesiaid' => $request->iglesiaid,
                'horamisa' => $request->horamisa,
                'cementerioid' => $request->cementerioid,
                'horadestinofinal' => $request->horadestinofinal,
                'fechaexequias' => $request->fechaexequias,
                'virtual' =>$request->virtual ,
                'iniciopublicacion' => $request->iniciopublicacion,
                'finpublicacion' => $request->finpublicacion,
            ]);
            return response()->json($obituario, 201);
        }
        return response()->json(['Error' => 'No est?? autorizado'], 401, []);
    }


    public function updateObituario( $id, Request $request)
    {
    
            $infoObituario = Obituario::find($id);
            $infoObituario-> nombre=$request->input('nombre');
            $infoObituario-> apellidos=$request->input('apellidos');
            $infoObituario-> mensaje=$request->input('mensaje');
            $infoObituario-> idciudad=$request->input('ciudad');
            $infoObituario-> sedeid=$request->input('sedeid');
            $infoObituario-> salaid=$request->input('salaid');
            $infoObituario-> iglesiaid=$request->input('iglesiaid');
            $infoObituario-> horamisa=$request->input('horamisa');
            $infoObituario-> cementerioid=$request->input('cementerioid');
            $infoObituario-> horadestinofinal=$request->input('horadestinofinal');
            $infoObituario-> fechaexequias=$request->input('fechaexequias');
            $infoObituario-> virtual=$request->input('virtual');
            $infoObituario-> iniciopublicacion=$request->input('iniciopublicacion');
            $infoObituario-> finpublicacion=$request->input('finpublicacion');
            $infoObituario ->save();
            return response()->json([$infoObituario], 201);
       
    }

    
    public function destroyObituario($id, Request $request)
        {
            $infoObituario= Obituario::find($id);
            $infoObituario->delete();
            return response()->json('ok', 201);

    }

    
}
