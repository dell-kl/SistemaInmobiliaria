
<div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700">

    <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
      <img
        widith="500"
        height="500"
        src="{{$rutaImagen}}"
        alt="ui/ux review check"
      />
      <div class="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>
      <button
        class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-red-500 transition-all hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button"
        data-ripple-dark="true"
      >
        <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            aria-hidden="true"
            class="h-6 w-6"
          >
          </svg>
        </span>
      </button>
    </div>
    <div class="p-6">
      <div class="mb-3 flex flex-col items-start justify-between">
        <h6 class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
          Proyecto - <span>{{ $property["obtener_tipo_propiedad"]["typeProperties_name"] }}</span>
        </h6>
        <p>
            Desde <strong class="text-2xl">USD {{ $property["properties_price"] }}</strong>
        </p>
      </div>

      <div class="detalles pt-1">
        <h3 class="fw-bold">{{ $property["obtener_ubicacion"]["parroquias_name"] }}, Quito</h3>
        <p class="fw-lighter">{{ $property["properties_address"] }}</p>
      </div>
    </div>
    <div class="p-6 pt-3">
      <button
        class="btn-gestionar block w-full select-none rounded-lg py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none boton-panel"
        type="button"
        id="proyecto-{{$property['properties_id']}}-btn"
        data-ripple-light="true"
        data-bs-toggle="modal" data-bs-target="#administrarPropiedad-{{ $property['properties_id'] }}"
        >
        Administrar
      </button>


      {{-- Validacion para los permisos que va tener cada rol asignado.  --}}
      @if ( $rolUsuario !== "soporte_tecnico")

      <a href="/propiedades/eliminar/{{$property['properties_id']}}" class="btn-eliminar block w-full select-none rounded-lg py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none boton-panel mt-2">Eliminar</a>
      @endif

    </div>

    {{-- El componente va a tener un componente adicional que mostrar de manera mas desglosada
    la informacion de la propiedad (Terreno, Casa, Departamento)
    --}}

    @livewire('edicion-propiedad', ['identificadorPropiedad' => $property["properties_id"], 'propiedad' => $property])
</div>
