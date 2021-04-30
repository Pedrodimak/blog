<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{

/*------------Función que retorna a la vista de crear post -------*/
    public function create()
    {
        return view('post.create', ['post' => new Post, 'categories' => Category::all()]);
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
        if( $post->user_id == session('key') )
        {
            return view('post.edit', ['post' => $post, 'categories' => Category::all()]);
        }
        else
        {

            echo "No eres el usuario indicado para editar este post";
        }
    }

/*------------Función que actualiza un post -------*/
    public function update(Post $post, CreatePostRequest $request)
    {
        if($post->user_id == session('key'))
        {
            $post->update( $request->validated() );
        
            return redirect()->route('logged.home-logged')->with('status', 'El proyecto fue actualizado con éxito.');
        }
        else
        {
            echo "No eres el usuario indicado para editar este post";
        }
    }

/*------------Función que elimina un post -------*/
    public function destroy(Post $post)
    {
        if($post->user_id == session('key'))
        {
            $post -> delete();

            return redirect()->route('logged.home-logged')->with('status', 'El proyecto fue eliminado con éxito');
        }
        else
        {
            echo "No eres el usuario indicado para eliminar este post";
        }

    }
}
