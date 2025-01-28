<!-- resources/views/moduloGestionPropiedad/propiedad.blade.php -->

@extends('layouts.app')

@section('title', 'Lista Propiedades')

@section('content')
    <!-- Panel de bienvenida -->
    <div class="dashboard-welcome">
        <h2 class="text-4xl font-bold">Bienvenido al Panel de Gestión de Propiedades</h2>
        <p class="text-lg mt-2">Aquí puedes administrar todas las propiedades de la plataforma.</p>
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

    <div class="w-full propiedades" style="background-color: #F2F2F2;">
        <div class="m-auto pt-5" style="width:85.5%;">
            <button id="btnRegistrarPropiedad" class="btn btn-warning flex flex-row items-center gap-2 boton-panel" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <img src="/icons/home.png" width="50"/>
                Agregar Propiedad
            </button>

            <div class="m-auto propiedades-listado pt-4 flex flex-row flex-wrap gap-2 items-center pb-2" style="width:85.5%;">
                @if (!empty($propiedades))
                    @foreach ($propiedades as $propiedad)
                        @php
                            $rutaImagen = !empty($propiedad["images"]) ? config('app.url') . '/storage/' . $propiedad["images"][0]["pictures_route"] : '/path/to/default/image.jpg';
                        @endphp
                        @livewire('propiedad', ['property' => $propiedad, 'rutaImagen' => $rutaImagen])
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{ Vite::asset('resources/js/loadMap.js') }}"></script>
@endpush