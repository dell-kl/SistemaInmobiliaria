<div class="mapa w-100 {{ isset($coordenadas) ? '' : 'h-100' }} relative" style="cursor:pointer; height: 400px">
    <div id="{{$identificador}}" style="width:100%;height:100%;">
        <input type="hidden" wire:model.live="verificarCoordenadas" class="{{$identificador}}" value="{{ isset($coordenadas) ? $coordenadas : '' }}" name="ubicacionMapa" id="campoUbicacionMapa">
    </div>
</div>


