
@extends('logged.head-logged')

@section('title', 'Editar Usuario')

@section('content')
    

    @include('partials.validation-errors')

    <form method='POST' align="center" action="{{ route('logged.update-user') }}">
        
        @method ('PATCH')
        @csrf
        <h1>Formulario para Editar un Usuario</h1>
        <label>
            Nombre del Usuario <br>
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