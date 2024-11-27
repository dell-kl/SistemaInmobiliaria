<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
      <div class="modal-content">
        <div class="flex flex-row justify-between px-4 pt-4">
          <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Registro Propiedad</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="flex flex-row flex-wrap">
              @livewire('subida-archivo', ['tipoSubidaArchivo' => 'imagenes', 'widthProperty' => 'w-50', 'heightProperty' => 'h-full', 'mensaje' => 'Arrasta o Selecciona Imagenes del nuevo proyecto', 'subtitulo' => 'Carga Imagen Proyecto'])
              @livewire('tipo-campos-registro-propiedad')
              <div class="w-100">
                <h2 class="fw-bold ps-2 fs-4">Estructura y Videos del Proyecto</h2>
                <div class="flex flex-row">
                  @livewire('subida-archivo', ['tipoSubidaArchivo' => 'planos', 'widthProperty' => 'w-100', 'heightProperty' => 'h-3/4', 'mensaje' => 'Ingresa los planos del proyecto', 'subtitulo' => 'Carga Planos Proyecto'])
                  @livewire('subida-archivo', ['tipoSubidaArchivo' => 'videos', 'widthProperty' => 'w-100', 'heightProperty' => 'h-3/4', 'mensaje' => 'Arrasta o Suelta los videos del proyecto', 'subtitulo' => 'Carga Videos Proyecto'])
                </div>
              </div>
              <div class="w-100">
                @livewire('campos-ubicacion-propiedad')
              </div>
            </div>
            <input type="submit" class="btn btn-registrar text-white mt-4 fs-5 fw-300" value="👉 Registrar Propiedad">
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
</div>