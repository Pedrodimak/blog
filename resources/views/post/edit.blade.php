
@extends('logged.head-logged')

@section('title', 'Editar Post')

@section('content')
    <h4 align="Center"><a href=" {{ route('logged.logout')}}" >CERRAR SESION</a> </h4>

    @include('partials.validation-errors')

    <form method='POST' action="{{ route('post.update', $post) }}">
        
        @method ('PATCH')
        @csrf
        <label>
            Título del Post <br>
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
            <input type="text" name="category" value="{{ old('category',  $post->category) }}">
        </label>
        <br>
        <label>
            <input type="hidden" name="user_id" value="{{ $user->id }}"> 
        </label>
        <br>

        <button>{{ 'Actualizar' }}</button>
    
    </form>

@endsection