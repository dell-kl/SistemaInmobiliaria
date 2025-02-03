<div class="modal fade" id="administrarPropiedad-{{ $identificadorPropiedad }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
        <div class="modal-content">

            <form method="post" action="/propiedades/actualizar" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="propiedadId" value="{{ $identificadorPropiedad }}">
                <div class="flex flex-row justify-between px-4 pt-4">
                    <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Edición Propiedad</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    @php
                    //nos vamos a sacar cada uno de los datos.
                    $recursoPropiedad = [];

                    $recursoPropiedad["images"] = $propiedad["images"];
                    $recursoPropiedad["planos"] = $propiedad["planos"];
                    $recursoPropiedad["videos"] = $propiedad["videos"];
                    @endphp
                    
                    @livewire('carrusel-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'recursosPropiedad' => $recursoPropiedad]);

                    @php
                        // Vamos a decir que solo vamos a tomar cinco imágenes para la parte previa de imágenes.
                        $imagenesGaleria = array_slice($propiedad["images"], 0, 5);
                    @endphp

                    <div class="m-4 d-flex gap-2 align-items-start">
                        @livewire('galeria-imagenes', ['idPropiedad' => $propiedad["properties_id"], 'imagenes' => $imagenesGaleria])
                        @livewire('tipo-campos-registro-propiedad', ['typeProjects' => $propiedad["obtener_tipo_propiedad"]["typeProperties_id"], 'datosPropiedad' => $propiedad])
                    </div>

                    <div class="campos-adicionales m-4 d-flex gap-2" style="width: 100%">

                        <div class="mapa relative w-100">
                            <div id="proyecto-{{$propiedad["properties_id"]}}" style="width:100%;height:100%;">
                                <input type="hidden" class="proyecto-{{$propiedad["properties_id"]}}" value="{{$propiedad["obtener_coordenadas"][0]["coordinates_route"]}}" name="ubicacionMapa" id="campoUbicacionMapa">
                            </div>
                        </div>

                        @livewire('campos-ubicacion-propiedad', [
                            'direccionPropiedad' => $propiedad['properties_address'],
                            'idParroquia' => $propiedad['obtener_ubicacion']['parroquias_id'],
                            'idCanton' => '1'])
                    </div>

                    <button 
                    type="submit" 
                    class="btn btn-warning text-bold fs-6 m-4 fw-bold" 
                    style="width: 16%;"
                    >🗃️ Actualizar</button>

            </form>
        </div>
    </div>
</div>
