@extends('head')

@section('title', 'Inicio de Sesión')

@section('content')

    <h1 align="Center">Formulario de Inicio de Sesión</h1>

    @if($errors->any())

    <ul align="center">
    @foreach($errors->all() as $error)

            <li>{{ $error }}</li>
            
    @endforeach
    </ul>

    @endif

    <form method="POST" action="{{ route('login.authenticate') }}" align="center">
        @csrf
        
        <label> 
            Introduzca su Email <br>
            <input type="email" name= "email" placeholder= "Email..." value="{{ old('email') }}" > 
            <br><br>
        </label>

        <label>
            Introduzca su Contraseña de Acceso <br>
            <input type="password" name="password" placeholder= "Contraseña..." value="{{ old('password') }}" > 
            <br><br>
        </label>

        <button> Iniciar Sesión </button>

    </form>

@endsection