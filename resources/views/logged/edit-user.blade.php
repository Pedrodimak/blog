
@extends('logged.head-logged')

@section('title', 'Editar Usuario')

@section('content')
    <h1 align="Center">Editar Usuario</h1>

    @include('partials.validation-errors')

    <form method='POST' action="{{ route('logged.update-user') }}">
        
        @method ('PATCH')
        @csrf
        <label>
            Nombre del usuario <br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
        </label>
        <br>
        <br>
        <label>
            Nickname <br>
            <input type="text" name="nickname" value="{{ old('nickname',  $user->nickname) }}">
        </label>
        <br>
        <br>
        <label>
            Email <br>
            <input type="text" name="email" value="{{ old('email',  $user->email) }}">
        </label>
        <br>
        <br>
        <label>
            Contraseña de Acceso <br>
            <input type="password" name="password" placeholder= "Contraseña..." value="{{ old('password') }}" > 
            <br><br>
        </label>

        <button>{{ 'Actualizar' }}</button>
    
    </form>

@endsection