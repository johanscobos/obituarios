<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class RoleController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los roles
        $role = Role::all();
        return response() -> json([$role], 200);
    }

    public function createRole(Request $request)
    {
        if ($request -> isJson())
        {

            $this->validate($request, [
                'roleid' => 'required',
                'descripcion' => 'required'
            ]);

            $role = Role::create([
                'roleid' => $request->roleid,
                'descripcion' => $request->descripcion,
            ]);
            return response()->json([$role], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateRole($id, Request $request)
    {
        if ($request -> isJson())
        {
            $infoRole = Role::find($id);
            $infoRole-> roleid=$request->input('roleid');
            $infoRole-> descripcion=$request->input('descripcion');
            $infoRole ->save();
            return response()->json([$infoRole], 201);
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }

    
    public function destroyRole( Request $request,$id)
    {
        
            $infoRole = Role::destroy($id);
            return response()->json([$infoRole], 201);
    
    }

}
