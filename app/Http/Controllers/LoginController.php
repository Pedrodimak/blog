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


    public function authenticate()
    {
        $email = request('email');
        $password = request('password');
        $user = User::where('email', $email)->firstOrFail();

        if (Hash::check($password, $user->password)) 
        { 
            session(['key' => $user->id]);
            return redirect()->route('logged.home-logged')->with('status', 'Ha ingresado en el blog');
        } 
        else {
            return back()->withErrors([
                'email' => 'Las credenciales no son correctas',
            ]);
        }
    }

    public function logout()
    {
        //$id = session('key');
        //Cache::forget($id);
        request()->session()->flush();
        Cache::flush();
        return redirect()->route('home');
    }

    public function edit(User $user)
    {
        return view('logged.edit-user', ['user' => $user]);
    }

    public function update()
    {
        $id = request()->session()->get('key');
        $user = User::findOrFail($id);
        
        $user->name = request()->name;
        $user->nickname = request()->nickname;
        $user->email = request()->email;
        $user->password = Hash::make(request()->password);
        

        $user->save();

        Cache::flush();

        return redirect()->route('logged.home-logged');
    }

}
