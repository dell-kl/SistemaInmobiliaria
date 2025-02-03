@extends('layouts.layout2')

@section('title', 'Simulador de Crédito Hipotecario')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Encabezado -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-primary mb-2">Simulador de Crédito Hipotecario</h1>
            <p class="text-gray-600">Calcule sus pagos mensuales y plan de amortización</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Formulario de Simulación -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-6 text-primary">Datos del Préstamo</h2>
                <form id="formSimulacion" class="space-y-6">
                    <!-- Monto del Préstamo -->
                    <div>
                        <label for="monto" class="block text-sm font-medium text-gray-700 mb-1">Monto del Préstamo</label>
                        <input type="number" 
                               id="monto" 
                               name="monto" 
                               value="{{ $propiedad->properties_price }}" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" 
                               readonly>
                    </div>

                    <!-- Institución Financiera -->
                    <div>
                        <label for="institucion" class="block text-sm font-medium text-gray-700">Institución</label>
                        <select id="institucion" name="institucion" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" onchange="actualizarInteres()">
                            @foreach($instituciones as $institucion)
                                <option value="{{ $institucion->institutions_id }}" 
                                        data-interes="{{ $institucion->interests->first()->interests_rate ?? 0 }}">
                                    {{ $institucion->institutions_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Plazo e Interés -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="plazo" class="block text-sm font-medium text-gray-700 mb-1">Plazo (años)</label>
                            <input type="number" id="plazo" name="plazo" min="1" max="30" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="interes" class="block text-sm font-medium text-gray-700 mb-1">Tasa Anual (%)</label>
                            <input type="number" id="interes" name="interes" step="0.01" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" readonly>
                        </div>
                    </div>

                    <!-- Fecha y Frecuencia de Pago -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                            <input type="date" id="fecha" name="fecha" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="periodo" class="block text-sm font-medium text-gray-700 mb-1">Frecuencia de Pago</label>
                            <select id="periodo" name="periodo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="mensual">Mensual</option>
                                <option value="quincenal">Quincenal</option>
                                <option value="semanal">Semanal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Método de Amortización -->
                    <div>
                        <label for="metodo" class="block text-sm font-medium text-gray-700 mb-1">Método de Amortización</label>
                        <select id="metodo" name="metodo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="frances">Sistema Francés (Cuota Fija)</option>
                            <option value="aleman">Sistema Alemán (Amortización Constante)</option>
                        </select>
                    </div>

                    <!-- Botón de Simulación -->
                    <div class="pt-4">
                        <button type="button" onclick="simularPrestamo()" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105">
                            Calcular Simulación
                        </button>
                    </div>
                </form>
            </div>

            <!-- Resultados -->
            <div>
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-primary">Resumen de la Simulación</h2>
                    <div id="resumenSimulacion" class="space-y-4"></div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 overflow-x-auto">
                    <h2 class="text-xl font-semibold mb-4 text-primary">Tabla de Amortización</h2>
                    <div id="amortizaciones"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizarInteres() {
        const selectInstitucion = document.getElementById('institucion');
        const tasaInteres = selectInstitucion.options[selectInstitucion.selectedIndex].getAttribute('data-interes');
        document.getElementById('interes').value = parseFloat(tasaInteres).toFixed(2);
    }

    function simularPrestamo() {
        let monto = parseFloat(document.getElementById('monto').value);
        let plazo = parseInt(document.getElementById('plazo').value);
        let tasaAnual = parseFloat(document.getElementById('interes').value);
        let periodo = document.getElementById('periodo').value;

        if (!monto || !plazo || !tasaAnual) {
            alert('Por favor, complete todos los campos');
            return;
        }

        let totalPagos;
        switch (periodo) {
            case 'mensual': totalPagos = plazo * 12; break;
            case 'quincenal': totalPagos = plazo * 24; break;
            case 'semanal': totalPagos = plazo * 52; break;
        }

        let tasaPeriodica = (tasaAnual / 100) / (totalPagos / plazo);
        let cuota = monto * (tasaPeriodica * Math.pow(1 + tasaPeriodica, totalPagos)) / (Math.pow(1 + tasaPeriodica, totalPagos) - 1);
        
        document.getElementById('resumenSimulacion').innerHTML = `
            <p><strong>Pago ${periodo}:</strong> $${cuota.toFixed(2)}</p>
            <p><strong>Total a Pagar:</strong> $${(cuota * totalPagos).toFixed(2)}</p>
            <p><strong>Total Intereses:</strong> $${((cuota * totalPagos) - monto).toFixed(2)}</p>
        `;

        let saldo = monto;
        let tablaHTML = '<table class="min-w-full border"><tr><th>N°</th><th>Cuota</th><th>Interés</th><th>Capital</th><th>Saldo</th></tr>';
        for (let i = 1; i <= totalPagos; i++) {
            let interes = saldo * tasaPeriodica;
            let capital = cuota - interes;
            saldo -= capital;
            tablaHTML += `<tr><td>${i}</td><td>$${cuota.toFixed(2)}</td><td>$${interes.toFixed(2)}</td><td>$${capital.toFixed(2)}</td><td>$${Math.max(saldo, 0).toFixed(2)}</td></tr>`;
        }
        tablaHTML += '</table>';
        document.getElementById('amortizaciones').innerHTML = tablaHTML;
    }
</script>
@endsection
