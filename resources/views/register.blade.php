@extends('head')

@section('title', 'Registro')

@section('content')

    <h1 align="Center">Formulario de Registro</h1>

    @if($errors->any())

    <ul align="center">
    @foreach($errors->all() as $error)

            <li>{{ $error }}</li>
            
    @endforeach
    </ul>
    
    @endif

    <form method="POST" action="{{ route('register.store') }}" align="center">
    @csrf
        <label>
            Introduzca su Nombre Completo <br>
            <input type="text" name="name" placeholder= "Nombre..." value="{{ old('name') }}"> 
            <br><br>
        </label>

        <label>
            Introduzca su Nombre de Pila <br>
            <input type="text" name="nickname" placeholder= "Nickname..." value="{{ old('nickname') }}"> 
            <br><br>
        </label>

        <label> 
            Introduzca su Email <br>
            <input type="email" name= "email" placeholder= "Email..." value="{{ old('email') }}" > 
            <br><br>
        </label>

        <label>
            Introduzca una Contraseña de Acceso <br>
            <input type="password" name="password" placeholder= "Contraseña..." value="{{ old('password') }}" > 
            <br><br>
        </label>

        <button> Registrarse </button>

    </form>
    
@endsection