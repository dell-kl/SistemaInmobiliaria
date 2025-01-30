
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Rol</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="roles_name">Nombre</label>
            <input type="text" name="roles_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="roles_estado">Estado</label>
            <select name="roles_estado" class="form-control" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection