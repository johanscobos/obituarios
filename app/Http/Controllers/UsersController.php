<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UsersController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       //muestra todos los usuarios
        $user = User::all();
        return response() -> json([$user], 200);
    }

    public function createUser(Request $request)
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


    public function updateUser( Request $request,$id)
    {
    
            $infoUser = User::find($id);
            $infoUser ->save();
            return response()->json([$infoUser], 201);
       
    }

    
    public function destroyUser( Request $request,$id)
    {
    
            $infoUser = User::destroy($id);
            return response()->json([$infoUser], 201);
       
    }

    public function getToken (Request $request) //login
    {
        if ($request -> isJson())
        {
          try{
              $data = $request -> json() -> all();
              $user = User::where('user',$data['user'])->first();

              if ($user && Hash::check ($data['password'],$user->password)){
                  return response()->json($user,200);
              }else{
                  return response()->json(['Error' => 'No existe el usuario'],406);
              }
          }
          catch(ModelNotFoundException $e){
            return response()->json(['Error' => 'No contenido'],406);
          }
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }
}
