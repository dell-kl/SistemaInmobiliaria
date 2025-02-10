<div class="formularioRegistroPropiedad w-50">

    <h2 class="text-xl fw-bold">Tipo Proyecto</h2>
    <div class="col">
        <select name="tipoProyecto" class="form-select" aria-label="Default select example" wire:model.live="typeProjects">
            <option value="0" disabled>Selecciona tipo de proyecto</option>

            {{-- vamos a realizar una validacion que verifique por la parte del registro y la edicion. --}}
            <option value="1" id="registro-casa">
                🏠 Casa
            </option>
            <option value="2">
                🏢 Departamento
            </option>
            <option value="3" id="registro-terreno">
                🟫 Terreno
            </option>

        </select>
    </div>

    <div class="campos mt-2">

        @if (intval($typeProjects) === 1 || intval($typeProjects) === 2)
            <h3 class="fw-bold pt-2 pb-2">Datos Generales Proyecto</h3>

            <div class="flex flex-row flex-wrap gap-1">

                <div class="form-floating mb-3  flex-1">
                    <input type="number" wire:input="actualizarValidaciones" wire:model.live="habitaciones" name="numeroHabitaciones" value="{{ ( isset($datosPropiedad) ) ? $datosPropiedad['properties_rooms'] : '' }}" wire:key="1" class="form-control w-100  @error('habitaciones') border border-danger @enderror" id="floatingInput" placeholder="Inserta numero de habitaciones">
                    <label for="floatingInput">🛌 Numero Habitaciones</label>
                </div>

                <div class="form-floating mb-3  flex-1">
                    <input type="text" wire:input="actualizarValidaciones" wire:model.lazy="banos" name="numeroBanios" class="form-control w-100  @error('banos') border border-danger @enderror" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_bathrooms'] : '' }}" id="floatingInput" placeholder="Inserta numero de baños">
                    <label for="floatingInput">🚽 Numero Baños</label>
                    @error('banos')

                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                @if ( intval($typeProjects) === 1 )
                    <div class="form-floating mb-3 flex-1">
                        <input type="number" wire:input="actualizarValidaciones" wire:model.lazy="estacionamiento" name="numeroEstacionamiento" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_parking'] : '' }}" class="form-control w-100  @error('estacionamiento') border border-danger @enderror" placeholder="Inserta cuantos estacionamientos">
                        <label for="floatingInput">🚏 Numero Estacionamiento</label>

                    </div>
                @endif

            </div>

        @elseif(intval($typeProjects) === 0)
            <div class="alert alert-light mt-2" role="alert">
                Debes seleccionar un tipo de proyecto para continuar ...
            </div>
        @endif

        @if ( intval($typeProjects) !== 0 )
            <h3 class="fw-bold pt-2 pb-2">Medidas Proyecto</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="text" wire:input="actualizarValidaciones" wire:model.lazy="area" name="AreaProyecto" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_area'] : '' }}" class="form-control w-100" id="floatingInput" placeholder="Inserta el area del proyecto">
                    <label for="floatingInput">📏 Area Terreno</label>

                </div>

                @if (intval($typeProjects) !== 3 )
                    <div class="form-floating mb-3  flex-1">
                        <input type="text" wire:input="actualizarValidaciones" wire:model.lazy="altoProfundidad" name="AltoProyecto" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_height'] : '' }}" class="form-control w-100" id="floatingInput" placeholder="Inserta el alto de la casa o departamento">
                        <label for="floatingInput">📐 Alto Total</label>

                    </div>
                @else
                    <div class="form-floating mb-3  flex-1">
                        <input type="text" wire:input="actualizarValidaciones" wire:model.lazy="altoProfundidad" name="ProfundidadProyecto" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_height'] : '' }}" class="form-control  w-100" id="floatingInput" placeholder="Inserta la profundidad del terreno">
                        <label for="floatingInput">📐 Profundidad Terreno</label>

                    </div>
                @endif
            </div>

            @php
            // vamos agregar dentro de este punto la disponibilidad de nuestro proyecto
            $disponibilidad = isset($datosPropiedad) ? $datosPropiedad["properties_state"] : "";
            @endphp
            <h3 class="fw-bold pt-2 pb-2">Disponibilidad del proyecto</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating flex-1">
                    <select name="EstadoProyecto" wire:change="actualizarValidaciones" wire:model.lazy="disponibilidadProyecto" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                      <option selected>-- Disponibilidad --</option>
                      <option value="1" {{ $disponibilidad == "1" ? 'selected' : '' }}>Disponible</option>
                      <option value="2" {{ $disponibilidad == "2" ? 'selected' : '' }}>Reservado</option>
                      <option value="3" {{ $disponibilidad == "3" ? 'selected' : '' }}>No Disponible</option>
                    </select>
                    <label for="floatingSelect">Dale la disponibilidad al proyecto</label>

                </div>
            </div>

            <h3 class="fw-bold pt-3 pb-2">Datos Financieros</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="number" wire:input="actualizarValidaciones" wire:model.lazy="precioProyecto" name="PrecioProyecto" value="{{ isset($datosPropiedad) ? $datosPropiedad['properties_price'] : '' }}" class="form-control w-100" id="floatingInput" placeholder="Precio propuesto del proyecto">
                    <label for="floatingInput">💲💲 Ponle un precio al proyecto</label>

                </div>
            </div>

            <h3 class="fw-bold pt-0 pb-2">Descripcion</h3>
            <textarea id="message" wire:input="actualizarValidaciones" wire:model.lazy="descripcionProyecto" name="DescripcionProyecto" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresa una descripcion del proyecto...">{{ isset($datosPropiedad) ? $datosPropiedad["properties_description"] : "" }}</textarea>



            @php
                $codigosVideoYoutube = "";

                if ( isset($datosPropiedad) )
                {
                    foreach($datosPropiedad["videos"] as $key=>$video)
                    {
                        $codigosVideoYoutube .= $video["videos_route"];

                        if ( $key !== count($datosPropiedad["videos"]) - 1 )
                        {
                            $codigosVideoYoutube .= ",";
                        }
                    }
                }
            @endphp

            <h3 class="fw-bold pt-3 pb-2">Codigos videos cargados en youtube</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="text" wire:input="actualizarValidaciones" wire:model.lazy="codigosVideoYoutube" name="VideosProyecto" value="{{$codigosVideoYoutube}}" class="form-control w-100" id="floatingInput" placeholder="Videos del proyecto">
                    <label for="floatingInput">📽️ Codigos Videos Proyecto</label>

                </div>
            </div>
        @endif
    </div>
</div>
