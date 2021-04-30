@extends('logged.head-logged')

@section('title', 'Home')

@section('content')
    <h1 align="Center">{{ $user->saludar() }}</h1>
    <h2 align="Center"><a href="{{ route('logged.edit-user')}}">Editar Usuario</h2>
    <h4 align="Center"><a href=" {{ route('logged.logout')}}" >CERRAR SESION</a> </h4>
    <h3><a href="{{ route('post.create') }}">Crear Post</a></h3>
   


    <h2>Tablon de Posts</h2>
    <h3>
        <ul>
            @forelse($posts as $post)
                <ul>
                    <u>Título del post: {{ $post->title }} </u><br>

                    Categoría: <i> {{ $post->category->title }} </i><br>

                    Descripción: <i>{{ $post->description }} </i> <br>
                    @if($user->id == $post->user_id)
                        <h9 align="Center"><a href=" {{ route('post.edit', $post)}}" >Editar</a> </h9>
                        <br>
                        <h9 align="Center"><a href=" {{ route('post.delete', $post)}}" >Eliminar</a> </h9>
                    @endif
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