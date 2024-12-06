<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
      <div class="modal-content">
        <div class="flex flex-row justify-between px-4 pt-4">
          <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Registro Propiedad</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @php
               $numeracion = "1";
               $codificacion = base64_encode($numeracion);
            @endphp
            <div class="flex flex-row flex-wrap">

              @livewire('subida-archivo', ['identificador' => $codificacion,'tipoSubidaArchivo' => 'imagenes', 'widthProperty' => 'w-50', 'heightProperty' => 'h-full', 'mensaje' => 'Arrasta o Selecciona Imagenes del nuevo proyecto', 'subtitulo' => 'Carga Imagen Proyecto'])
              @livewire('tipo-campos-registro-propiedad')
              <div class="w-100">
                <h2 class="fw-bold ps-2 fs-4">Estructura y Videos del Proyecto</h2>
                <div class="flex flex-row">
                  @php
                    $numeracion = "2";
                    $codificacion = base64_encode($numeracion);
                  @endphp
                  @livewire('subida-archivo', ['identificador' => $codificacion, 'tipoSubidaArchivo' => 'planos', 'widthProperty' => 'w-100', 'heightProperty' => 'h-3/4', 'mensaje' => 'Ingresa los planos del proyecto', 'subtitulo' => 'Carga Planos Proyecto'])
                  @php
                    $numeracion = "3";
                    $codificacion = base64_encode($numeracion);
                  @endphp
                  @livewire('subida-archivo', ['identificador' => $codificacion, 'tipoSubidaArchivo' => 'videos', 'widthProperty' => 'w-100', 'heightProperty' => 'h-3/4', 'mensaje' => 'Arrasta o Suelta los videos del proyecto', 'subtitulo' => 'Carga Videos Proyecto'])
                  <script src="{{ Vite::asset('resources/js/cargaArchivo.js') }}"></script>
                </div>
              </div>
              <div class="w-100">
                <h2 class="fw-bold ps-2 fs-4">Ubicacion del Proyecto</h2>
                <div class="ubicacion-propiedad flex flex-row gap-2 mt-3">
                    <div class="mapa w-100" style="cursor:pointer;">
                        <div id="map" style="width:100%;height:100%;">
                        </div>
                        <script src="{{ Vite::asset('resources/js/loadMap.js') }}"></script>
                    </div>
                    @livewire('campos-ubicacion-propiedad')
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-registrar text-white mt-4 fs-5 fw-300" value="👉 Registrar Propiedad">
            <script src="{{ Vite::asset('resources/js/cargaArchivo.js') }}"></script>
        </div>
      </div>
    </div>
</div>
