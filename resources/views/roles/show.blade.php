
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Rol</h1>
    <p><strong>ID:</strong> {{ $role->id }}</p>
    <p><strong>Nombre:</strong> {{ $role->roles_name }}</p>
    <p><strong>Estado:</strong> {{ $role->roles_estado ? 'Activo' : 'Inactivo' }}</p>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection