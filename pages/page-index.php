<!-- sætter title variablen, som bruges i vores header > til at sætte <title> i browseren  -->
<?php
$title = "MessBolig";
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
    
// Når siden er loadet bliver boliger hentet fra api-get-items.php og renderet på kortet.  
window.addEventListener('load', () => {
    fetch('/api-get-items.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load items');
            }
            return response.json();
        })
        .then(load_markers)
        .catch(error => {
            console.error('Could not render map items:', error);
        });
});
</script>

<?php require_once __DIR__."/../components/_footer.php"; ?> 
