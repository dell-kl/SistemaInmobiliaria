
@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
    <h2 class="text-5xl font-bold mb-4">Crear Nuevo Usuario</h2>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="users_name" class="form-control" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
        </div>
        <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="users_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Cédula:</label>
            <input type="text" name="users_cedula" class="form-control" pattern="\d{10}" maxlength="10" title="Debe tener 10 caracteres numéricos" required>
        </div>
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" name="users_phone" class="form-control" pattern="\d{10}" maxlength="10" title="Debe tener 10 dígitos" required>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="users_password" class="form-control" minlength="6" title="La contraseña debe tener al menos 6 caracteres" required>
        </div>
        <div class="form-group">
            <label>Rol:</label>
            <select name="roles_id" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->roles_id }}">{{ $role->roles_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection