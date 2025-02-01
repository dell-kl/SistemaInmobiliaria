/**
 * Este codigo de aqui se va a encargar de dibujar el mapa de cada uno de los proyectos
 * registrados.. a su vez tambien de dibujar en la parte de la seccion de creacion del proyecto.
 */

let elemento;
let mapaGuardados = {};

let agregarUbicacion = true;
let markerCoordinates = [0,0];
let marker = L.marker(markerCoordinates);

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


            //dentro de aqui vamos a incluir la parte del ubicador en las propiedades que ya estan creadas.

            if ( elemento !== "btnRegistrarPropiedad" )
            {
                const coordenadas = document.querySelector(`#${idMapa} input[type=hidden]`).value;

                const lat = coordenadas.split(",")[0];
                const lng = coordenadas.split(",")[1];

                markerCoordinates = [lat, lng];

                marker = L.marker(markerCoordinates);

                mapaGuardados[idMapa].value = `${lat},${lng}`;

                setTimeout(() => {
                    try {
                        mapaGuardados[idMapa].setView([lat,lng], 15);
                    } catch (error) {
                        mapaGuardados[idMapa].setView([lat,lng], 15);
                    }
                    mapaGuardados[idMapa].invalidateSize();
                },4000);

                marker.addTo(mapaGuardados[idMapa]);

                marker.bindPopup(`\nLat:${markerCoordinates[0]}\nLng:${markerCoordinates[1]}`).openPopup();

                agregarUbicacion = false;
            }
            else
            {
                setTimeout(() => {
                    try {
                        mapaGuardados[idMapa].setView([-0.21011,-78.49560], 15);
                    } catch (error) {
                        mapaGuardados[idMapa].setView([-0.21011,-78.49560], 15);
                    }
                    mapaGuardados[idMapa].invalidateSize();
                }, 4000);

            }

        };
    });

});

function mapa(elemento)
{
    for(let i = 0; i < elemento.length; i++)
    {
        let identificadorMapa = elemento[i].classList[0];
        imagenEstatica(identificadorMapa);
    }
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

    agregarUbicacion = true;
    markerCoordinates = [0,0];
    marker = L.marker(markerCoordinates);

    map.addEventListener('click', function(e) {

        if ( !agregarUbicacion )
        {
            //vamos a eliminar el marker
            mapaGuardados[identificadorMapa].removeLayer(marker);
        }

        markerCoordinates = [e.latlng.lat, e.latlng.lng];

        mapaGuardados[identificadorMapa].value = `${e.latlng.lat},${e.latlng.lng}`;

        //vamos a setear en nuestro input oculto para la parte del mapa
        document.querySelector(`#${identificadorMapa} input[type=hidden]`).value = `${e.latlng.lat},${e.latlng.lng}`;

        marker = L.marker(markerCoordinates)

        marker.addTo(map);

        marker.bindPopup(`\nLat:${markerCoordinates[0]}\nLng:${markerCoordinates[1]}`).openPopup();

        agregarUbicacion = false;

    });

    //vamos a guardar los respectivos mapas para su uso posterior.
    mapaGuardados[identificadorMapa] = map;

}
