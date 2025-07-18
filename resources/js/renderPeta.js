// let map;

// function renderChoropleth(kategoriId, tahun, kecamatanId) {
//     if (map) map.remove();

//     map = L.map('map').setView([-7.0, 109.0], 10);
//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '&copy; OpenStreetMap contributors'
//     }).addTo(map);

//     const url = `/desa-dalam-peta/choropleth/${kategoriId}/${tahun}?kecamatan_id=${kecamatanId}`;

//     fetch(url)
//         .then(res => res.json())
//         .then(geojson => {
//             const getColor = d =>
//                 d > 100 ? '#800026' :
//                 d > 50  ? '#BD0026' :
//                 d > 20  ? '#E31A1C' :
//                 d > 10  ? '#FC4E2A' :
//                 d > 0   ? '#FD8D3C' : '#FFEDA0';

//             const style = feature => ({
//                 fillColor: getColor(feature.properties.jumlah_data),
//                 weight: 2,
//                 opacity: 1,
//                 color: 'white',
//                 dashArray: '3',
//                 fillOpacity: 0.7
//             });

//             L.geoJSON(geojson, {
//                 style: style,
//                 onEachFeature: (feature, layer) => {
//                     const p = feature.properties;
//                     layer.bindPopup(`
//                         <strong>Desa:</strong> ${p.desa}<br>
//                         <strong>Kecamatan:</strong> ${p.kecamatan}<br>
//                         <strong>Jumlah:</strong> ${p.jumlah_data}<br>
//                         <strong>Tahun:</strong> ${p.tahun}
//                     `);
//                 }
//             }).addTo(map);
//         });
// }
let map;

function renderChoropleth(kategoriId, tahun, kecamatanId) {
    if (map) map.remove();

    map = L.map('map').setView([-7.0, 109.0], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const url = `/desa-dalam-peta/choropleth/${kategoriId}/${tahun}?kecamatan_id=${kecamatanId}`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            if (kategoriId == 9) {
                // Tampilkan data marker (Jembatan)
                data.forEach(jembatan => {
                    if (!jembatan.latitude || !jembatan.longitude) return;

                    const marker = L.marker([jembatan.latitude, jembatan.longitude]).addTo(map);
                    marker.bindPopup(`
                        <strong>Nama Jembatan:</strong> ${jembatan.nama_jembatan}<br>
                        <strong>Kondisi:</strong> ${jembatan.kondisi}<br>
                        <strong>Panjang:</strong> ${jembatan.panjang} meter<br>
                        <strong>Desa:</strong> ${jembatan.desa}<br>
                        <strong>Kecamatan:</strong> ${jembatan.kecamatan}
                    `);
                });
            } else {
                // Tampilkan Choropleth (misal: Balita)
                const getColor = d =>
                    d > 100 ? '#800026' :
                    d > 50  ? '#BD0026' :
                    d > 20  ? '#E31A1C' :
                    d > 10  ? '#FC4E2A' :
                    d > 0   ? '#FD8D3C' : '#FFEDA0';

                const style = feature => ({
                    fillColor: getColor(feature.properties.jumlah_data),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                });

                L.geoJSON(data, {
                    style: style,
                    onEachFeature: (feature, layer) => {
                        const p = feature.properties;
                        layer.bindPopup(`
                            <strong>Desa:</strong> ${p.desa}<br>
                            <strong>Kecamatan:</strong> ${p.kecamatan}<br>
                            <strong>Jumlah:</strong> ${p.jumlah_data}<br>
                            <strong>Tahun:</strong> ${p.tahun}
                        `);
                    }
                }).addTo(map);
            }
        })
        .catch(err => {
            console.error("Gagal memuat peta:", err);
            alert("Terjadi kesalahan saat memuat data peta.");
        });
}

