<div class="modal fade" id="administrarPropiedad-{{ $identificadorPropiedad }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
        <div class="modal-content">

            <form method="post" action="/propiedades/actualizar" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="propiedadId" value="{{ $identificadorPropiedad }}">
                <div class="flex flex-row justify-between px-4 pt-4">
                    <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Edición Propiedad</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="seccion-ubicacion mt-4 d-flex flex-row flex-wrap gap-2">

                    {{-- @livewire('carrusel-imagenes', ['idPropiedad' => $propiedad["properties_id"]]); --}}
                    @php
                        // Vamos a decir que solo vamos a tomar cinco imágenes para la parte previa de imágenes.
                        $imagenesGaleria = array_slice($propiedad["images"], 0, 5);
                    @endphp

            <div class="m-4 d-flex gap-2 align-items-end">
                @livewire('galeria-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'imagenes' => $imagenesGaleria])
                @livewire('tipo-campos-registro-propiedad', ['typeProjects' => $propiedad["obtener_tipo_propiedad"]["typeProperties_id"], 'datosPropiedad' => $propiedad])
            </div>

            <div class="campos-adicionales mt-4 d-flex gap-2">
                @livewire('ubicacion-mapa', [
                    'identificador' => "proyecto-{{ $identificadorPropiedad }}",
                    'coordenadas' => $propiedad["obtener_coordenadas"][0]["coordinates_route"]
                ])
                @livewire('campos-ubicacion-propiedad')
            </div>


                    <button type="submit" class="btn btn-warning text-bold fs-6 w-100 mt-4 fw-bold">🗃️ Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
