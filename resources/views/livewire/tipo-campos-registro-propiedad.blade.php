<div class="formularioRegistroPropiedad flex-2 w-50">
    <h2 class="text-xl fw-bold">Tipo Proyecto</h2>
    <div class="col">
        <select class="form-select" aria-label="Default select example" wire:model.live="typeProjects">
            <option selected>Selecciona tipo de proyecto</option>
            <option value="1">
                🏢 Departamento
            </option>
            <option value="2" id="registro-casa">
                🏠 Casa
            </option>
            <option value="3" id="registro-terreno">
                🟫 Terreno
            </option>
        </select>
    </div>

    <div class="campos mt-5">
  
        @if (intval($typeProjects) === 1 || intval($typeProjects) === 2)
            <h3 class="fw-bold pt-2 pb-2">Datos Generales Proyecto</h3>

            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Inserta numero de habitaciones">
                    <label for="floatingInput">🛌 Numero Habitaciones</label>
                </div>
                <div class="form-floating mb-3  flex-1">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Inserta numero de baños">
                    <label for="floatingInput">🚽 Numero Baños</label>
                </div>
    
                @if ( intval($typeProjects) === 2 )
                    <div class="form-floating mb-3 flex-1">
                        <input type="number" class="form-control" id="floatingInput" placeholder="Inserta cuantos estacionamientos">
                        <label for="floatingInput">🚏 Numero Estacionamiento</label>
                    </div>
                @endif
            </div>
       
        @elseif(intval($typeProjects) === 0)
            <div class="alert alert-light mt-2" role="alert">
                Debes seleccionar un tipo de proyecto para continuar ...
            </div>
        @endif

        @if ( intval($typeProjects) !== 0 )
            <h3 class="fw-bold pt-2 pb-2">Medidas Proyecto</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Inserta el area del proyecto">
                    <label for="floatingInput">📏 Area Terreno</label>
                </div>

                @if (intval($typeProjects) !== 3 )
                    <div class="form-floating mb-3  flex-1">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Inserta el alto de la casa o departamento">
                        <label for="floatingInput">📐 Alto Total</label>
                    </div>
                @else
                    <div class="form-floating mb-3  flex-1">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Inserta la profundidad del terreno">
                        <label for="floatingInput">>📐 Profundidad Terreno</label>
                    </div>
                @endif 
            </div>

            <h3 class="fw-bold pt-2 pb-2">Disponibilidad del proyecto</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating flex-1">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                      <option selected>-- Disponibilidad --</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <label for="floatingSelect">Dale la disponibilidad al proyecto</label>
                </div>
            </div>

            <h3 class="fw-bold pt-3 pb-2">Datos Financieros</h3>
            <div class="flex flex-row flex-wrap gap-1">
                <div class="form-floating mb-3  flex-1">
                    <input type="number" class="form-control" id="floatingInput" placeholder="Precio propuesto del proyecto">
                    <label for="floatingInput">💲💲 Ponle un precio al proyecto</label>
                </div>
            </div>
        @endif
    </div>
</div>