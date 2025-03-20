@extends('layouts.layout2')

@section('title', 'Simulador de Crédito Hipotecario')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F8FAFC;
    }
    
    .swiper-pagination-bullet-active {
        background-color: #F59E0B !important;
    }
    
    .swiper-button-next, .swiper-button-prev {
        color: #F59E0B !important;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 30px;
        border-radius: 50%;
        transform: scale(0.5);
    }
    
    .property-card {
        transition: all 0.3s ease;
    }
    
    .property-card:hover {
        transform: translateY(-5px);
    }
    
    .property-feature {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .search-container {
        transform: translateY(-50%);
        z-index: 10;
    }
    
    .gradient-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
    }
    
    .header-sticky {
        position: sticky;
        top: 0;
        z-index: 50;
    }
    
    .pill-badge {
        background-color: rgba(245, 158, 11, 0.1);
        color: #F59E0B;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    input:focus, select:focus {
        border-color: #1E3A8A;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
    }
    
    .btn-primary {
        background-color: #1E3A8A;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #172554;
    }
    
    .btn-secondary {
        background-color: #F59E0B;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background-color: #D97706;
    }
    
    .filter-container {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-radius: 1rem;
    }
    
    /* Estilos específicos para el simulador */
    .simulator-header {
        background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
        padding: 2rem 0;
        border-radius: 0 0 2rem 2rem;
        margin-bottom: 4rem;
    }
    
    .simulator-card {
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }
    
    .simulator-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .input-group {
        margin-bottom: 1.5rem;
    }
    
    .input-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #1F2937;
    }
    
    .input-field {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .input-field:focus {
        border-color: #1E3A8A;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
        outline: none;
    }
    
    .result-card {
        border-left: 4px solid #F59E0B;
    }
    
    .result-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1E3A8A;
    }
    
    .result-label {
        font-size: 0.875rem;
        color: #6B7280;
    }
    
    .amortization-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .amortization-table th {
        background-color: #1E3A8A;
        color: white;
        padding: 0.75rem;
        text-align: center;
    }
    
    .amortization-table td {
        padding: 0.75rem;
        text-align: center;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .amortization-table tr:nth-child(even) {
        background-color: #F9FAFB;
    }
    
    .amortization-table tr:hover {
        background-color: #F3F4F6;
    }
</style>

<div class="simulator-header">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-white text-center mb-2">Simulador de Crédito Hipotecario</h1>
        <p class="text-white text-center text-lg opacity-90">Planifica tu futuro hogar con nuestro simulador financiero</p>
    </div>
</div>

<div class="container mx-auto px-4 pb-16">
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Formulario de Simulación -->
        <div class="simulator-card bg-white p-6">
            <div class="flex items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Datos del Préstamo</h2>
            </div>
            
            <form id="formSimulacion" class="space-y-4">
                <!-- Monto del Préstamo -->
                <div class="input-group">
                    <label for="monto" class="input-label">Monto del Préstamo</label>
                    <input type="number" 
                           id="monto" 
                           name="monto" 
                           value="{{ $propiedad->properties_price }}" 
                           class="input-field" 
                           readonly>
                </div>

                <!-- Institución Financiera -->
                <div class="input-group">
                    <label for="institucion" class="input-label">Institución Financiera</label>
                    <select id="institucion" name="institucion" class="input-field" onchange="actualizarInteres()">
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
                    <div class="input-group">
                        <label for="plazo" class="input-label">Plazo (años)</label>
                        <input type="number" id="plazo" name="plazo" min="1" max="30" value="20" class="input-field">
                    </div>
                    <div class="input-group">
                        <label for="interes" class="input-label">Tasa Anual (%)</label>
                        <input type="number" id="interes" name="interes" step="0.01" class="input-field" readonly>
                    </div>
                </div>

                <!-- Fecha y Frecuencia de Pago -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="fecha" class="input-label">Fecha de Inicio</label>
                        <input type="date" id="fecha" name="fecha" class="input-field">
                    </div>
                    <div class="input-group">
                        <label for="periodo" class="input-label">Frecuencia de Pago</label>
                        <select id="periodo" name="periodo" class="input-field">
                            <option value="mensual">Mensual</option>
                            <option value="quincenal">Quincenal</option>
                            <option value="semanal">Semanal</option>
                        </select>
                    </div>
                </div>

                <!-- Método de Amortización -->
                <div class="input-group">
                    <label for="metodo" class="input-label">Método de Amortización</label>
                    <select id="metodo" name="metodo" class="input-field">
                        <option value="frances">Sistema Francés (Cuota Fija)</option>
                        <option value="aleman">Sistema Alemán (Amortización Constante)</option>
                    </select>
                </div>

                <!-- Botón de Simulación -->
                <div class="pt-6">
                    <button type="button" onclick="simularPrestamo()" class="btn-primary w-full py-3 px-4 rounded-lg font-semibold flex items-center justify-center">
                        Calcular Simulación
                    </button>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <div class="space-y-8">
            <!-- Resumen de Simulación -->
            <div class="simulator-card bg-white p-6">
                <div class="flex items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Resumen de la Simulación</h2>
                </div>
                
                <div id="resumenSimulacion" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                        <p class="result-label">Pago Mensual</p>
                        <p class="result-value">$0.00</p>
                    </div>
                    <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                        <p class="result-label">Total a Pagar</p>
                        <p class="result-value">$0.00</p>
                    </div>
                    <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                        <p class="result-label">Total Intereses</p>
                        <p class="result-value">$0.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de Amortización -->
            <div class="simulator-card bg-white p-6">
                <div class="flex items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Tabla de Amortización</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <div id="amortizaciones" class="min-w-full">
                        <div class="text-center py-8 text-gray-500">
                            <p class="text-lg">Complete el formulario y haga clic en "Calcular Simulación"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Establecer la fecha actual en el campo de fecha
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer la fecha actual
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        document.getElementById('fecha').value = `${year}-${month}-${day}`;
        
        // Inicializar el interés
        actualizarInteres();
    });

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
        let metodo = document.getElementById('metodo').value;

        if (!monto || !plazo || !tasaAnual) {
            alert('Por favor, complete todos los campos');
            return;
        }

        let totalPagos;
        let periodoTexto;
        switch (periodo) {
            case 'mensual': 
                totalPagos = plazo * 12; 
                periodoTexto = 'Mensual';
                break;
            case 'quincenal': 
                totalPagos = plazo * 24; 
                periodoTexto = 'Quincenal';
                break;
            case 'semanal': 
                totalPagos = plazo * 52; 
                periodoTexto = 'Semanal';
                break;
        }

        let tasaPeriodica = (tasaAnual / 100) / (totalPagos / plazo);
        let cuota, totalPagar, totalIntereses;
        
        if (metodo === 'frances') {
            // Sistema Francés (cuota fija)
            cuota = monto * (tasaPeriodica * Math.pow(1 + tasaPeriodica, totalPagos)) / (Math.pow(1 + tasaPeriodica, totalPagos) - 1);
            totalPagar = cuota * totalPagos;
            totalIntereses = totalPagar - monto;
        } else {
            // Sistema Alemán (amortización constante)
            const amortizacionConstante = monto / totalPagos;
            let saldo = monto;
            let sumaCuotas = 0;
            
            for (let i = 0; i < totalPagos; i++) {
                let interes = saldo * tasaPeriodica;
                let cuotaPeriodo = amortizacionConstante + interes;
                sumaCuotas += cuotaPeriodo;
                saldo -= amortizacionConstante;
            }
            
            cuota = monto * tasaPeriodica + monto / totalPagos; // Primera cuota
            totalPagar = sumaCuotas;
            totalIntereses = totalPagar - monto;
        }
        
        document.getElementById('resumenSimulacion').innerHTML = `
            <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                <p class="result-label">Pago ${periodoTexto}</p>
                <p class="result-value">$${cuota.toFixed(2)}</p>
            </div>
            <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                <p class="result-label">Total a Pagar</p>
                <p class="result-value">$${totalPagar.toFixed(2)}</p>
            </div>
            <div class="result-card bg-gray-50 p-4 rounded-lg border-l-4">
                <p class="result-label">Total Intereses</p>
                <p class="result-value">$${totalIntereses.toFixed(2)}</p>
            </div>
        `;

        // Generar tabla de amortización
        let saldo = monto;
        let tablaHTML = `
            <table class="amortization-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cuota</th>
                        <th>Interés</th>
                        <th>Capital</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
        `;
        
        if (metodo === 'frances') {
            // Sistema Francés
            for (let i = 1; i <= totalPagos; i++) {
                let interes = saldo * tasaPeriodica;
                let capital = cuota - interes;
                saldo -= capital;
                
                if (saldo < 0.01) saldo = 0; // Evitar saldos negativos por aproximaciones
                
                tablaHTML += `
                    <tr>
                        <td>${i}</td>
                        <td>$${cuota.toFixed(2)}</td>
                        <td>$${interes.toFixed(2)}</td>
                        <td>$${capital.toFixed(2)}</td>
                        <td>$${Math.max(saldo, 0).toFixed(2)}</td>
                    </tr>
                `;
            }
        } else {
            // Sistema Alemán
            const amortizacionConstante = monto / totalPagos;
            
            for (let i = 1; i <= totalPagos; i++) {
                let interes = saldo * tasaPeriodica;
                let cuotaPeriodo = amortizacionConstante + interes;
                saldo -= amortizacionConstante;
                
                if (saldo < 0.01) saldo = 0; // Evitar saldos negativos por aproximaciones
                
                tablaHTML += `
                    <tr>
                        <td>${i}</td>
                        <td>$${cuotaPeriodo.toFixed(2)}</td>
                        <td>$${interes.toFixed(2)}</td>
                        <td>$${amortizacionConstante.toFixed(2)}</td>
                        <td>$${Math.max(saldo, 0).toFixed(2)}</td>
                    </tr>
                `;
            }
        }
        
        tablaHTML += '</tbody></table>';
        document.getElementById('amortizaciones').innerHTML = tablaHTML;
    }
</script>
@endsection