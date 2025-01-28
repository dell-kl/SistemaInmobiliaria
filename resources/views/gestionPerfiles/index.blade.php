
@extends('layouts.app')

@section('title', 'Gestión de Perfiles')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl font-bold mb-4">Gestión de Perfiles</h1>
    <hr class="my-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $profile)
                <tr>
                    <td>{{ $profile->profiles_id }}</td>
                    <td>{{ $profile->user->users_name }}</td>
                    <td>{{ $profile->role->roles_name }}</td>
                    <td>{{ $profile->profiles_state ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <a href="{{ route('profiles.edit', $profile->profiles_id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('profiles.destroy', $profile->profiles_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection