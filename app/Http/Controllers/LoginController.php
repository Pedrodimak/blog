<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function index()
    {
        $email = request('email');
        $password = request('password');
        $user = User::where('email', $email)->firstOrFail();

        if (Hash::check($password, $user->password)) 
        {   
            //Guardamos por defecto el id del usuario en la sesion
            session(['key', $user->id]);
            session(['key' => $user->id]);
            //Redireccionamos a la vista
            return redirect()->route('logged.home-logged')->with('status', 'Ha ingresado en el blog');
        } 
        else {
            return back()->withErrors([
                'email' => 'Las credenciales no son correctas',
            ]);
        }
    }

}
