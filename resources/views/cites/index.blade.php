@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl font-bold logo">Gestión de Citas</h1>
    <hr class="my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('cites.create') }}" class="btn btn-registrar text-black">
            <i class="fas fa-plus"></i> Crear Cita
        </a>
    </div>

    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <table class="table table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    
                    <th>Propiedad</th>
                    <th>Fecha de Cita</th>
                    <th>Notas</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cites as $cite)
                    <tr>
                        <td>{{ $cite->cites_id }}</td>
                   
                        <td>{{ $cite->property->properties_address }}</td>
                        <td>{{ $cite->appointment_date }}</td>
                        <td>{{ $cite->notes }}</td>
                        <td>{{ $cite->comments }}</td>
                        <td>
                            <a href="{{ route('cites.edit', $cite->cites_id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection