
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Rol</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->roles_id }}</td>
                <td>{{ $role->roles_name }}</td>
                <td>{{ $role->roles_estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('roles.show', ['role' => $role->roles_id]) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('roles.edit', ['role' => $role->roles_id]) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('roles.destroy', ['role' => $role->roles_id]) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection