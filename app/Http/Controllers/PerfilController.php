<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PerfilController extends Controller
{
    public function index()
    {        
        return view('perfil.index');
    }

    public function updateNombre() {     	
    }
    public function updatePassword() {    	
    }
    public function updateEmail() {    	
    }
    public function updateOrganizacion() {    	
    }
}
