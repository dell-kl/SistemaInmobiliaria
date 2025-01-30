<div class="modal fade" id="verPropiedad-{{ $propiedad['properties_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-white">
        <div class="modal-content">
            <div class="flex flex-row justify-between px-4 pt-4">
                <h1 class="modal-title inicial fw-bold text-4xl" id="staticBackdropLabel">Detalles de la Propiedad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> {{ $propiedad['properties_name'] ?? 'Nombre no disponible' }}</p>
                <p><strong>Descripción:</strong> {{ $propiedad['properties_description'] ?? 'Descripción no disponible' }}</p>
                <p><strong>Precio:</strong> ${{ number_format($propiedad['properties_price'] ?? 0) }}</p>
                <!-- Agrega más detalles según sea necesario -->
            </div>
        </div>
    </div>
</div>