<div class="h-screen w-screen flex justify-center w-50 items-center rounded" style="background-color:#e64d0012;">

    <div class="bg-slate-800 text-white rounded-lg w-full mx-5 md:w-[40rem]  space-y-6 p-10">
        <div id="galeriaImagenes-{{$idPropiedad}}" class="galeria-imagenes-proyecto pictures-first grid grid-cols-6 col-span-2   gap-2  cursor-pointer">

            @php
                $conteo = 0;
            @endphp

            @foreach ( $imagenes as $key=>$imagen )
                @php $ruta = config('app.url') . '/storage/' . $imagen["pictures_route"]; @endphp

                @if ( $conteo > 1 )

                    <div class=" overflow-hidden rounded-xl col-span-2 max-h-[10rem]">
                        <img class="h-full w-full object-cover "
                                src="{{$ruta}}"
                                alt="">
                    </div>

                @else
                    <div class=" overflow-hidden rounded-xl col-span-3 max-h-[14rem]">
                        <img class="h-full w-full object-cover "
                                src="{{$ruta}}"
                                alt="">
                    </div>
                @endif

                @php $conteo++; @endphp
            @endforeach
        </div>

    </div>
</div>

