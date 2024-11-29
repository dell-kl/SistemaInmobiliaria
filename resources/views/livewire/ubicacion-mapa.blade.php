<div id="map" style="height:25rem;">
</div>

<script>
    var map = L.map('map', {
        preferCanvas: true,
        zoomSnap: 0.5,
        zoomDelta: 0.5,
        wheelPxPerZoomLevel: 120
    }).setView([51.505, -0.09], 10);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

    L.control.scale().addTo(map);

</script>
