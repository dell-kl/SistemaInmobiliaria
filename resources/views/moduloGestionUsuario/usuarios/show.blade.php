@extends('layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-5">
    <h2 class="text-5xl font-bold mb-4">Detalles del Usuario</h2>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>ID:</strong> {{ $user->users_id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $user->users_name }}</li>
        <li class="list-group-item"><strong>Correo:</strong> {{ $user->users_email }}</li>
        <li class="list-group-item"><strong>Cédula:</strong> {{ $user->users_cedula }}</li>
        <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->users_phone }}</li>
    </ul>

    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<style>
    .list-group-item {
        background-color: white;
        color: var(--text-color);
        border: 1px solid #E2E8F0;
        padding: 15px;
        font-size: 1rem;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .btn-secondary {
        background-color: var(--btn-bg); /* Fondo verde suave */
        color: white;
        text-align: center;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        display: inline-block; /* Asegura que el botón se vea */
    }

    .btn-secondary:hover {
        background-color: var(--btn-hover-bg); /* Fondo verde más oscuro */
        transform: translateY(-2px);
    }
</style>
@endsection