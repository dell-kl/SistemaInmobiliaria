
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="roles_name">Nombre</label>
            <input type="text" name="roles_name" class="form-control" value="{{ $role->roles_name }}" required>
        </div>
        <div class="form-group">
            <label for="roles_estado">Estado</label>
            <select name="roles_estado" class="form-control" required>
                <option value="1" {{ $role->roles_estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$role->roles_estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection