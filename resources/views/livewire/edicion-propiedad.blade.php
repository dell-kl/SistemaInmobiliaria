<div class="modal fade" id="administrarPropiedad-{{ $identificadorPropiedad }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
      <div class="modal-content">

        <form method="post" action="/propiedades/actualizar" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="propiedadId" value="{{ $identificadorPropiedad }}">
            <div class="flex flex-row justify-between px-4 pt-4">
              <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Edicion Propiedad</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="seccion-ubicacion d-flex flex-row gap-2 mt-4">
                @if (!empty($propiedad["obtener_coordenadas"]))
                    @livewire('ubicacion-mapa', ['identificador' => "proyecto-".$propiedad["properties_id"], 'coordenadas' => $propiedad["obtener_coordenadas"][0]["coordinates_route"]])
                @else
                    @livewire('ubicacion-mapa', ['identificador' => "proyecto-".$propiedad["properties_id"], 'coordenadas' => ''])
                @endif
                @livewire('campos-ubicacion-propiedad', ['datosPropiedad' => $propiedad, 'idCanton' => $propiedad["obtener_ubicacion"]["Parroquias_cantonsId"], 'idParroquia' => $propiedad["obtener_ubicacion"]["parroquias_id"]])
            <div class="modal-body" style="position: unset;">

                @php
                //vamos a realizar una configuracion respectiva.
                $recursos = array(
                    "images" => $propiedad["images"],
                    "videos" => $propiedad["videos"],
                    "planos" => $propiedad["planos"]
                );

               @endphp

                @livewire('carrusel-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'recursosPropiedad' => $recursos])

                <div class="galeria-imagenes-proyecto">
                    <div class="secciones-proyecto d-flex flex-row gap-3 items-center">
                        @php
                            //vamos a decir que solo vamos a tomar cinco imagenes para la parte previa de imagenes.
                            $imagenesGaleria = array_slice($propiedad["images"], 0, 5);
                        @endphp

                        @livewire('galeria-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'imagenes' => $imagenesGaleria])
                        @livewire('tipo-campos-registro-propiedad', ['typeProjects' => $propiedad["obtener_tipo_propiedad"]["typeProperties_id"], 'datosPropiedad' => $propiedad])
                    </div>
                </div>
                <div class="seccion-ubicacion d-flex flex-row gap-2 mt-4">
                    @livewire('ubicacion-mapa', ['identificador' => "proyecto-".$propiedad["properties_id"], 'coordenadas' => $propiedad["obtener_coordenadas"][0]["coordinates_route"]])
                    @livewire('campos-ubicacion-propiedad', ['datosPropiedad' => $propiedad, 'idCanton' => $propiedad["obtener_ubicacion"]["Parroquias_cantonsId"], 'idParroquia' => $propiedad["obtener_ubicacion"]["parroquias_id"]])
                </div>

                <button type="submit" class="btn btn-warning text-bold fs-6 w-100 mt-4 fw-bold">🗃️ Actualizar</button>


            </div>
        </form>

      </div>
    </div>
</div>    