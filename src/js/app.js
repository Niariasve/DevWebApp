// import '../scss/app.scss';

console.log('InitAppChanged hjhkjh');

if (document.getElementById('mapa')) {
  const lat = -2.168912;
  const lon = -79.936887;
  const zoom = 16;

  const map = L.map('mapa', {
    center: [lat, lon],
    zoom: zoom
  });

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  L.marker([lat, lon]).addTo(map)
    .bindPopup(`
      <h2 class="mapa__heading">DevWebCamp</h2>
      <p class="mapa__texto">Centro de convenciones</p>  
    `)
    .openPopup();
}