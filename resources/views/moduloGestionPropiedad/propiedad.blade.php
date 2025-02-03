
@extends('layouts.app')

@section('title', 'Lista Propiedades')

@section('content')
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    <!-- Panel de bienvenida -->
    <div class="dashboard-welcome">

        @php
            $mensaje = "Bienvenido a tu panel de administrador general";
            $mensaje2 = "Puedes empezar haciendo una gestion de todos los procesos disponibles hasta el momento.";
            if ( $rolUsuario === "soporte_tecnico" ) {
                $mensaje = "Bienvenido a tu panel de soporte tecnico";
                $mensaje2 = "Puedes hacer una gestion y seguimiento de todos los usuarios con sus roles y permisos";
            }

            else if ( $rolUsuario === "agente_inmobiliaria" ) {
                $mensaje = "Bienvenido a tu panel de agente de inmobiliarias";
                $mensaje2 = "Aqui puedes administrar todas las propiedades que estan a tu cargo.";
            }
        @endphp

        <h2 class="text-4xl font-bold">{{ $mensaje }}</h2>
        <p class="text-lg mt-2">{{ $mensaje2 }}</p>
    </div>
    <div class="admin-panel-stats">
        <div class="admin-stat">
            <h4>Usuarios Activos</h4>
            <p>{{ $usuariosActivos }}</p>
        </div>
        <div class="admin-stat">
            <h4>Propiedades Disponibles</h4>
            <p>{{ $propiedadesDisponibles }}</p>
        </div>
        <div class="admin-stat">
            <h4>Instituciones Disponibles</h4>
            <p>{{ $institucionesDisponibles }}</p>
        </div>
    </div>

    @if ( $rolUsuario !== "soporte_tecnico" )
        <div class="w-full propiedades" style="background-color: #F2F2F2; border-radius: 5px;">
            <div class="m-auto pt-5">

                @if ( $rolUsuario !== "soporte_tecnico" && in_array(["authorizations_permissionId" => "1"], $permisos) )
                    <button
                        id="btnRegistrarPropiedad"
                        class="btn flex flex-row items-center gap-2 boton-panel d-flex"
                        type="button"
                        data-bs-toggle="modal"
                        style="background-color:#c09d22 !important;margin-left: 15px !important;"
                        data-bs-target="#staticBackdrop">
                        <img src="/icons/home.png" width="50"/>
                        Agregar Propiedad
                    </button>
                @endif



                <div class="m-auto propiedades-listado pt-4 flex flex-row flex-wrap justify-content-center gap-2 items-center pb-2">
                    @if (!empty($propiedades))
                        @foreach ($propiedades as $propiedad)
                            @php
                                $rutaImagen = !empty($propiedad["images"]) ? config('app.url') . '/storage/' . $propiedad["images"][0]["pictures_route"] : '/path/to/default/image.jpg';
                            @endphp
                            @livewire('propiedad', ['property' => $propiedad, 'rutaImagen' => $rutaImagen, 'rolUsuario' => $rolUsuario, 'permisos' => $permisos])
                        @endforeach
                    @endif
                </div>


                <div class="w-11/12 m-auto flex flex-row items-center justify-center gap-2 paginador py-4">
                    <a href="#" class="group">
                        <li class="active px-2 w-100 h-10 text-gray-800 grid place-items-center rounded-md border lg:border-2 border-green-700 group-hover:bg-green-700">
                        <span class="text-green-700 font-medium group-hover:text-slate-200">◀️ Retroceder</span>
                        </li>
                    </a>

                    <a href="#" class="group">
                        <li class="w-100 px-2 h-10 text-gray-800 grid place-items-center rounded-md border lg:border-2 border-red-700 group-hover:bg-red-700">
                        <span class="text-red-700 font-medium group-hover:text-slate-200">Continuar ▶️</span>
                        </li>
                    </a>
                </div>
            </div>

            @livewire('registro-propiedad')
        </div>
    @endif
@endsection

@push('scripts')

<script>
    document.getElementById('agregarPropiedadSeccion').addEventListener('click', (e) => {
        document.getElementById('btnRegistrarPropiedad').click();
    });
</script>

<!-- Scripts para Bootstrap 5
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
-->
@endpush

