<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inmobiliaria')</title>
    
    {{-- Estilos globales --}}
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/gestionInstituciones.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/gestionUsuarios.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/propiedades.css') }}">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.3.0/maptiler-sdk.css" rel="stylesheet" />

    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.3.0/maptiler-sdk.umd.js"></script>
    <script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>
    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>
<body>
    {{-- Header --}}
    @include('layouts.header')

    {{-- Contenido principal --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center mt-5 py-3 bg-light">
        <p>&copy; {{ date('Y') }} INMOBILIARIA LJZC. Todos los derechos reservados.</p>
    </footer>

    {{-- Scripts globales --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ Vite::asset('resources/js/loadMap.js') }}"></script>
<script src="{{ Vite::asset('resources/js/carruselVista.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts de Livewire --}}
    @livewireScripts

    {{-- Scripts adicionales --}}
    @stack('scripts')
</body>
</html>