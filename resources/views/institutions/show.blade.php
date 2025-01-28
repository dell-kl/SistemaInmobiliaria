
@extends('layouts.app')

@section('title', 'Detalles de la Institución')

@section('content')
    <div class="institution-details">
        <h1>{{ $institution->institutions_name }}</h1>
        <p><strong>Términos:</strong> {{ $institution->institutions_terms }}</p>
        <p><strong>Fecha de Registro:</strong> {{ $institution->institutions_dateRegist }}</p>
        <p><strong>Tasa de Interés:</strong> {{ $institution->interests->first()->interests_rate ?? 'N/A' }}%</p>
        
        <a href="{{ route('institutions.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection