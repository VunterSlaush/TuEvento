<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index()
    {
        $user = User::where('cedula',Auth::id())->first();
        return view('perfil.index',['user'=>$user]);
    }

    public function updateProfile(Request $request)
    {
      $user = User::where('cedula',$request->input('cedula'))->first();
      if($user)
      {
        $pass = $this->modifyPassIfNecesary($user, $request);
        $email = $this->modifyEmailIfNecesary($user, $request);
        $name = $this->modifyNameIfNecesary($user, $request);
        $org = $this->modifyOrgIfNecesary($user, $request);
        $user->save();
        return json_encode(['success' => true, 'pass' => $pass,
                            'email' => $email,
                            'name' => $name,
                            'org' => $org,
                            'user' => $user]);
      }
      else {
        return json_encode(['success' => false, 'msg'=>'usuario no existente']);
      }
    }


    private function modifyPassIfNecesary($user, $request)
    {
      $pass = $request->input('pass');
      $confirm = $request->input('confirm_pass');
      if($pass == $confirm)
      {
            $pass =   Hash::make($pass);
            if($pass == $user->password)
              return ['modify'=> false,'succes' => true];
            else
            {
              $user->password = $pass;
              return ['modify'=> true,'succes' => true];
              return
            }
      }
      else
      {
        return ['modify'=> false,'succes' => false, 'msg' => 'contraseñas diferentes!'];
      }

    }
    private function modifyEmailIfIsNecesary($user, $request)
    {
      $email = $request->input('email');
      if($email != $user->email)
      {
        $user->email = $email;
        return ['modify'=> true,'succes' => true]
      }
      else
      {
        return ['modify'=> false,'succes' => true];
      }
    }

    private function modifyNameIfIsNecesary($user, $request)
    {
      $nombre = $request->input('nombre');
      if($nombre != $user->nombre)
      {
        $user->nombre = $nombre;
        return ['modify'=> true,'succes' => true]
      }
      else
      {
        return ['modify'=> false,'succes' => true];
      }
    }
    private function modifyOrgIfIsNecesary($user, $request)
    {
      $organizacion = $request->input('org');
      if($organizacion != $user->organizacion)
      {
        $user->organizacion = $organizacion;
        return ['modify'=> true,'succes' => true]
      }
      else
      {
        return ['modify'=> false,'succes' => true];
      }
    }
}
