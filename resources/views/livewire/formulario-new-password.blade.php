<div class="seccionFormulario flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-7xl font-bold tracking-tight text-white">LJZC</h2>
        <p class="text-center font-ligther font-light text-3xl text-white">La inmobiliaria amigable del vecindario</p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <form class="space-y-6" action="/proceso-reseteo-bck" method="POST">
        @csrf
        <input type="hidden" name="token_generate_rst" value="{{ $token }}"/>
    <div>
        <label for="users_email" class="block font-medium text-white text-xl">Contraseña Nueva</label>
        <div class="mt-2">
            <input id="users_email" wire:blur="validacionCampos('password')" name="password" type="password" wire:model.live="password" placeholder="Ingresa una contraseña nueva" autocomplete="email" required class="ps-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
        </div>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>

            @php
                $permitirSesion = "denegado";
            @endphp
        @enderror
    </div>

    <div>
        <label for="users_email" class="block font-medium text-white text-xl">Confirmar Contraseña</label>
        <div class="mt-2">
            <input id="users_email" wire:blur="validacionCampos('password_confirmation')" name="password_confirmation" type="password" wire:model.live="password_confirmation" placeholder="Ingresa una contraseña nueva" autocomplete="email" required class="ps-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
        </div>
        @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>

            @php
                $permitirSesion = "denegado";
            @endphp
        @enderror
    </div>

    <div>
        @if ( $permitirSesion === "denegado")
            <button
                type="submit"
                disabled
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-xl font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" style="background-color:#867c7c;cursor:not-allowed">Iniciar Sesión</button>


        @else
                <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-xl font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" style="background-color:#833737;cursor:pointer">Iniciar Sesión</button>
        @endif

    </div>

    <div>
        <p class="text-white fw-bold text-center ">⚠️ Al completar el formulario puedes cerrar esta ventana, luego puedes volver a <a href="/login" class="fw-bold" style="color:rgb(212, 205, 18)">iniciar sesión</a></p>
    </div>
</form>
    </div>
</div>
