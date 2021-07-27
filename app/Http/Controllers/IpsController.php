<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class IpsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function index()
    {
       //muestra todos las ips
        $ip = Ip::all();
        return response() -> json([$ip], 200);
    }


    public function createIp(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'direccionip' => 'required',
               
            ]);

            $ip = Ip::create([
                'direccionip' => $request->direccionip,
                'usuario' => $request->usuario,
                'clave' => $request->clave
            ]);
            return response()->json([$ip], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSala( $id, Request $request)
    {
    
            $infoIp = Ip::find($id);
            $infoIp-> direccionip=$request->input('direccionip');
            $infoIp-> usuario=$request->input('usuario');
            $infoIp-> clave=$request->input('clave');
            $infoIp ->save();
            return response()->json([$infoSala], 201);
       
    }

    
    public function destroySala($id, Request $request)
    {
    
            $infoIp = Ip::destroy($id);
            return response()->json([$infoIp], 201);
       
    }

    
}


    //

