
@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container mt-5">
    <h2 class="text-5xl font-bold mb-4">Editar Perfil</h2>

    <form action="{{ route('profiles.update', $profile->profiles_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Usuario:</label>
            <select name="Profiles_usersId" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->users_id }}" {{ $profile->Profiles_usersId == $user->users_id ? 'selected' : '' }}>
                        {{ $user->users_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Rol:</label>
            <select name="Profiles_rolesId" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->roles_id }}" {{ $profile->Profiles_rolesId == $role->roles_id ? 'selected' : '' }}>
                        {{ $role->roles_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Estado:</label>
            <select name="profiles_state" class="form-control" required>
                <option value="1" {{ $profile->profiles_state ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$profile->profiles_state ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        @php
        @endphp
        <div class="form-group">
            <label>Permisos</label>
            <select name="permissions_id[]" multiple class="form-control" required>
                <option value="1" {{ in_array(['authorizations_permissionId' => "1"], $autorizacionesPerfil) ? "selected" : "" }}>CREAR</option>
                <option value="2" {{ in_array(['authorizations_permissionId' => "2"], $autorizacionesPerfil) ? "selected" : "" }}>ELIMINAR</option>
                <option value="3" {{ in_array(['authorizations_permissionId' => "3"], $autorizacionesPerfil) ? "selected" : "" }}>EDITAR</option>
                <option value="4" {{ in_array(['authorizations_permissionId' => "4"], $autorizacionesPerfil) ? "selected" : "" }}>VER</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('profiles.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
