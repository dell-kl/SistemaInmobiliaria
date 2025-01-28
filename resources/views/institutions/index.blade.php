
@extends('layouts.app')

@section('content')
<div class="institutions-container">
    <div class="institutions-header">
        <h1>Gestión de Instituciones Financieras</h1>
        <a href="{{ route('institutions.create') }}" class="btn btn-create">
            <i class="fas fa-plus-circle"></i> Nueva Institución
        </a>
    </div>

    <div class="institutions-search">
        <input type="text" placeholder="Buscar institución por nombre...">
        <button type="submit" class="btn btn-create">
            <i class="fas fa-search"></i> Buscar
        </button>   
    </div>

    @if($institutions->count() > 0)
        <div class="institutions-table">
            <table>
                <thead>
                    <tr>
                        <th>Nombre de la Institución</th>
                        <th>Tasa de Interés</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($institutions as $institution)
                        <tr>
                            <td>
                                <a href="{{ route('institutions.show', $institution->institutions_id) }}" class="institution-link">
                                    {{ $institution->institutions_name }}
                                </a>
                            </td>
                            <td>
                                <span class="interest-rate">
                                    {{ $institution->interests->first()->interests_rate ?? 'N/A' }}%
                                </span>
                            </td>
                            <td>
                                <span class="status-badge">
                                    Activo
                                </span>
                            </td>
                            <td class="actions">
                                <div class="btn-group">
                                    <a href="{{ route('institutions.edit', $institution->institutions_id) }}" 
                                       class="btn btn-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    
                                    <form action="{{ route('institutions.destroy', $institution->institutions_id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" 
                                                onclick="return confirm('¿Está seguro de eliminar esta institución?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="no-institutions">
            <i class="fas fa-building fa-3x mb-3"></i>
            <h3>No hay instituciones registradas</h3>
            <p>Comience creando una nueva institución financiera.</p>
            <a href="{{ route('institutions.create') }}" class="btn btn-create mt-3">
                <i class="fas fa-plus-circle"></i> Crear Primera Institución
            </a>
        </div>
    @endif

    @if($institutions->count() > 0 && method_exists($institutions, 'links'))
        <div class="pagination-container">
            {{ $institutions->links() }}
        </div>
    @endif
</div>

<!-- Agregar FontAwesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

<!-- Estilos adicionales específicos -->
@push('styles')
<style>
    .btn-group {
        display: flex;
        gap: 0.5rem;
    }

    .status-badge {
        background-color: var(--success-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
    }

    .institution-link {
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 500;
    }

    .institution-link:hover {
        text-decoration: underline;
    }

    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .actions {
        white-space: nowrap;
    }
</style>
@endpush