<?php
$title = "Messbolig";
require_once __DIR__."/../components/_header.php";
?>

<main>
    <div id="map"></div>
    <aside id="aside">
        <p>Klik på en bolig på kortet for at se detaljer</p>
    </aside>
</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([55.6761, 12.5683], 7);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    const markers = L.layerGroup().addTo(map);
    
window.addEventListener('load', () => {
    document.querySelector('[mix-get="api-get-items"]').click();
});
</script>

<?php require_once __DIR__."/_footer.php"; ?>
