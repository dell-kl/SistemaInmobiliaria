<div id="{{$tipoSubidaArchivo}}" class="{{$widthProperty}} seccion-archivo">
    <div class="bg-white {{ $heightProperty }}">
        <main class="container mx-auto max-w-screen-lg {{ $heightProperty }} {{ ($mostrarSubidaArchivos) ? "d-block" : "d-none"}}">
          <!-- file upload modal -->
          <article aria-label="File Upload Modal" class="relative {{ $heightProperty }} flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">

            @if ( !empty($imagenes) )
                @php
                    $respuestaValidacion = Validator::make([
                        'imagenes' => $imagenes
                    ], [
                        'imagenes' => 'required|array|max:10',
                        'imagenes.*' => 'image|mimes:jpeg,png,jpg'
                    ]);

                    if ( $respuestaValidacion->fails() )
                    {
                        // $this->addError('imagenes', 'Solo esta soportado mimes tipo jpeg,png,jpg. Permitido un maximo de 10 imagenes.');
                        $respuestaValidacion->errors()->add('imagenes', 'Solo esta soportado mimes tipo jpeg,png,jpg. Permitido un maximo de 10 imagenes.');
                        $imagenes = [];
                        $this->actualizarFormulario(false);
                    }
                    else {
                        if ( isset($respuestaValidacion) && $respuestaValidacion->errors()->has('imagenes'))
                            $respuestaValidacion->errors()->forget('imagenes');

                        $this->actualizarFormulario(true);
                    }
                @endphp
            @endif

            <!-- overlay -->
            <div
                id="overlay"
                class="overlay-{{ $tipoSubidaArchivo }} w-full {{ $heightProperty }} absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md {{(isset($respuestaValidacion) && $respuestaValidacion->errors()->has('imagenes')) ? "border border-danger" : ""}}">
              <i>
                <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                </svg>
              </i>
              <p class="text-lg text-blue-700">Arrasta o Selecciona Imagenes</p>
            </div>

            <!-- scroll area -->
            <section class="overflow-auto p-8 w-full {{ $heightProperty }} flex flex-col">
              <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                  <span>{{ $mensaje }}</span>
                </p>
                <input id="hidden-input-{{ $tipoSubidaArchivo }}"
                    type="file"
                    wire:model="imagenes"
                    x-ref="imagenesInput"
                    name="entrada_{{$tipoSubidaArchivo}}[]"
                    multiple
                    accept="image/*"
                    class="hidden Entradasubidaimagenes"
                />

                <button
                type="button"
                x-on:click="$refs.imagenesInput.click()"
                id="button-{{ $tipoSubidaArchivo }}"
                class="buttonSubidaArchivos buttonArchivo-{{ $tipoSubidaArchivo }} mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                  Seleccionar Archivos
                </button>

              </header>


               <div>
                    @if ( isset($respuestaValidacion) && $respuestaValidacion->errors()->has('imagenes'))
                        <span class="text-danger fw-bold">{{ $respuestaValidacion->errors()->first('imagenes') }}</span>
                    @endif
               </div>

              <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                {{ $subtitulo }}
              </h1>

              <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                    @if ( !empty($imagenes) )

                        @foreach ($imagenes as $imagen)
                            @php
                                $ruta;
                                try {
                                    $ruta = $imagen->temporaryUrl();
                                } catch (\Throwable $th) {
                                    $imagenes = [];
                                }
                            @endphp

                            @if ( isset($ruta) )
                                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24" id="blob:https://www.creative-tim.com/cf91ce8d-4dab-4c2d-b158-b1552e043501">
                                    <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                                        <img
                                        alt="imagen seleccionada proyecto"
                                        class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed"
                                        src="{{$ruta}}">

                                        <button
                                            type="button"
                                            x-on:click="$wire.borrarImagen('{{$imagen->getFilename()}}')"
                                            class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"></path>
                                            </svg>
                                        </button>

                                    </article>
                                </li>
                            @endif
                        @endforeach

                    @endif

                    @if ( empty($imagenes) )
                        <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
                            <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data">
                            <span class="text-small text-gray-500">No files selected</span>
                        </li>
                    @endif
                </ul>

            </section>
          </article>

        </main>

        <main class="container mx-auto max-w-screen-lg {{ $heightProperty }} {{ ($mostrarCarga) ? "d-block" : "d-none"}}">
            <div style="opacity: 0.1" class="spinner flex items-center justify-center w-full h-100 text-gray-900 dark:text-gray-100 dark:bg-gray-950">
                <div>
                    <h1 class="text-xl md:text-7xl font-bold flex items-center">L<svg stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 24 24" class="animate-spin" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM13.6695 15.9999H10.3295L8.95053 17.8969L9.5044 19.6031C10.2897 19.8607 11.1286 20 12 20C12.8714 20 13.7103 19.8607 14.4956 19.6031L15.0485 17.8969L13.6695 15.9999ZM5.29354 10.8719L4.00222 11.8095L4 12C4 13.7297 4.54894 15.3312 5.4821 16.6397L7.39254 16.6399L8.71453 14.8199L7.68654 11.6499L5.29354 10.8719ZM18.7055 10.8719L16.3125 11.6499L15.2845 14.8199L16.6065 16.6399L18.5179 16.6397C19.4511 15.3312 20 13.7297 20 12L19.997 11.81L18.7055 10.8719ZM12 9.536L9.656 11.238L10.552 14H13.447L14.343 11.238L12 9.536ZM14.2914 4.33299L12.9995 5.27293V7.78993L15.6935 9.74693L17.9325 9.01993L18.4867 7.3168C17.467 5.90685 15.9988 4.84254 14.2914 4.33299ZM9.70757 4.33329C8.00021 4.84307 6.53216 5.90762 5.51261 7.31778L6.06653 9.01993L8.30554 9.74693L10.9995 7.78993V5.27293L9.70757 4.33329Z">
                            </path>
                        </svg> ading . . .</h1>
                </div>
            </div>
        </main>
    </div>

        <style>
        .hasImage:hover section {
        background-color: rgba(5, 5, 5, 0.4);
        }
        .hasImage:hover button:hover {
        background: rgba(5, 5, 5, 0.45);
        }

        #overlay p,
        i {
        opacity: 0;
        }

        #overlay.draggedover {
        background-color: rgba(255, 255, 255, 0.7);
        }
        #overlay.draggedover p,
        #overlay.draggedover i {
        opacity: 1;
        }

        .group:hover .group-hover\:text-blue-800 {
        color: #2b6cb0;
        }
        </style>
</div>
