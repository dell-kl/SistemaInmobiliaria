document.addEventListener("DOMContentLoaded", (e) => {
    mapa();
});

function mapa()
{
    document.getElementById("btnRegistrarPropiedad").onclick = () => { imagenEstatica(); };
}

function imagenEstatica()
{
    let map = L.map('map', {
        preferCanvas: true
    }).setView([-0.21011,-78.49560], 10);


    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    let agregarUbicacion = true;
    let markerCoordinates = [0,0];
    let marker = L.marker(markerCoordinates);
    map.on('click', (e) => {
        if ( !agregarUbicacion)
        {
            map.removeLayer(marker);
        }

        markerCoordinates = [e.latlng.lat, e.latlng.lng];
        marker = L.marker(markerCoordinates)

        marker.addTo(map);

        marker.bindPopup(`\nLat:${markerCoordinates[0]}\nLng:${markerCoordinates[1]}`).openPopup();

        agregarUbicacion = false;
    });

    setTimeout(() => {
        map.setView([-0.21011,-78.49560],15);
        map.invalidateSize();
    }, 3000);


}

