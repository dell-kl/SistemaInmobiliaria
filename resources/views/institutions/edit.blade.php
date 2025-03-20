@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl font-bold logo">Editar Institución</h1>
    <hr class="my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('institutions.index') }}" class="btn btn-registrar text-black">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <form action="{{ route('institutions.update', $institution->institutions_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="institutions_name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="institutions_name" id="institutions_name" value="{{ $institution->institutions_name }}" required>
            </div>
            <div class="mb-3">
                <label for="institutions_terms" class="form-label">Términos</label>
                <input type="text" class="form-control" name="institutions_terms" id="institutions_terms" value="{{ $institution->institutions_terms }}" required>
            </div>
            <div class="mb-3">
                <label for="institutions_dateRegist" class="form-label">Fecha de Registro</label>
                <input type="date" class="form-control" name="institutions_dateRegist" id="institutions_dateRegist" value="{{ $institution->institutions_dateRegist }}" required>
            </div>
            <div class="mb-3">
                <label for="interests_rate" class="form-label">Tasa de Interés</label>
                <input type="number" step="0.01" class="form-control" name="interests_rate" id="interests_rate" value="{{ $institution->interests->first()->interests_rate ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection