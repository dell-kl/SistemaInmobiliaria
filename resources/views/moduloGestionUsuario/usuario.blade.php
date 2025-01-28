@extends('layouts.app')

@section('title', 'Módulo de Gestión de Usuarios')

@section('content')
    <h2 class="text-5xl font-bold mb-4">Módulo de Gestión de Usuarios</h2>
    <p>Bienvenido al módulo de gestión de usuarios. Aquí puedes administrar los usuarios de la plataforma.</p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-primary mt-3">Ir a la lista de usuarios</a>
@endsection
