<div class="modal fade" id="administrarPropiedad-{{ $identificadorPropiedad }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
      <div class="modal-content">
        <div class="flex flex-row justify-between px-4 pt-4">
          <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Edicion Propiedad</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            {{-- Vamos a mostrar el catalogo de imagenes que se necesitan observar.  --}}
            <div class="galeria-imagenes-proyecto">
                <div class="secciones-proyecto d-flex flex-row gap-3 items-center">
                    @livewire('galeria-imagenes')
                    @livewire('tipo-campos-registro-propiedad', ['typeProjects' => $propiedad["obtener_tipo_propiedad"]["typeProperties_id"], 'datosPropiedad' => $propiedad])
                </div>
            </div>
            <div class="seccion-ubicacion d-flex flex-row gap-2 mt-4">
                @livewire('ubicacion-mapa', ['identificador' => "proyecto-".$propiedad["properties_id"], 'coordenadas' => $propiedad["obtener_coordenadas"][0]["coordinates_route"]])
                @livewire('campos-ubicacion-propiedad', ['datosPropiedad' => $propiedad, 'idCanton' => $propiedad["obtener_ubicacion"]["Parroquias_cantonsId"], 'idParroquia' => $propiedad["obtener_ubicacion"]["parroquias_id"]])
            </div>
            {{-- Vamos a generar la respectiva configuracion del carrusel de imagenes. --}}
            @livewire('carrusel-imagenes')

        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
</div>
