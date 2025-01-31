<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Plusvalía</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>
        /* Colores personalizados */
        :root {
            --primary: #1E3A8A;  /* Azul fuerte */
            --secondary: #F59E0B; /* Amarillo vibrante */
            --background: #F3F4F6; /* Gris claro */
        }

        .bg-primary { background-color: var(--primary); }
        .bg-secondary { background-color: var(--secondary); }
        .text-primary { color: var(--primary); }
        .text-secondary { color: var(--secondary); }
        .hover\:bg-primary-dark:hover { background-color: #172554; }
        .hover\:bg-secondary-dark:hover { background-color: #D97706; }
    </style>
</head>
<body class="bg-background">

    <!-- 🔹 HEADER -->
    <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-primary">Sistema de Plusvalía</h1>
        <nav>
            <a href="{{ route('login') }}" class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full text-lg font-semibold">
                Iniciar Sesión
            </a>
        </nav>
    </header>

    <!-- 🔹 HERO CON CARRUSEL -->
    <section class="swiper mySwiper w-full h-[500px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide relative">
                <img src="{{ asset('image/imagenFondoHome.jpg') }}" alt="Propiedad 1" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white text-center">
                    <h2 class="text-5xl font-bold">Encuentra tu hogar ideal</h2>
                    <p class="text-xl mt-3">Las mejores propiedades seleccionadas para ti</p>
                   
                </div>
            </div>
            <div class="swiper-slide relative">
                <img src="{{ asset('image/casa2.jpg') }}" alt="Propiedad 2" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide relative">
                <img src="{{ asset('image/casa3.jpg') }}" alt="Propiedad 3" class="w-full h-full object-cover">
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </section>

    <!-- 🔹 FILTRO DE PROPIEDADES -->
    <section class="container mx-auto mt-10 px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo de Propiedad</label>
                    <select name="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <option value="">Todos</option>
                        <option value="1">Casa</option>
                        <option value="2">Departamento</option>
                        <option value="3">Terreno</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Número de Habitaciones</label>
                    <input type="number" name="habitaciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio Mínimo</label>
                    <input type="number" name="precio_min" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio Máximo</label>
                    <input type="number" name="precio_max" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- 🔹 LISTADO DE PROPIEDADES -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-primary mb-8 text-center">Propiedades Disponibles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($propiedades as $propiedad)
                @php
                    $rutaImagen = isset($propiedad["images"]) && count($propiedad["images"]) > 0
                        ? config('app.url') . '/storage/' . $propiedad["images"][0]["pictures_route"]
                        : asset('images/default-image.jpg');
                @endphp

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300">
                    <img src="{{$rutaImagen}}" alt="{{ $propiedad['properties_name'] ?? 'Propiedad' }}" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary">Proyecto - {{ $propiedad["obtener_tipo_propiedad"]["typeProperties_name"] }}</h3>
                        <p class="text-gray-600">{{ $propiedad['properties_description'] }}</p>
                        <p class="text-gray-600 text-sm pt-2">{{ $propiedad['properties_address'] }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-secondary font-bold text-xl">${{ number_format($propiedad['properties_price'] ?? 0) }}</span>
                            <div class="flex gap-2">
                                <button type="button" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                                    Ver Detalles
                                </button>
                                @if(isset($propiedad['properties_id']))
                                    <a href="{{ route('home.simularCredito', ['id' => $propiedad['properties_id']]) }}" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded">
                                        Simular Crédito
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 FOOTER -->
    <footer class="bg-primary text-white text-center py-6 mt-10">
        <p>&copy; 2024 Sistema de Plusvalía. Todos los derechos reservados.</p>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>
</html>