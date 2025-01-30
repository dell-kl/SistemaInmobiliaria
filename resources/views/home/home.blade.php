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
    <section class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide relative">
                <img src="{{ asset('images/property1.jpg') }}" alt="Propiedad 1" class="w-full h-[500px] object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white text-center">
                    <h2 class="text-5xl font-bold">Encuentra tu hogar ideal</h2>
                    <p class="text-xl mt-3">Las mejores propiedades seleccionadas para ti</p>
                    <button class="mt-6 bg-secondary hover:bg-secondary-dark text-white py-3 px-8 rounded-full text-lg font-semibold">
                        Ver Propiedades
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </section>

    <!-- 🔹 BARRA DE BÚSQUEDA -->
    <section class="container mx-auto mt-10 px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <option>Casa</option>
                        <option>Departamento</option>
                        <option>Terreno</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio Máximo</label>
                    <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                        Buscar
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
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300">
                    <img src="{{ isset($propiedad['properties_image']) ? asset('storage/' . $propiedad['properties_image']) : asset('images/default-property.jpg') }}" 
                         alt="{{ $propiedad['properties_name'] ?? 'Propiedad' }}"
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary">{{ $propiedad['properties_name'] ?? 'Nombre no disponible' }}</h3>
                        <p class="text-gray-600">{{ $propiedad['properties_description'] ?? 'Descripción no disponible' }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-secondary font-bold text-xl">${{ number_format($propiedad['properties_price'] ?? 0) }}</span>
                            <button type="button" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                                Ver Detalles
                            </button>
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
                delay: 5000,
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
