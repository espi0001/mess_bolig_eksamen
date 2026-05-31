<?php
// sætter title variablen, som bruges i _header.php til <title>-tagget
$title = "MessBolig";

// indlæser headeren
require_once __DIR__."/../components/_header.php";
?>

<main>
    <!-- Kortet bliver renderet -->
    <div id="map"></div>

    <!-- Valgt bolig med info -->
    <aside id="aside">
        <p>Klik på en bolig på kortet for at se detaljer</p>
    </aside>
</main>

<!-- Leaflet bibliotek til kortvisning -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Opretter kortet og centrerer på DK
    const map = L.map('map').setView([55.6761, 12.5683], 7);

    // Tilføj baggrundskort (tiles) fra CARTO
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    // LayerGroup bruges til at samle alle bolig-markører på kortet
    const markers = L.layerGroup().addTo(map);
    
    // Når siden er loadet hentets boliger fra API'et og renderet på kortet.  
    window.addEventListener('load', () => {
        fetch('/apis/api-get-items.php')

            // Tjekker om serveren returnerer et gyldigt svar
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load items');
                }

                // konverter svaret til JSON
                return response.json();
            })

            // Sender boligdata videre til funktionen som opretter marker
            .then(load_markers)
            .catch(error => {
                console.error('Could not render map items:', error);
            });
    });
</script>


<?php 
// Indlæser footer
require_once __DIR__."/../components/_footer.php"; 
?> 
