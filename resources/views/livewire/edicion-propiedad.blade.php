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

                    @php
                        // Vamos a decir que solo vamos a tomar cinco imágenes para la parte previa de imágenes.
                        $imagenesGaleria = array_slice($propiedad["images"], 0, 5);
                    @endphp

                    @livewire('galeria-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'imagenes' => $imagenesGaleria])
                    @livewire('tipo-campos-registro-propiedad', ['typeProjects' => $propiedad["obtener_tipo_propiedad"]["typeProperties_id"], 'datosPropiedad' => $propiedad])

                    <div class="w-100 mt-4">
                        <label for="nuevasImagenes" class="form-label">Agregar nuevas imágenes</label>
                        <input class="form-control" type="file" id="nuevasImagenes" name="nuevasImagenes[]" multiple>
                    </div>

                    <div class="w-100 mt-4">
                        <label for="eliminarImagenes" class="form-label">Eliminar imágenes existentes</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($propiedad["images"] as $imagen)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $imagen['pictures_route']) }}" alt="Imagen de la propiedad" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                    <input type="checkbox" name="eliminarImagenes[]" value="{{ $imagen['pictures_id'] }}" class="position-absolute top-0 start-0 m-2">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning text-bold fs-6 w-100 mt-4 fw-bold">🗃️ Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>