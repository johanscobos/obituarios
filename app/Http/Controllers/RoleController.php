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
        $user = Role::all();
        return response() -> json([$user], 200);
    }

    public function createRole(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());

            $this->validate($request, [
                'nombres' => 'required',
                'apellidos' => 'required',
                'user' => 'required|unique:users',
                'rolid' => 'required',
                'password' => 'required'
            ]);

            $user = User::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'user' => $request->user,
                'rolid' => $request->rolid,
                'password' => Hash::make($request->password),
                'api_token' => str_random(60)
            ]);
            return response()->json([$user], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateRole( Request $request,$id)
    {
        if ($request -> isJson())
        {
            $infoUser = User::find($id);
            $infoUser ->save();
            return response()->json([$infoUser], 201);
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }

    
    public function destroyRole( Request $request,$id)
    {
        if ($request -> isJson())
        {
            $infoUser = User::destroy($id);
            return response()->json([$infoUser], 201);
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }

}
