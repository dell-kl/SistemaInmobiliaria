<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificacion Restauracion COntrasena</title>
</head>
<body>

    @if ( $tipo === "notificacion" )
        <h2>Revision de propiedad</h2>
        <p>
            Estimado <strong>{{ $usuario }}</strong> actualmente haz hecho una visita a una de las propiedades <strong>{{ $propiedadNombre }} / {{ $address }}</strong>
            , puedes comunicarte personalmente con el propietario con el siguiente numero : +593 0938858828
        </p>
    @else
        <h2>Proceso restauracion contrasena</h2>
        <p>Este es un mensaje enviado directamente desde la plataforma de Inmobiliaria LJZC.
            Por favor, haz clic en el siguiente enlace para restablecer tu contraseña: <a href="{{ config('app.url') . '/proceso-reseteo/' . $token }}">Restaurar contraseña</a></p>
    @endif

</body>
</html>
