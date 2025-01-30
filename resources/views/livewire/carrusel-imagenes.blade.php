<div class="carrusel-imagenes {{ $mostrar }}" id="carruselVista-{{$idPropiedad}}" style="position:fixed; z-index: 999; right: 0; left: 0; top: 0; bottom: 0;">

    <button
        wire:click="cerrarCarrusel"
        type="button"
        class="btn btn-warning boton-cerrar-carrusel fw-bold"
        style="position:absolute;right:23px;bottom:90%;border-radius:100%"
    >X</button>

    <main class="grid min-h-screen w-full place-content-center bg-gray-900">

        <nav aria-label="" class="mb-2">
            <ul class="pagination pagination-lg d-flex flex-row justify-content-center">
                <li class="page-item {{ $mostrarProyect == 'd-block' ? 'active' : ''}}" wire:click="verificarTipoRecurso(1)">
                    <span class="page-link">🏢Imagenes Proyecto</span>
                </li>
                <li class="page-item {{ $mostrarPlanos == 'd-block' ? 'active' : ''}}" wire:click="verificarTipoRecurso(2)">
                    <a class="page-link" href="#">🗺️ Imagenes Planos</a>
                </li>
                <li class="page-item {{ $mostrarVideos == 'd-block' ? 'active' : ''}}" wire:click="verificarTipoRecurso(3)">
                    <a class="page-link" href="#">📽️ Videos Proyecto</a>
                </li>
            </ul>
        </nav>

        <div class="imagenes-seccion d-flex flex-row gap-1 {{ $mostrarProyect }}">
            <button type="button" class="fs-3" wire:click.prevent="anterior">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M14.9991 19L9.83911 14C9.56672 13.7429 9.34974 13.433 9.20142 13.0891C9.0531 12.7452 8.97656 12.3745 8.97656 12C8.97656 11.6255 9.0531 11.2548 9.20142 10.9109C9.34974 10.567 9.56672 10.2571 9.83911 10L14.9991 5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>

            @if ( $tipoElemento === 1 )
                @php

                if ( $posicion == count($recursosPropiedad["images"]) )
                {
                    $posicion = count($recursosPropiedad["images"]) - 1 ;
                }

                //vamos a sacar la imagen en base a la posicion
                $imagen = $recursosPropiedad["images"][$posicion]["pictures_route"];
                $imagen = config('app.url') . '/storage/' . $imagen;

                @endphp
                <img
                class="border border-2 rounded-2"
                width="800"
                style="height: 550px"
                src="{{ $imagen }}">
            @endif

            <button type="button" class="fs-3" wire:click.prevent="siguiente">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>
        </div>

        <div class="planos-seccion d-flex flex-row gap-1 {{ $mostrarPlanos }}">
            <button type="button" class="fs-3" wire:click.prevent="anterior">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M14.9991 19L9.83911 14C9.56672 13.7429 9.34974 13.433 9.20142 13.0891C9.0531 12.7452 8.97656 12.3745 8.97656 12C8.97656 11.6255 9.0531 11.2548 9.20142 10.9109C9.34974 10.567 9.56672 10.2571 9.83911 10L14.9991 5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>

            @if ( $tipoElemento === 2 )
                @php

                if ( $posicion == count($recursosPropiedad["planos"]) )
                {
                    $posicion = count($recursosPropiedad["planos"]) - 1 ;
                }

                //vamos a sacar la imagen en base a la posicion
                $imagen = $recursosPropiedad["planos"][$posicion]["plans_route"];
                $imagen = config('app.url') . '/storage/' . $imagen;
                @endphp
                <img
                class="border border-2 rounded-2"
                width="800"
                style="height: 550px"
                src="{{ $imagen }}">
            @endif

            <button type="button" class="fs-3" wire:click.prevent="siguiente">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>
        </div>

        <div class="imagenes-seccion d-flex flex-row gap-1 {{ $mostrarVideos }}">
            <button type="button" class="fs-3" wire:click.prevent="anterior">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M14.9991 19L9.83911 14C9.56672 13.7429 9.34974 13.433 9.20142 13.0891C9.0531 12.7452 8.97656 12.3745 8.97656 12C8.97656 11.6255 9.0531 11.2548 9.20142 10.9109C9.34974 10.567 9.56672 10.2571 9.83911 10L14.9991 5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>

            @if ( $tipoElemento === 3 )
                @php
                    if ( $posicion == count($recursosPropiedad["videos"]) )
                    {
                        $posicion = count($recursosPropiedad["videos"]) - 1 ;
                    }

                    //vamos a sacar la imagen en base a la posicion
                    $codigoVideo = $recursosPropiedad["videos"][$posicion]["videos_route"];
                @endphp

                <iframe
                    width="800"
                    height="550"
                    src="https://www.youtube.com/embed/{{ $codigoVideo }}"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            @endif

            <button type="button" class="fs-3" wire:click.prevent="siguiente">
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>

                </svg>
            </button>
        </div>

    </main>

</div>
