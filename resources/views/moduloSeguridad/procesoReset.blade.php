<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/inicioSesion.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/headerStyle.css') }}">
    <title>Restablecimiento de contraseña</title>
</head>
<body>
    <div class="inicioSesion">

        <header class="bg-black flex flex-row items-center gap-2 justify-center absolute start-0 end-0">
            <img src="/icons/panel.png"/>
            <p class="text-white">Restablecimiento de contraseña</p>
        </header>

        @livewire('formulario-new-password', ['token' => $token])
    </div>

    @include('sweetalert::alert')
</body>
</html>
