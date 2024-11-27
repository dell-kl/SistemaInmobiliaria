<div>
    <h2 class="fw-bold ps-2 fs-4">Ubicacion del Proyecto</h2>
    <div class="ubicacion-propiedad flex flex-row gap-2 mt-3">
        <div class="mapa w-100 flex-2">
            @livewire('ubicacion-mapa')
        </div>
        <div class="informacion w-100">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Ingresa sector propiedad">
                <label for="floatingInput">🗺️ Sector de la propiedad</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Ingresa direccion propiedad">
                <label for="floatingInput">📌 Direccion del sector</label>
            </div>
        </div>
    </div>
</div>

