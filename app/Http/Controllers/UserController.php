<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
