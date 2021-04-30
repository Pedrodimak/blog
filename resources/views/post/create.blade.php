@extends('logged.head-logged')

@section('title', 'Crear Post')

@section('content')
    <h4 align="Center"> <a href="{{route('logged.logout')}}" > CERRAR SESION </a> </h4>

    @include('partials.validation-errors')

    <form method='POST' align="Center" action="{{ route('post.store') }}">
        
        @csrf
        <h2> Formulario para Crear un Post </h2>
        <label>
            Titulo del Post <br>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </label>
        <br>
        <br>
        <label>
            Descripción <br>
            <textarea name="description">{{ old('description',  $post->description) }}</textarea>
        </label>
        <br>
        <br>
        <label>
            Categoría a la que pertenece <br>
                <select name="category_id">
                    <option value="0">Elige una opción</option>
                    @forelse( $categories as $category )
                    <option select value="{{$category->id}}">{{ $category->title }}</option>
                    @empty
                        <li>No hay categorias para mostrar</li>

                    @endforelse
                </select>
        </label>
        <br>
        <label>
            <input type="hidden" name="user_id" value="{{ $user->id }}"> 
        </label>
        <br>

        <button>{{ 'Guardar' }}</button>
    
    </form>

@endsection
