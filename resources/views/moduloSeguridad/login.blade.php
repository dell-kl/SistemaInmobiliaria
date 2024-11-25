<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/inicioSesion.css') }}">
    <title>Inicio Sesión</title>
</head>
<body>
    <div class="inicioSesion relaltive">
        <header class="bg-black flex flex-row items-center gap-2 justify-center absolute start-0 end-0">
            <img src="/icons/panel.png"/>
            <p class="text-white">Autenticate para seguir con tu panel de administracion asignado.</p>
        </header>
        @livewire('formulario-sesion')
    </div>

</body>
</html>