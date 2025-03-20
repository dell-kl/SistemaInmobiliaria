<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Plusvalía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/config.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/tailwaind.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/home.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A',
                        'primary-dark': '#172554',
                        secondary: '#F59E0B',
                        'secondary-dark': '#D97706',
                        'background': '#F8FAFC'
                    },
                    boxShadow: {
                        'property': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        'nav': '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
        }
        
        .swiper-pagination-bullet-active {
            background-color: #F59E0B !important;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: #F59E0B !important;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 50%;
            transform: scale(0.5);
        }
        
        .property-card {
            transition: all 0.3s ease;
        }
        
        .property-card:hover {
            transform: translateY(-5px);
        }
        
        .property-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .search-container {
            transform: translateY(-50%);
            z-index: 10;
        }
        
        .gradient-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
        }
        
        .header-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        .pill-badge {
            background-color: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        input:focus, select:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
        }
        
        .btn-primary {
            background-color: #1E3A8A;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #172554;
        }
        
        .btn-secondary {
            background-color: #F59E0B;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: #D97706;
        }
        
        .filter-container {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-radius: 1rem;
        }
    </style>
</head>
<body>

    <!-- 🔹 HEADER -->
    <header class="bg-white shadow-nav py-4 px-6 header-sticky">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fas fa-building text-secondary text-2xl"></i>
                <h1 class="text-2xl font-bold text-primary">Sistema de Plusvalía</h1>
            </div>
            <nav class="flex items-center gap-6">
                <a href="#" class="hidden md:block text-gray-600 hover:text-primary font-medium transition">Inicio</a>
                <a href="#propiedades" class="hidden md:block text-gray-600 hover:text-primary font-medium transition">Propiedades</a>
                <a href="#" class="hidden md:block text-gray-600 hover:text-primary font-medium transition">Nosotros</a>
                <a href="#" class="hidden md:block text-gray-600 hover:text-primary font-medium transition">Contacto</a>
                <a href="{{ route('login') }}" class="bg-primary hover:bg-primary-dark text-white px-5 py-2 rounded-full text-base font-medium transition-all flex items-center gap-2">
                    <i class="fas fa-user-circle"></i>
                    Iniciar Sesión
                </a>
            </nav>
        </div>
    </header>

    <!-- 🔹 HERO CON CARRUSEL -->
    <section class="swiper mySwiper w-full h-[600px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide relative">
                <img src="{{ asset('image/imagenFondoHome.jpg') }}" alt="Propiedad 1" class="w-full h-full object-cover">
                <div class="absolute inset-0 gradient-overlay flex flex-col items-center justify-center text-white text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Encuentra tu hogar ideal</h2>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl">Descubre las mejores propiedades seleccionadas para ti</p>
                    <a href="#propiedades" class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-8 rounded-full transition-all transform hover:scale-105 flex items-center gap-2">
                        <span>Explorar propiedades</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="swiper-slide relative">
                <img src="{{ asset('image/casa2.jpg') }}" alt="Propiedad 2" class="w-full h-full object-cover">
                <div class="absolute inset-0 gradient-overlay flex flex-col items-center justify-center text-white text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Inversiones inteligentes</h2>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl">Propiedades con alto potencial de plusvalía</p>
                    <a href="#propiedades" class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-8 rounded-full transition-all transform hover:scale-105 flex items-center gap-2">
                        <span>Ver oportunidades</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="swiper-slide relative">
                <img src="{{ asset('image/casa3.jpg') }}" alt="Propiedad 3" class="w-full h-full object-cover">
                <div class="absolute inset-0 gradient-overlay flex flex-col items-center justify-center text-white text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Tu futuro comienza aquí</h2>
                    <p class="text-xl md:text-2xl mb-8 max-w-2xl">Asesoría personalizada para tu mejor decisión</p>
                    <a href="#propiedades" class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-8 rounded-full transition-all transform hover:scale-105 flex items-center gap-2">
                        <span>Contáctanos</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </section>

    <!-- 🔹 FILTRO DE PROPIEDADES -->
    <section class="container mx-auto px-4 search-container relative">
        <div class="filter-container bg-white p-6 md:p-8">
            <h3 class="text-xl font-semibold text-primary mb-4 text-center">Encuentra tu propiedad ideal</h3>
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Propiedad</label>
                    <div class="relative">
                        <select name="tipo" class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none">
                            <option value="">Todos los tipos</option>
                            <option value="1">Casa</option>
                            <option value="2">Departamento</option>
                            <option value="3">Terreno</option>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-home text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Habitaciones</label>
                    <div class="relative">
                        <input type="number" min="0" name="habitaciones" placeholder="Número de habitaciones" class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-bed text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio Mínimo</label>
                    <div class="relative">
                        <input type="number" min="0" name="precio_min" placeholder="Desde" class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-dollar-sign text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio Máximo</label>
                    <div class="relative">
                        <input type="number" min="0" name="precio_max" placeholder="Hasta" class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-dollar-sign text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary rounded-lg py-2 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>
                        <span>Buscar</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
      <!-- Continuación de la sección de características destacadas -->
      <section class="container mx-auto mt-16 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-2xl text-primary"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary mb-2">Ubicaciones Premium</h3>
                <p class="text-gray-600">Las mejores zonas con alta plusvalía y excelente conectividad.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-percentage text-2xl text-secondary"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary mb-2">Financiamiento Flexible</h3>
                <p class="text-gray-600">Simulador de crédito personalizado para encontrar la mejor opción para ti.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary mb-2">Transacciones Seguras</h3>
                <p class="text-gray-600">Acompañamiento legal y técnico durante todo el proceso de compra.</p>
            </div>
        </div>
    </section>

    <!-- 🔹 LISTADO DE PROPIEDADES -->
    <section id="propiedades" class="container mx-auto px-4 py-16">
        <div class="flex flex-col items-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-3">Propiedades Destacadas</h2>
            <div class="w-24 h-1 bg-secondary rounded-full mb-4"></div>
            <p class="text-gray-600 text-center max-w-2xl">Descubre nuestra selección de propiedades con el mejor potencial de plusvalía y retorno de inversión</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($propiedades as $propiedad)
                @php
                    $rutaImagen = isset($propiedad["images"]) && count($propiedad["images"]) > 0
                        ? config('app.url') . '/storage/' . $propiedad["images"][0]["pictures_route"]
                        : asset('images/default-image.jpg');
                @endphp

                <div class="property-card bg-white rounded-xl shadow-property overflow-hidden hover:shadow-lg">
                    <div class="relative">
                        <img src="{{$rutaImagen}}" alt="{{ $propiedad['properties_name'] ?? 'Propiedad' }}" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="pill-badge">{{ $propiedad["obtener_tipo_propiedad"]["typeProperties_name"] }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $propiedad['properties_name'] ?? 'Propiedad' }}</h3>
                            <div class="flex items-center text-white">
                                <i class="fas fa-map-marker-alt text-secondary mr-2"></i>
                                <p class="text-sm truncate">{{ $propiedad['properties_address'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 h-10">{{ $propiedad['properties_description'] }}</p>
                        
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <div class="property-feature text-gray-600 text-sm">
                                <i class="fas fa-ruler-combined text-primary"></i>
                                <span>{{ $propiedad['properties_builtUpArea'] ?? '120' }} m²</span>
                            </div>
                            <div class="property-feature text-gray-600 text-sm">
                                <i class="fas fa-bed text-primary"></i>
                                <span>{{ $propiedad['properties_bedrooms'] ?? '3' }} hab.</span>
                            </div>
                            <div class="property-feature text-gray-600 text-sm">
                                <i class="fas fa-bath text-primary"></i>
                                <span>{{ $propiedad['properties_bathrooms'] ?? '2' }} baños</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <span class="text-secondary font-bold text-xl">${{ number_format($propiedad['properties_price'] ?? 0) }}</span>

                            <div class="flex gap-2">
                                <button type="button" id="proyecto-{{$propiedad['properties_id']}}-btn" class="btn-primary px-3 py-2 rounded-lg text-sm font-medium" data-bs-toggle="modal" data-bs-target="#modalPropiedadDetalles-{{ $propiedad['properties_id'] }}">
                                    <i class="fas fa-search mr-1"></i> Ver Detalles
                                </button>
                                @if(isset($propiedad['properties_id']))
                                    <a href="{{ route('home.simularCredito', ['id' => $propiedad['properties_id']]) }}" class="btn-secondary px-3 py-2 rounded-lg text-sm font-medium">
                                        <i class="fas fa-calculator mr-1"></i> Simular
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @livewire('detalles-propiedad', [
                    'idPropiedad' => $propiedad['properties_id'],
                    'propiedad' => $propiedad
                ])
            @endforeach
        </div>
        
        <!-- Paginación -->
        <div class="mt-12 flex justify-center">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="px-4 py-2 bg-white text-primary font-medium rounded-l-md border border-gray-200 hover:bg-gray-50">Anterior</a>
                <a href="#" class="px-4 py-2 bg-primary text-white font-medium border border-primary">1</a>
                <a href="#" class="px-4 py-2 bg-white text-primary font-medium border border-gray-200 hover:bg-gray-50">2</a>
                <a href="#" class="px-4 py-2 bg-white text-primary font-medium border border-gray-200 hover:bg-gray-50">3</a>
                <a href="#" class="px-4 py-2 bg-white text-primary font-medium rounded-r-md border border-gray-200 hover:bg-gray-50">Siguiente</a>
            </div>
        </div>
    </section>

    <!-- 🔹 SECCIÓN CTA -->
    <section class="py-16 bg-primary">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-center md:text-left mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold text-white mb-4">¿Necesitas ayuda para encontrar tu propiedad ideal?</h2>
                    <p class="text-blue-100 max-w-lg">Nuestros asesores están listos para ayudarte a encontrar la mejor opción según tus necesidades y presupuesto.</p>
                </div>
                <div>
                    <a href="#" class="bg-white text-primary hover:bg-gray-100 font-semibold py-3 px-8 rounded-full transition-all transform hover:scale-105 inline-flex items-center gap-2">
                        <i class="fas fa-phone-alt"></i>
                        <span>Contáctanos hoy</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔹 TESTIMONIOS -->
    <section class="container mx-auto px-4 py-16">
        <div class="flex flex-col items-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-3">Lo que dicen nuestros clientes</h2>
            <div class="w-24 h-1 bg-secondary rounded-full mb-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md relative">
                <div class="absolute -top-5 left-6">
                    <div class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="pt-4">
                    <p class="text-gray-600 italic mb-4">El proceso de compra fue muy sencillo gracias al acompañamiento del equipo. La propiedad ha incrementado su valor en tan solo 8 meses.</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-primary">Carlos Méndez</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md relative">
                <div class="absolute -top-5 left-6">
                    <div class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="pt-4">
                    <p class="text-gray-600 italic mb-4">El simulador de crédito me ayudó mucho a planificar mi inversión. Recomiendo totalmente los servicios de Sistema de Plusvalía.</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-primary">Ana García</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md relative">
                <div class="absolute -top-5 left-6">
                    <div class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="pt-4">
                    <p class="text-gray-600 italic mb-4">Encontré el departamento perfecto en una zona con excelente plusvalía. El proceso fue rápido y sin complicaciones.</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-primary">Luis Ramírez</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Continuación del FOOTER -->
    <footer class="bg-primary text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-building text-secondary text-2xl"></i>
                        <h3 class="text-xl font-bold">Sistema de Plusvalía</h3>
                    </div>
                    <p class="text-blue-100 mb-4">Tu mejor opción para encontrar propiedades con alta plusvalía y retorno de inversión.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Inicio</a></li>
                        <li><a href="#propiedades" class="text-blue-100 hover:text-secondary transition-colors">Propiedades</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Nosotros</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Blog</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Servicios</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Compra de propiedades</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Venta de propiedades</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Simulador de crédito</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Asesoría legal</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-secondary transition-colors">Avalúos</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contáctanos</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-secondary"></i>
                            <span class="text-blue-100">Av. Principal #123, Colonia Centro</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-secondary"></i>
                            <span class="text-blue-100">+52 (123) 456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-secondary"></i>
                            <span class="text-blue-100">contacto@plusvalia.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-secondary"></i>
                            <span class="text-blue-100">Lun-Vie: 9:00 - 18:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pt-6 border-t border-blue-900 text-center">
                <p class="text-blue-100 text-sm">&copy; 2024 Sistema de Plusvalía. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- 🔹 BOTÓN DE WHATSAPP FLOTANTE -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/123456789" class="w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-all">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <!-- 🔹 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        // Inicialización del carrusel principal
        var mainSwiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            effect: "fade",
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

        // Animación de scroll suave para los enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animación de entrada para los elementos al hacer scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        });

        document.querySelectorAll('.property-card, .filter-container, .content-section').forEach((el) => {
            observer.observe(el);
        });

        // Header sticky con efecto de cambio de color al scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }
        });
    </script>
    <script src="{{ Vite::asset('resources/js/loadMap.js') }}"></script>
</body>
</html>