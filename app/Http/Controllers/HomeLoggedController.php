<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeLoggedController extends Controller
{
    public function show()
    {
        return view('logged.home-logged', ['categories' => Category::all(), 'posts' => Post::all()]);
    }
}
