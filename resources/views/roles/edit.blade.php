
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>
    <form action="{{ route('roles.update', $role->roles_id) }}" method="POST">
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
        <div>
            <label for="roles_permisos">Permisos</label>
            <select class="form-select" id="roles_permisos" multiple aria-label="Multiple select example">
                <option selected disabled>Selecciona uno o mas permisos para el rol</option>


            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
