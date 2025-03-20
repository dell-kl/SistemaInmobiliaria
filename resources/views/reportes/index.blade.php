@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-5xl font-bold logo">Reportes</h1>
    <hr class="my-4">

    <!-- Sección de Estadísticas Generales -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Número de Perfiles</h5>
                    <div class="py-3">
                        <span class="display-4 font-weight-bold">{{ $numPerfiles }}</span>
                    </div>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, ($numPerfiles/100)*100) }}%" aria-valuenow="{{ $numPerfiles }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Número de Usuarios Activos</h5>
                    <div class="py-3">
                        <span class="display-4 font-weight-bold">{{ $numUsuariosActivos }}</span>
                    </div>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, ($numUsuariosActivos/100)*100) }}%" aria-valuenow="{{ $numUsuariosActivos }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Número de Propiedades</h5>
                    <div class="py-3">
                        <span class="display-4 font-weight-bold">{{ $numPropiedades }}</span>
                    </div>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ min(100, ($numPropiedades/100)*100) }}%" aria-valuenow="{{ $numPropiedades }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Gráficos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Distribución de Datos</h5>
                    <canvas id="distributionChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tipos de Propiedades</h5>
                    <canvas id="propertiesTypeChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Tipos de Propiedades -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Detalle de Tipos de Propiedades</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Gráfico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tiposPropiedades as $tipo)
                                <tr>
                                    <td>{{ $tipo->typeProperties_name }}</td>
                                    <td>
                                        @if($tipo->typeProperties_state)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td width="100">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $tipo->typeProperties_state ? '100%' : '0%' }}" aria-valuenow="{{ $tipo->typeProperties_state ? 100 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de distribución de datos
    var distributionCtx = document.getElementById('distributionChart').getContext('2d');
    var distributionChart = new Chart(distributionCtx, {
        type: 'pie',
        data: {
            labels: ['Perfiles', 'Usuarios Activos', 'Propiedades'],
            datasets: [{
                data: [{{ $numPerfiles }}, {{ $numUsuariosActivos }}, {{ $numPropiedades }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Distribución General'
                }
            }
        }
    });

    // Preparar datos para el gráfico de tipos de propiedades
    var tiposActivos = 0;
    var tiposInactivos = 0;

    @foreach($tiposPropiedades as $tipo)
        @if($tipo->typeProperties_state)
            tiposActivos++;
        @else
            tiposInactivos++;
        @endif
    @endforeach

    // Gráfico de tipos de propiedades
    var propertiesTypeCtx = document.getElementById('propertiesTypeChart').getContext('2d');
    var propertiesTypeChart = new Chart(propertiesTypeCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tipos Activos', 'Tipos Inactivos'],
            datasets: [{
                data: [tiposActivos, tiposInactivos],
                backgroundColor: [
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(231, 76, 60, 0.7)'
                ],
                borderColor: [
                    'rgba(46, 204, 113, 1)',
                    'rgba(231, 76, 60, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Estado de Tipos de Propiedades'
                }
            }
        }
    });
});
</script>
@endpush