<div class="seccionFormulario flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-7xl font-bold tracking-tight text-white">LJZC</h2>
        <p class="text-center font-ligther font-light text-3xl text-white">La inmobiliaria amigable del vecindario</p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <div
        class="tipo-sesion p-2 radius border-radius rounded-md"
        style="display:flex; justify-content: space-between; align-items: center; background-color: #877e7e69;">
        <div>
            <label for="Credenciales" class="text-white" style="text-transform: uppercase;">Credenciales</label>
            <input
                type="radio"
                id="Credenciales"
                name="TipoSesion"
                wire:click="verificarTipoAutenticacion('Credenciales')"
                style="width:20px; height: 17px;"
                value="credenciales"
                checked
            />
        </div>
        <div>
            <label for="QR" class="text-white" style="text-transform: uppercase;">Escaneo QR</label>
            <input
                wire:click="verificarTipoAutenticacion('QR')"
                type="radio"
                id="QR"
                name="TipoSesion"
                style="width:20px; height: 17px;"
                value="qr"
            />
        </div>
    </div>

    @if ( $tipoAutenticacion === "Credenciales")
        <form class="space-y-6" action="/auth" method="POST">
        @csrf
        <div>
            <label for="users_email" class="block font-medium text-white text-xl">Correo Electrónico</label>
            <div class="mt-2">
                <input
                    id="users_email"
                    name="email"
                    type="email"
                    wire:input="validarEntrada('email')"
                    wire:model.live="email"
                    placeholder="Ingresa tu correo electrónico"
                    autocomplete="email"
                    required class="ps-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>

            <div>
                @error('email')
                @php $permitirSesion = "denegado"; @endphp
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block font-medium text-white text-xl">Contraseña</label>
                <div class="text-sm">
                    <a href="/reset" class="font-semibold text-white" style="text-color:#8E1515;">Olvidaste tu contraseña?</a>
                </div>
            </div>
            <div class="mt-2">
                <input
                    id="password"
                    name="password"
                    type="password"
                    wire:input="validarEntrada('password')"
                    wire:model.live="password"
                    placeholder="Ingresa tu contraseña"
                    autocomplete="current-password"
                    required
                    class="ps-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>

            <div>
                @error('password')
                    @php $permitirSesion = "denegado"; @endphp
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
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

    @else
        <div class="mt-2">
            <img
            style="width: 100%; height: 100%;"
            src="{{ config('app.url') . '/obtener-qr'}}" />
        </div>
    @endif


    <script>
            document.addEventListener("DOMContentLoaded",  () => {
                window.Echo.channel('chanel-quijote').listen('UserAuthenticatedQRBroadcast', (e) => {
                    let respuesta = JSON.stringify(e);

                    if ( respuesta )
                    {
                        //despues de eso tenemos que consumir nuestro post para que recarge justamente la pagina.
                        let $ruta = `${window.location.origin}/authQR`;

                        //vamos a realizar el respectivo envio a un metodo post.
                        let form = document.createElement("form");
                        form.method = "post";
                        form.action = "/authQR";

                        let csrf = document.createElement("input");
                        csrf.type = "hidden";
                        csrf.name = "_token";
                        csrf.value = "{{ csrf_token() }}";

                        let input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "_verificador";
                        input.value = respuesta;
                        form.appendChild(input);
                        form.appendChild(csrf);

                        document.body.appendChild(form);

                        form.submit();
                    }
                })
            });

    </script>
</form>
    </div>
</div>
