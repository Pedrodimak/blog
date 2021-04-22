<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\User;

class PostController extends Controller
{

/*------------Función que retorna a la vista de crear post -------*/
    public function create()
    {
        return view('post.create', ['post' => new Post]);
    }

/*------------Función que guarda un post y retorna a la página index-------*/
    public function store(CreatePostRequest $request)
    {
        Post::create( $request->validated() );

       return redirect()->route('logged.home-logged')->with('status', 'El proyecto fue creado con éxito.');
    }

/*------------Función que retorna a la vista de editar post -------*/
    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

/*------------Función que actualiza un post -------*/
    public function update(Post $post, CreatePostRequest $request)
    {
        $post->update( $request->validated());
        
        return redirect()->route('logged.home-logged')->with('status', 'El proyecto fue actualizado con éxito.');
    }

/*------------Función que elimina un post -------*/
    public function destroy(Post $post)
    {
        $post -> delete();

        return redirect()->route('logged.home-logged')->with('status', 'El proyecto fue eliminado con éxito');
    }
}
