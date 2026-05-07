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
