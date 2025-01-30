
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Plusvalía')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">InmoPlus</div>
                <div class="space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-secondary">Inicio</a>
                    <a href="#" class="hover:text-secondary">Propiedades</a>
                    <a href="#" class="hover:text-secondary">Contacto</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">InmoPlus</h3>
                    <p class="text-gray-300">
                        Tu mejor opción para encontrar el hogar de tus sueños.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contacto</h3>
                    <p class="text-gray-300">
                        Email: info@inmoplus.com<br>
                        Teléfono: (123) 456-7890<br>
                        Dirección: Calle Principal #123
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-secondary">Facebook</a>
                        <a href="#" class="text-white hover:text-secondary">Instagram</a>
                        <a href="#" class="text-white hover:text-secondary">Twitter</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>