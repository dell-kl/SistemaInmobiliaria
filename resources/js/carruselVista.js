document.addEventListener("DOMContentLoaded", (e) => {

    document.querySelectorAll(".galeria-imagenes-proyecto").forEach(galeria => {
        galeria.onclick = (e) => {

            let identificadorPropiedad = galeria.id.split("-")[1];

            let carruselVista = document.getElementById(`carruselVista-${identificadorPropiedad}`);

            if ( carruselVista )
            {
                carruselVista.classList.remove("d-none");
                window.location.href = "#carruselVista-" + identificadorPropiedad;
            }
        };
    });

});
