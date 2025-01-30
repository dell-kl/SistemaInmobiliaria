<header>
    <!-- Header principal -->
    <div class="flex flex-row justify-between px-4 pt-2">
        <div class="flex flex-row items-baseline gap-2">
            <h1 class="logo font-bold text-5xl">LJZC</h1>
        </div>
        <div class="flex flex-row items-center gap-2">
            <div class="logo-perfil p-2 rounded-full bg-gray-200">
                <p class="inicial text-3xl px-2">A</p>
            </div>
            <li class="nav-item dropdown list-none">
                <a class="nav-link dropdown-toggle text-3xl" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <ul class="dropdown-menu list-none">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                </ul>
            </li>
        </div>
    </div>

    <!-- Barra de navegación secundaria -->
    <nav class="mt-4 bg-white shadow-sm">
        <div class="container mx-auto py-2">
            <ul class="flex justify-center space-x-6">
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-home text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Agregar Propiedad</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('usuarios.index') }}" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-users text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Gestión Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-user-shield text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Gestión Roles</span>
                    </a>
                </li>
                <li>
                <a href="{{ route('profiles.index') }}" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-cogs text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Gestión Perfiles</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('institutions.index') }}" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-building text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Gestión Instituciones</span>
                    </a>
                </li>
                <li>
                    <a href="/reportes" 
                        class="flex flex-col items-center p-3 rounded-xl bg-gray-100 hover:bg-blue-500 transition-all duration-300 group shadow-md border border-gray-200"
                        style="text-decoration: none;">
                        <i class="fas fa-chart-bar text-2xl mb-2 text-gray-600 group-hover:text-white"></i>
                        <span class="text-sm text-gray-700 group-hover:text-white">Reportes</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>