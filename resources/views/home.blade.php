@extends('head')

@section('title', 'Home')

@section('content')
    <h1 align="Center">Bienvenidos al PapeBlog</h1>

    <a href="{{ route('login') }}">Iniciar Sesion</a>
    <br>
    <br>
    <a href="{{ route('register') }}">Registrarse</a>
    <br>
    <br>
    <h2>Tablon de Posts</h2>
    <h3>
    <ul>
        @forelse($posts as $post)
            <ul>
                    <u>Título del post: {{ $post->title }} </u><br>
                    
                    Categoría:<i> {{ $post->category->title }} </i><br>
                    
                    Descripción: <i>{{ $post->description }}</i> <br>
                <br>
                <br> 
                <br>  
            </ul>
        @empty
            <li>No hay proyectos para mostrar</li>
        @endforelse 
    </ul>
    </h3>       

@endsection