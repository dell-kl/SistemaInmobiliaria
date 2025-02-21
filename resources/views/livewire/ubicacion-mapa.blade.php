<div class="mapa w-100 {{ isset($coordenadas) ? '' : 'h-100' }} relative" style="cursor:pointer; height: 400px">
    <div id="{{$identificador}}" style="width:100%;height:100%;">
        <input type="hidden" wire:change="verificarCoordenadas" wire:model.live="coordenadas" class="{{$identificador}}" value="{{ isset($coordenadas) ? $coordenadas : '-0.20709181747843952,-78.49713964614253' }}" name="ubicacionMapa" id="campoUbicacionMapa">
    </div>
</div>


