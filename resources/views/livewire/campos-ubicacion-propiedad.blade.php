<div class="informacion w-100">
    <p class="pb-2 text-gray-400 text-capitalize">Completa la informacion de localizacion del proyecto</p>

    <div class="flex flex-row flex-wrap gap-1 pb-2">
        <div class="form-floating flex-1">
            <select class="form-select" id="floatingSelect" name="IM_canton" aria-label="Floating label select example" wire:model.live="idCanton">
                <option selected value="0" disabled>-- Cantones Disponibles --</option>

                @if ( !empty($cantones) )
                    {{-- cuando se haya comprobado que existen cantones vamos a tener que recorrerlos --}}
                    @foreach ($cantones as $canton)
                        <option value="{{ $canton->cantons_id }}">{{ $canton->cantons_nombre }}</option>
                    @endforeach
                @endif

            </select>
            <label for="floatingSelect">Escoge el canton ubicado del proyecto</label>
        </div>
    </div>

    <div class="flex flex-row flex-wrap gap-1 pb-2">
        <div class="form-floating flex-1">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected value="0" disabled>-- Parroquias del Canton --</option>

                @if ( !empty($parroquias) )
                @foreach ($parroquias as $parroquia)
                    <option value="{{ $parroquia["parroquias_id"] }}">{{ $parroquia["parroquias_name"] }}</option>
                @endforeach
                @endif
            </select>
            <label for="floatingSelect">Escoge la parroquia del canton seleccionado</label>
        </div>
    </div>

    <p class="pb-2 text-gray-400 text-capitalize">Puedes dar una direccion descriptiva del proyecto <strong> Ejm: La pulida / Fernando Corral y Carlos Freiler </strong> </p>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="Ingresa sector propiedad">
        <label for="floatingInput">🗺️ Direccion de la propiedad</label>
    </div>
</div>


