<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LogoutController extends Controller
{
    public function index()
    {
        request()->session()->flush();
        Cache::flush();
        
        return redirect()->route('home');
    }
}
