<div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700">
    <div class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
      <img
        src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80"
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
          Proyecto - <span>Departamento</span>
        </h6>
        <p>
            Desde <strong class="text-2xl">USD 1200</strong>
        </p>
      </div>

      <div class="detalles pt-1">
        <h3 class="fw-bold">Pomasqui</h3>
        <p class="fw-lighter">Batan y Eloy Alfaro</p>
      </div>
    </div>
    <div class="p-6 pt-3">
      <button
        class="btn-gestionar block w-full select-none rounded-lg py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button"
        data-ripple-light="true"
        data-bs-toggle="modal" data-bs-target="#administrarPropiedad-{{ $property->properties_id }}"
      >
        Administrar
      </button>
    </div>
    
    {{-- El componente va a tener un componente adicional que mostrar de manera mas desglosada
    la informacion de la propiedad (Terreno, Casa, Departamento) 
    --}}

    @livewire('edicion-propiedad', ['identificadorPropiedad' => $property->properties_id])
  </div>
  