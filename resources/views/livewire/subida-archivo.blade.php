<div id="{{$tipoSubidaArchivo}}" class="{{$widthProperty}} seccion-archivo">
    <div class="bg-white {{ $heightProperty }}">
        <main class="container mx-auto max-w-screen-lg {{ $heightProperty }}">
          <!-- file upload modal -->
          <article aria-label="File Upload Modal" class="relative {{ $heightProperty }} flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">
            <!-- overlay -->
            <div id="overlay" class="overlay-{{ $tipoSubidaArchivo }} w-full {{ $heightProperty }} absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
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
                <input id="hidden-input-{{ $tipoSubidaArchivo }}" type="file" name="entrada_{{$tipoSubidaArchivo}}[]" multiple class="hidden" />
                <button type="button" id="button" class="buttonArchivo-{{ $tipoSubidaArchivo }} mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                  Seleccionar Archivos
                </button>
              </header>

              <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                {{ $subtitulo }}
              </h1>

              <ul id="gallery-{{ $tipoSubidaArchivo }}" class="flex flex-1 flex-wrap -m-1">
                <li id="empty-{{ $tipoSubidaArchivo }}" class="seccion-archivo-seleccion h-full w-full text-center flex flex-col items-center justify-center items-center">
                  <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                  <span class="text-small text-gray-500">No files selected</span>
                </li>
              </ul>
            </section>

          </article>
        </main>

    </div>


    <!-- plantilla usada para representar a la parte de los archivos que se suben. -->
    <template id="file-template-{{ $tipoSubidaArchivo }}">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
          <article tabindex="0" class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
            <img alt="upload preview" class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

            <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
              <h1 class="flex-1 group-hover:text-blue-800"></h1>
              <div class="flex">
                <span class="p-1 text-blue-800">
                  <i>
                    <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                    </svg>
                  </i>
                </span>
                <p class="p-1 size text-xs text-gray-700"></p>
                <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                  <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                  </svg>
                </button>
              </div>
            </section>
          </article>
        </li>
    </template>

    <!-- plantilla usada para representar a la parte de las imagenes que se suben. -->
    <template id="image-template-{{ $tipoSubidaArchivo }}">
        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
          <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
            <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

            <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
              <h1 class="flex-1"></h1>
              <div class="flex">
                <span class="p-1">
                  <i>
                    <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                    </svg>
                  </i>
                </span>

                <p class="p-1 size text-xs"></p>
                <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                  <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                  </svg>
                </button>
              </div>
            </section>
          </article>
        </li>
    </template>

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
