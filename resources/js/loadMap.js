/**
 * Este codigo de aqui se va a encargar de dibujar el mapa de cada uno de los proyectos
 * registrados.. a su vez tambien de dibujar en la parte de la seccion de creacion del proyecto.
 */

let elemento;
let mapaGuardados = {};

// let campoMapa;
document.addEventListener("DOMContentLoaded", (e) => {
    elemento = document.querySelectorAll("#campoUbicacionMapa");

    if ( elemento )
    {
        mapa(elemento);
    }


    let botonesPanel = document.querySelectorAll(".boton-panel");
    botonesPanel.forEach(boton => {
        boton.onclick = (e) => {
            let elemento = e.target.id, idMapa = "";
            if ( elemento === "btnRegistrarPropiedad" )
            {
                idMapa = "map";
            }
            else
            {
                idMapa = elemento.split("-")[0] + "-" + elemento.split("-")[1];
            }

            setTimeout(() => {
                try {
                    mapaGuardados[idMapa].setView([-0.21011,-78.49560], 15);
                } catch (error) {
                    mapaGuardados[idMapa].setView([-0.21011,-78.49560], 15);
                }
                mapaGuardados[idMapa].invalidateSize();
            }, 4000);
        };
    });

    // if ( mapaGuardados.length > 0)
    // {
    //     mapaGuardados.forEach(map => {
    //         map.setView([-0.21011,-78.49560],15);
    //         map.invalidateSize();

    //         console.log(map);
    //     });
    // }
});

function mapa(elemento)
{
    for(let i = 0; i < elemento.length; i++)
    {
        let identificadorMapa = elemento[i].classList[0];
        imagenEstatica(identificadorMapa);
    }
    // document.getElementById("btnRegistrarPropiedad").onclick = () => { imagenEstatica(); };
}

function imagenEstatica(identificadorMapa)
{
    let map = L.map(identificadorMapa, {
        preferCanvas: true
    }).setView([-0.21011,-78.49560], 10);

    let instanciaMapa = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    instanciaMapa.addTo(map);

    let agregarUbicacion = true;
    let markerCoordinates = [0,0];
    let marker = L.marker(markerCoordinates);
    map.addEventListener('click', function(e) {
        // if ( !agregarUbicacion)
        // {
        //     map.removeLayer(marker);
        // }

        markerCoordinates = [e.latlng.lat, e.latlng.lng];
        campoMapa.value = `${e.latlng.lat},${e.latlng.lng}`;
        marker = L.marker(markerCoordinates)

        marker.addTo(map);

        marker.bindPopup(`\nLat:${markerCoordinates[0]}\nLng:${markerCoordinates[1]}`).openPopup();

        agregarUbicacion = false;
    });

    //vamos a guardar los respectivos mapas para su uso posterior.
    mapaGuardados[identificadorMapa] = map;

}
