{{--
Ya no usaremos el codigo de bootstrap para mostrar el modal ... nosotros nos encargaremos hacerlo.
Para eso lo controlamos junto con el archivo RegistroPropiedad.php del livewire.
--}}
<div>
    <button
        id="btnRegistrarPropiedad"
        class="btn btn-warning ms-3 flex flex-row items-center gap-2 boton-panel d-flex"
        type="button"
        data-bs-toggle="modal"
        wire:click="setearMostrarPanel(true, 'map')"
        data-bs-target="#staticBackdrop">
        <img src="/icons/home.png" width="50"/>
        Agregar Propiedad
    </button>

    <div class="modal fade {{ ($mostrarPanel) ? "show d-block" : "" }}" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog bg-white">
          <div class="modal-content">
            <div class="alert alert-warning w-100 text-center fw-bold" role="alert">
                ⚠️ Debes cumplir con todos los campos requeridos para que se pueda habilitar el boton de registrar ⚠️
              </div>
            <div class="flex flex-row justify-between px-4 pt-4">
              <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Registro Propiedad</h1>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                wire:click="setearMostrarPanel(false)"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/propiedades/registrar" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="flex flex-row flex-wrap">

                      @livewire('subida-archivo', ['tipoSubidaArchivo' => 'imagenes', 'widthProperty' => 'w-50', 'heightProperty' => 'h-100', 'mensaje' => 'Arrasta o Selecciona Imagenes del nuevo proyecto', 'subtitulo' => 'Carga Imagen Proyecto'])
                      @livewire('tipo-campos-registro-propiedad', ['tipoFormulario' => 1])
                      <div class="w-100 mt-4">
                        <h2 class="fw-bold ps-2 fs-4">Planos y Localizacion Proyecto</h2>
                        <div class="flex flex-row" style="height: 45rem">

                            @livewire('subida-archivo', [ 'tipoSubidaArchivo' => 'planos', 'widthProperty' => 'w-50', 'heightProperty' => 'h-100', 'mensaje' => 'Ingresa los planos del proyecto', 'subtitulo' => 'Carga Planos Proyecto'])

                            <div class="ubicacion-propiedad flex flex-col gap-2 mt-3">
                                @livewire('ubicacion-mapa', ['identificador' => 'map'])
                                @livewire('campos-ubicacion-propiedad', ['tipoFormulario' => 1])
                            </div>

                          <script src="{{ Vite::asset('resources/js/cargaArchivo.js') }}"></script>
                        </div>
                      </div>
                    </div>

                    @if ( $autorizarRegistro )
                        <input type="submit" class="btn btn-warning text-white ms-2 mt-4 fs-5 fw-300" value="🏠 Registrar Propiedad">
                    @else
                        {{-- <button type="button" class="ms-2 mt-4 btn bg-gray-100" disabled>🚫 Registrar Propiedad</button> --}}
                    @endif

                    <script src="{{ Vite::asset('resources/js/cargaArchivo.js') }}"></script>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>
