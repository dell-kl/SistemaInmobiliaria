<div class="informacion w-100">
    <p class="pb-2 text-gray-400 text-capitalize">Completa la informacion de localizacion del proyecto</p>

    <div class="flex flex-row flex-wrap gap-1 pb-2">
        <div class="form-floating flex-1">
            <select class="form-select @error('idCanton') border border-danger @enderror" wire:blur="validacionCampos('idCanton')" id="floatingSelect" name="IM_canton" aria-label="Floating label select example" wire:model.lazy="idCanton">
                <option selected value="0">-- Cantones Disponibles --</option>

                @if ( !empty($cantones) )
                    {{-- cuando se haya comprobado que existen cantones vamos a tener que recorrerlos --}}
                    @foreach ($cantones as $canton)
                        <option value="{{ $canton["cantons_id"] }}">{{ $canton["cantons_nombre"] }}</option>
                    @endforeach
                @endif

            </select>
            <label for="floatingSelect">Escoge el canton ubicado del proyecto</label>
            @error('idCanton') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="flex flex-row flex-wrap gap-1 pb-2">
        <div class="form-floating flex-1">
            <select name="ParroquiaProyecto" wire:blur="validacionCampos('idParroquia')" wire:model.lazy="idParroquia" class="form-select  @error('idParroquia') border border-danger @enderror" id="floatingSelect" aria-label="Floating label select example">
                <option selected value="0">-- Parroquias del Canton --</option>

                @if ( !empty($parroquias) )
                @foreach ($parroquias as $parroquia)

                    @if ( $parroquia["parroquias_id"] === $idParroquia)
                        <option value="{{ $parroquia["parroquias_id"] }}" selected>{{ $parroquia["parroquias_name"] }}</option>
                    @else
                        <option value="{{ $parroquia["parroquias_id"] }}">{{ $parroquia["parroquias_name"] }}</option>
                    @endif

                @endforeach
                @endif
            </select>
            <label for="floatingSelect">Escoge la parroquia del canton seleccionado</label>
            @error('idParroquia') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <p class="pb-2 text-gray-400 text-capitalize">Puedes dar una direccion descriptiva del proyecto <strong> Ejm: La pulida / Fernando Corral y Carlos Freiler </strong> </p>

    <div class="form-floating mb-3">
        <input type="text" wire:blur="validacionCampos('direccionPropiedad')" wire:model.lazy="direccionPropiedad" name="DireccionProyecto" value="{{ isset($datosPropiedad) ? $datosPropiedad["properties_address"] : "" }}" class="form-control w-100 @error('direccionPropiedad') border border-danger @enderror" id="floatingInput" placeholder="Ingresa sector propiedad">
        <label for="floatingInput">🗺️ Direccion de la propiedad</label>
        @error('direccionPropiedad') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>


