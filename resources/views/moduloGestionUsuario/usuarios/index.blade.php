@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Título principal -->
    <h1 class="text-5xl font-bold logo">Gestión de Usuarios</h1>
    <hr class="my-4">

    <!-- Barra de búsqueda y botón de registro -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <form class="d-flex" method="GET" action="{{ route('usuarios.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar usuario por cédula...">
            <button type="submit" class="btn btn-buscar text-white">Buscar</button>
        </form>
        <a href="{{ route('usuarios.create') }}" class="btn btn-registrar text-white">
            <i class="fas fa-user-plus"></i> Registrar Usuario
        </a>
    </div>

    <!-- Tabla de usuarios -->
    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <table class="table table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cédula</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->users_id }}</td>
                        <td>{{ $user->users_name }}</td>
                        <td>{{ $user->users_email }}</td>
                        <td>{{ $user->users_cedula }}</td>
                        <td>{{ $user->users_phone }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $user->users_id) }}" class="btn btn-sm btn-gestionar">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('usuarios.edit', $user->users_id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('usuarios.destroy', $user->users_id) }}" method="POST" style="display:inline;">
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

    <!-- Mensaje si no hay usuarios -->
    @if($users->isEmpty())
        <p class="mensaje text-center">No hay usuarios registrados en el sistema.</p>
    @endif
</div>

<style>
    .btn-registrar {
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

    .btn-registrar:hover {
        background-color: var(--btn-hover-bg); /* Fondo verde más oscuro */
        transform: translateY(-2px);
    }

    .btn-gestionar {
        background-color: var(--btn-bg);
        color: white;
    }

    .btn-gestionar:hover {
        background-color: var(--btn-hover-bg);
        transform: translateY(-2px);
    }

    .btn-warning {
        background-color: #FBBF24;
        color: white;
    }

    .btn-warning:hover {
        background-color: #F59E0B;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #E53E3E;
        color: white;
    }

    .btn-danger:hover {
        background-color: #C53030;
        transform: translateY(-2px);
    }
</style>
@endsection