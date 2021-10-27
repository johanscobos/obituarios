<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CiudadesController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($id)
    {
        $ciudad = DB::table('ciudades')
                ->join('departamentos','ciudades.iddepartamento','=','departamentos.id')
                ->where('departamentos.iddepartamento',$id)
                ->select('ciudades.*')
                ->get();
        return response() -> json([$ciudad], 200);
    }
    
    public function getAll()
    {
        $ciudad = Ciudad::all();
        return response() -> json([$ciudad], 200);
    }
    
}
