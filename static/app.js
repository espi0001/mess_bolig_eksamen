function load_markers(data_as_string) {
  const items = JSON.parse(data_as_string);
  markers.clearLayers();

  items.forEach((item) => {
    const marker = L.marker([item.lat, item.lon], {
      icon: L.divIcon({
        className: "",
        html: `<button class="marker" mix-get="api-get-item/${item.pk}"></button>`,
      }),
      pk: item.pk,
    });
    markers.addLayer(marker);
  });

  mix_convert();
}
