@php
use App\Models\Property;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/propiedades.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.3.0/maptiler-sdk.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.3.0/maptiler-sdk.umd.js"></script>
    <script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

    <title>Lista Propiedades</title>
</head>
<body>
    @include('sweetalert::alert')

    <header class="flex flex-row justify-between px-4 pt-2 mb-2">
        <div class="flex flex-row items-baseline gap-2">
            <h1 class="logo font-bold text-5xl">LJZC</h1>
            <p class="mensaje text-2xl">Panel de gestion de propiedades</p>
        </div>
        <div class="flex flex-row items-center gap-2">
            <div class="logo-perfil p-2 rounded-full">
                <p class="inicial text-3xl px-2">A</p>
            </div>

            <li class="nav-item dropdown list-none">
                <a class="nav-link dropdown-toggle text-3xl" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                </a>
                <ul class="dropdown-menu list-none">
                  <li><a class="dropdown-item" href="#">Perfil</a></li>
                  <li><a class="dropdown-item" href="/logout">Cerrar Sesion</a></li>
                </ul>
              </li>
        </div>
    </header>


    <div class="w-full propiedades" style="background-color: #F2F2F2;">
        <div class="m-auto pt-5" style="width:85.5%;">
            <button id="btnRegistrarPropiedad" class="btn btn-warning flex flex-row items-center gap-2 boton-panel" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <img src="/icons/home.png" width="50"/>
                Agregar Propiedad
            </button>

            <div class="filtro pt-4">
                <div class="bg-white w-3/12 text-center fw-bold rounded-t-lg p-2 text-xl">Filtrar Propiedades</div>
                <div class="bg-white p-3 rounded-r-lg">
                    <div class="row">
                        <div class="col">
                            <select class="form-select border-2 border-black" aria-label="Default select example">
                                <option selected>Tipo</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select border-2 border-black" aria-label="Default select example">
                                <option selected>Caracteristica</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control border-2 border-black" placeholder="Escribe lo que deseas buscar"/>
                        </div>

                        <div class="col">
                            <input type="submit" class="btn btn-buscar text-white w-50"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-auto propiedades-listado pt-4 flex flex-row flex-wrap gap-2 items-center pb-2" style="width:85.5%;">


            @if ( !empty($propiedades) )

                @foreach ($propiedades as $propiedad)
                    @php
                        $rutaImagen = config('app.url') . '/storage/' . $propiedad["images"][0]["pictures_route"];
                    @endphp
                    @livewire('propiedad', ['property' => $propiedad, 'rutaImagen' => $rutaImagen, 'rolUsuario' => $rolUsuario])
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    {{-- Vamos a encontrar el identificador justamente de cada uno de los mapas.  --}}

    <script src="{{ Vite::asset('resources/js/loadMap.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/carruselVista.js') }}"></script>
    </body>
</html>
