<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
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
        

            $this->validate($request, [
                'nombres' => 'required',
                'apellidos' => 'required',
                'username' => 'required|unique:users',
                'rolid' => 'required',
                'password' => 'required'
            ],['unique' => 'Nombre de usuario no disponible.',
               'required' =>'El campo es obligatorio.']);

            $user = User::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'api_token' => str_random(60),
                'estadoid'=>1
            ]);
            $user->roles()->attach($request->rolid);      
            
            return response()->json([$user], 201);
        }
        return response()->json(['Error' => 'No está autorizado'], 401, []);
    }


    public function updateUser($id, Request $request)
    {
        if ($request -> isJson())
        {
            $infoUser = User::find($id);
            $infoUser-> nombres=$request->input('nombres');
            $infoUser-> apellidos=$request->input('apellidos');
            $infoUser-> username=$request->input('username');
            $infoUser-> password = Hash::make($request->input('password'));
            $infoUser->save();
            return response()->json([$infoUser], 201);
        }
        return response()->json(['Error' => 'No está autorizado'],401);
    }

    
    public function destroyUser($id)
    {
       
            $infoUser = RoleUser::find($id);
            $infoUser->delete();
            $infoUser2 = User::find($id);
            $infoUser2-> estadoid=0;
            $infoUser2->save();
            return response()->json([$infoUser2], 201);
            
    
    }

    public function getToken (Request $request) //login
    {
        if ($request -> isJson())
        {
          try{
              $data = $request -> json() -> all();
              $user = User::where('username',$data['username'])->first();

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
