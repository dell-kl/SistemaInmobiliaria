<div class="mapa w-100 {{ isset($coordenadas) ? '' : 'h-100' }} relative" style="cursor:pointer; height: 400px">
    <div id="{{$identificador}}" style="width:100%;height:100%;">
        <input type="hidden" wire:change="verificarCoordenadas" wire:model.live="coordenadas" class="{{$identificador}}" value="{{ isset($coordenadas) ? $coordenadas : '' }}" name="ubicacionMapa" id="campoUbicacionMapa">
    </div>

    @script
    <script>
        console.log('...hol');

        let elementosMapa = document.querySelectorAll(".mapa");
        elementosMapa.forEach(element => {
            let input = element.children[0].children[0];
            input.addEventListener('input', (e) => {

            });
        });
    </script>
    @endscript
</div>


