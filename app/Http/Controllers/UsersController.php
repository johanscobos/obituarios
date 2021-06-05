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
       /* $user = new User();
        $user -> name = 'Sebas';
        $user -> email = 'johanscobos@gmail.com';*/
        $user = User::all();
        return response() -> json([$user], 200);
    }

    public function createUser(Request $request)
    {
        if ($request -> isJson())
        {
            //$user = User::create($request->json()->all());
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
