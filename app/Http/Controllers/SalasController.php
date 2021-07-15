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
                'nombresala' => 'required',
                'sedeid' => 'required'                
            ]);

            $sala = Sala::create([
                'nombresala' => $request->nombresala,
                'sedeid' => $request->sedeid,
                'ipid' => $request->ipid
            ]);
            return response()->json([$sala], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateSala( $id, Request $request)
    {
    
            $infoSala = Sala::find($id);
            $infoSala-> nombresala=$request->input('nombresala');
            $infoSala-> sedeid=$request->input('sedeid');
            $infoSala-> ipid=$request->input('ipid');
            $infoSala ->save();
            return response()->json([$infoSala], 201);
       
    }

    
    public function destroySala($id, Request $request)
    {
    
            $infoSala = Sala::destroy($id);
            return response()->json([$infoSala], 201);
       
    }

    
}
