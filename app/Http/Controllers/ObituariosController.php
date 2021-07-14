<?php

namespace App\Http\Controllers;

use App\Models\Obituario;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

    public function showObituariosHome(){
        $obituario = DB::table('obituarios') 
        ->join('sedes','obituarios.sedeid', '=', 'sedes.id')
        ->join('salas','obituarios.salaid', '=', 'salas.id')
        ->join('iglesias','obituarios.iglesiaid', '=', 'iglesias.id')
        ->join('cementerios','obituarios.cementerioid', '=', 'cementerios.id')
        ->join('ips','salas.ipid','=','ips.id')
        ->select(DB::raw('obituarios.id as idobituario,obituarios.nombre as nombreobituario,obituarios.apellidos as apellidosobituario,obituarios.mensaje as mensajeobituario, sedes.nombresede,sedes.id as sedeid, salas.nombresala,salas.id as salaid, iglesias.nombre as nombreiglesia,iglesias.id as iglesiaid,obituarios.horamisa,cementerios.nombre as nombrecementerio, cementerios.id as cementerioid, obituarios.horadestinofinal,obituarios.virtual,obituarios.fechaexequias,ips.direccionip,iglesias.ciudad as ciudadiglesia, obituarios.iniciopublicacion,obituarios.finpublicacion,salas.direccion as direccionsala,iglesias.direccion as direccioniglesias, cementerios.direccion as direccioncementerio'))
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
                'ciudadid' => 'required',
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
                'ciudadid' => $request->ciudadid,
                'sedeid' => $request->sedeid,
                'salaid' => $request->salaid,
                'iglesiaid' => $request->iglesiaid,
                'horamisa' => $request->horamisa,
                'cementerioid' => $request->cementerioid,
                'horadestinofinal' => $request->horadestinofinal,
                'fechaexequias' => $request->fechaexequias,
                'virtual' =>$request->virtual,
                'iniciopublicacion' => $request->iniciopublicacion,
                'finpublicacion' => $request->finpublicacion,
            ]);
            return response()->json($obituario, 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateObituario( $id, Request $request)
    {
    
            $infoObituario = Obituario::find($id);
            $infoObituario-> nombre=$request->input('nombre');
            $infoObituario-> apellidos=$request->input('apellidos');
            $infoObituario-> mensaje=$request->input('mensaje');
            $infoObituario-> ciudadid=$request->input('ciudadid');
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
    
            $infoObituario = Obituario::destroy($id);
            return response()->json([$infoObituario], 201);
       
    }

    
}
