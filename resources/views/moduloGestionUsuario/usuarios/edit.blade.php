
@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="user-management">
    <h2 class="user-management-header">Editar Usuario</h2>

    <form action="{{ route('usuarios.update', $user->users_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="users_name" value="{{ $user->users_name }}" class="form-control" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
        </div>
        <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="users_email" value="{{ $user->users_email }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Cédula:</label>
            <input type="text" name="users_cedula" value="{{ $user->users_cedula }}" class="form-control" pattern="\d{10}" maxlength="10" title="Debe tener 10 caracteres numéricos" required>
        </div>
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" name="users_phone" value="{{ $user->users_phone }}" class="form-control" pattern="\d{10}" maxlength="10" title="Debe tener 10 dígitos" required>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Actualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection