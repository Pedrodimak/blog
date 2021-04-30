<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('register');
    }

    public function store(CreateUserRequest $request)
    {
        if (User::create( $request->validated() ))
        {
            return redirect()->route('login')->with('status', 'Se ha registrado en el blog');
        }

        return back()->withErrors([
            'email' => 'Este Email ya ha sido registrado',
        ]);
    }

}
