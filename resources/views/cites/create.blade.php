@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl font-bold logo">Crear Cita</h1>
    <hr class="my-4">

    <form action="{{ route('cites.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="Cites_propertiesId" class="form-label">Propiedad</label>
            <select class="form-control" name="Cites_propertiesId" id="Cites_propertiesId" required>
                @foreach($properties as $property)
                    <option value="{{ $property->properties_id }}">{{ $property->properties_address }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Nombre del Cliente</label>
            <input type="text" class="form-control" name="client_name" id="client_name" required>
        </div>
        <div class="mb-3">
            <label for="client_phone" class="form-label">Email del Cliente</label>
            <input type="text" class="form-control" name="client_email" id="client_email" required>
        </div>
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Fecha de Cita</label>
            <input type="date" class="form-control" name="appointment_date" id="appointment_date" required>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notas</label>
            <textarea class="form-control" name="notes" id="notes"></textarea>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comentarios</label>
            <textarea class="form-control" name="comments" id="comments"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection