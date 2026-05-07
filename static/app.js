function load_markers(items) {
  markers.clearLayers();

  items.forEach((item) => {
    const marker = L.marker([item.lat, item.lon], {
      icon: L.divIcon({
        className: "",
        html: `<button type="button" class="marker" mix-get="/apis/api-get-item.php?key=${item.pk}"></button>`,
      }),
      pk: item.pk,
    });
    markers.addLayer(marker);
  });

  mix_convert();
}

function fetch_and_load_items(typeQuery = "") {
  const url = `/apis/api-search-items.php?q=${encodeURIComponent(typeQuery)}`;
  return fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to load items");
      }
      return response.json();
    })
    .then(load_markers);
}
