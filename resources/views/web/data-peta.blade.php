@extends('layouts.appweb2')

@section('content')
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

<div class="p-4">
        <!-- Judul -->
        <div class="mb-4">
        <h1 class="text-2xl font-bold text-green-700">Desa Dalam Peta</h1>
        <p class="text-sm text-gray-600">Pilih kategori dan wilayah untuk menampilkan informasi pada peta secara tematik.</p>
    </div>
    <!-- Filter -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <select id="kategori" class="border rounded p-2">
            <option value="">Pilih Kategori</option>
            @foreach ($kategoriPeta as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
        </select>

        <select id="kecamatan" class="border rounded p-2">
            <option value="">Pilih Kecamatan</option>
            @foreach ($kecamatans as $kec)
                <option value="{{ $kec->id }}">{{ $kec->nama_kecamatan }}</option>
            @endforeach
        </select>

        <select id="tahun" class="border rounded p-2 hidden"></select>
        <select id="desa" class="border rounded p-2 hidden"></select>
    </div>

    <!-- Peta -->
    <div id="map" class="w-full h-[600px] border rounded relative z-0"></div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-xl p-6 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl">&times;</button>
        <h2 id="modalTitle" class="text-xl font-bold mb-4">Memuat data...</h2>
        <div id="modalContent" class="text-sm text-gray-700 max-h-[70vh] overflow-y-auto">Mengambil data...</div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="hidden fixed inset-0 z-[9998] bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white px-4 py-2 rounded shadow flex items-center gap-2 text-sm text-gray-800">
        <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Memuat data peta...
    </div>
</div>

<!-- Legenda -->
<div id="map-legend" class="absolute bottom-6 right-6 bg-white shadow-lg rounded p-3 text-sm z-[1000] hidden">
    <div id="legend-title" class="font-semibold mb-2">Legenda</div>
    <div class="flex items-center gap-2 mb-1"><div style="width: 20px; height: 12px; background: #2ecc71; border: 1px solid #ccc;"></div><span>0 – 10</span></div>
    <div class="flex items-center gap-2 mb-1"><div style="width: 20px; height: 12px; background: #f1c40f; border: 1px solid #ccc;"></div><span>11 – 30</span></div>
    <div class="flex items-center gap-2 mb-1"><div style="width: 20px; height: 12px; background: #e67e22; border: 1px solid #ccc;"></div><span>31 – 50</span></div>
    <div class="flex items-center gap-2"><div style="width: 20px; height: 12px; background: #e74c3c; border: 1px solid #ccc;"></div><span>> 50</span></div>
</div>

<style>
    #map { z-index: 0 !important; }
    .animate-spin { animation: spin 1s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
let map = L.map('map').setView([-6.9591793, 108.902683], 10);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
let geoLayer = null;
let markerCluster = null;

function showLoading(state = true) {
    document.getElementById('loadingOverlay').classList.toggle('hidden', !state);
}

function getColor(jumlah) {
    if (jumlah <= 10) return '#2ecc71';
    if (jumlah <= 30) return '#f1c40f';
    if (jumlah <= 50) return '#e67e22';
    return '#e74c3c';
}

function setLegendTitle(kategoriId) {
    let text = "Legenda";
    if (kategoriId == 1) text = "Legenda Jumlah Balita";
    else if (kategoriId == 2) text = "Legenda Jumlah Lansia";
    else if (kategoriId == 3) text = "Legenda Jumlah UMKM";
    else if (kategoriId == 4) text = "Legenda Jumlah Disabilitas";
    document.getElementById('legend-title').innerText = text;
    document.getElementById('map-legend').classList.remove('hidden');
}
function resetLegend() {
    const legend = document.getElementById('map-legend');
    legend.classList.add('hidden');
    legend.innerHTML = '';
}

function setMarkerLegend(kategoriId) {
    const legend = document.getElementById('map-legend');
    const legendTitle = document.getElementById('legend-title');
    legend.innerHTML = ''; // Kosongkan isi legend

    // Legenda untuk Sarana Pendidikan
    if (kategoriId == 6) {
        legend.innerHTML = `
            <div class="font-semibold mb-2">Legenda Sarana Pendidikan</div>
            <div class="flex items-center gap-2">
                <img src="/assets/icons/sekolah.ico" class="w-6 h-6" />
                <span>Sekolah</span>
            </div>
        `;
        legend.classList.remove('hidden');
    }

    // Legenda untuk Sarana Ibadah (langsung hardcode HTML)
    else if (kategoriId == 8) {
        legend.innerHTML = `
            <div class="font-semibold mb-2">Legenda Sarana Ibadah</div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/masjid.png" class="w-6 h-6" />
                <span>Masjid / Mushola</span>
            </div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/gereja.png" class="w-6 h-6" />
                <span>Gereja</span>
            </div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/pura.png" class="w-6 h-6" />
                <span>Pura</span>
            </div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/vihara.png" class="w-6 h-6" />
                <span>Vihara</span>
            </div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/kelenteng.png" class="w-6 h-6" />
                <span>Kelenteng</span>
            </div>

            <div class="flex items-center gap-2 mb-1">
                <img src="/assets/icons/kantoragama.png" class="w-6 h-6" />
                <span>Kantor Lembaga Keagamaan</span>
            </div>
        `;
        legend.classList.remove('hidden');
    }

    // Legenda untuk Jembatan
    else if (kategoriId == 9) {
        legend.innerHTML = `
            <div class="font-semibold mb-2">Legenda Jembatan</div>
            <div class="flex items-center gap-2">
                <img src="/assets/icons/jembatan.png" class="w-6 h-6" />
                <span>Jembatan</span>
            </div>
        `;
        legend.classList.remove('hidden');
    }

    // Kategori lainnya disembunyikan
    else {
        legend.classList.add('hidden');
    }
}



function loadTahun(kategori, kecamatanId) {
    const tahun = document.getElementById('tahun');
    tahun.innerHTML = `<option value="">Memuat data tahun...</option>`;
    tahun.classList.remove('hidden');
    tahun.disabled = true;

    fetch(`/desa-dalam-peta/get-tahun/${kategori}?kecamatan_id=${kecamatanId}`)
        .then(res => res.json())
        .then(data => {
            tahun.innerHTML = `<option value="">Pilih Tahun</option>`;
            data.forEach(t => {
                tahun.innerHTML += `<option value="${t}">${t}</option>`;
            });
            tahun.disabled = false;
        }).catch(() => alert("Gagal memuat data tahun"));
}

function loadDesa(kecamatanId) {
    const desa = document.getElementById('desa');
    desa.innerHTML = `<option value="">Memuat data desa...</option>`;
    desa.classList.remove('hidden');
    desa.disabled = true;

    fetch(`/desa-dalam-peta/get-desa/${kecamatanId}`)
        .then(res => res.json())
        .then(data => {
            desa.innerHTML = `<option value="">Pilih Desa</option>`;
            data.forEach(d => {
                desa.innerHTML += `<option value="${d.id}">${d.nama_desa}</option>`;
            });
            desa.disabled = false;
        }).catch(() => alert("Gagal memuat desa"));
}

function showModal(desaId, kategori, tahun) {
    const modal = document.getElementById('detailModal');
    const title = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    title.innerText = 'Memuat data...';
    content.innerHTML = 'Mengambil data...';

    fetch(`/desa-dalam-peta/detail-desa?desa_id=${desaId}&kategori=${kategori}&tahun=${tahun}`)
        .then(res => res.json())
        .then(res => {
            const total = res.total;
            const desa = res.desa;
            const kec = res.kecamatan;
            const tahun = res.tahun;
            const kategoriText = res.kategori_nama;
            const data = res.data;

            if (total === 0 || Object.keys(data).length === 0) {
                title.innerText = `Desa: ${desa}`;
                content.innerHTML = `<div class="text-gray-700 text-sm">Tidak ada data ${kategoriText.toLowerCase()} di Desa ${desa} tahun ${tahun}.</div>`;
                return;
            }

            let html = `
                <div class="mb-4">
                    <div class="text-lg font-bold text-gray-800">Desa: ${desa}</div>
                    <div class="text-sm text-gray-600">Kecamatan: ${kec}</div>
                    <div class="text-sm text-gray-700 mt-1">Kategori: ${kategoriText}</div>
                    <div class="text-sm text-green-700 font-medium mt-2">
                        Total ${kategoriText}: <span class="font-bold">${total}</span>
                    </div>
                </div>
            `;

            for (const [rw, entries] of Object.entries(data)) {
                html += `
                    <div class="border mb-2 rounded">
                        <button class="w-full text-left px-4 py-2 bg-gray-100 font-semibold toggle-collapse" data-target="rw-${rw}">
                            RW ${rw} <span class="float-right">▼</span>
                        </button>
                        <div id="rw-${rw}" class="px-4 py-2 hidden">
                            <table class="w-full text-sm table-auto border">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border px-2 py-1">RT</th>
                                        ${kategori == 4 ? '<th class="border px-2 py-1">Jenis Disabilitas</th>' : ''}
                                        <th class="border px-2 py-1">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${entries.map(d => `
                                        <tr>
                                            <td class="border px-2 py-1">${d.rt_rw_desa?.rt ?? '-'}</td>
                                            ${kategori == 4 ? `<td class="border px-2 py-1">${d.jenis ?? '-'}</td>` : ''}
                                            <td class="border px-2 py-1">${d.jumlah}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }

            title.innerText = `Detail Desa: ${desa}`;
            content.innerHTML = html;

            document.querySelectorAll('.toggle-collapse').forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = document.getElementById(btn.dataset.target);
                    target.classList.toggle('hidden');
                });
            });
        });
}

function loadGeojson(kategori, kecamatanId, tahun) {
    showLoading(true);
    setLegendTitle(kategori);

    const kategoriMap = {
        1: 'jumlah_balita',
        2: 'jumlah_lansia',
        3: 'jumlah_umkm',
        4: 'jumlah'
    };

    const propJumlah = kategoriMap[kategori];

    fetch(`/desa-dalam-peta/geojson?kategori=${kategori}&kecamatan_id=${kecamatanId}&tahun=${tahun}`)
        .then(res => res.json())
        .then(data => {
            if (geoLayer) map.removeLayer(geoLayer);
            if (markerCluster) map.removeLayer(markerCluster);

            geoLayer = L.geoJSON(data, {
                style: feature => {
                    const jumlah = feature.properties[propJumlah] ?? 0;
                    return {
                        fillColor: getColor(jumlah),
                        color: '#333',
                        weight: 1,
                        fillOpacity: 0.6
                    };
                },
                onEachFeature: (feature, layer) => {
                    const namaDesa = feature.properties.desa;
                    const jumlah = feature.properties[propJumlah] ?? 0;

                    layer.bindTooltip(`<strong>${namaDesa}</strong><br>Jumlah: ${jumlah}`, {
                        direction: 'top',
                        sticky: true
                    });

                    layer.on('click', () => {
                        showModal(feature.properties.id, kategori, tahun);
                    });
                }
            }).addTo(map);

            map.fitBounds(geoLayer.getBounds());
        })
        .catch(() => alert("Gagal memuat geojson"))
        .finally(() => showLoading(false));
}



function loadMarkers(kategori, kecamatanId, desaId) {
    showLoading(true);

    if (geoLayer) map.removeLayer(geoLayer);
    if (markerCluster) map.removeLayer(markerCluster);

    fetch(`/desa-dalam-peta/marker?kategori=${kategori}&desa_id=${desaId}`)
        .then(res => res.json())
        .then(data => {
            markerCluster = L.markerClusterGroup();

            data.forEach(marker => {
                if (!marker.lat || !marker.lng) return; // Skip jika lat/lng tidak valid

                const customIcon = L.icon({
                    iconUrl: marker.icon,
                    iconSize: [30, 30],
                    iconAnchor: [15, 30],
                    popupAnchor: [0, -30]
                });

                const popup = `
                    <div class="text-sm">
                        <div class="font-semibold">${marker.nama}</div>
                        <div class="text-gray-600">Jenis: ${marker.jenis}</div>
                        <div class="text-gray-500">RT/RW: ${marker.rt}/${marker.rw}</div>
                        ${marker.foto ? `<img src="/storage/${marker.foto}" class="mt-2 rounded shadow w-full max-w-xs" />` : ''}
                    </div>
                `;

                L.marker([marker.lat, marker.lng], { icon: customIcon })
                    .bindPopup(popup)
                    .on('click', () => showMarkerModal(marker.id, kategori))
                    .addTo(markerCluster);
            });

            if (markerCluster.getLayers().length > 0) {
                map.addLayer(markerCluster); // Tambahkan dulu baru ambil bounds

                const bounds = markerCluster.getBounds();
                const center = bounds.getCenter();
                map.setView(center, 12); // Bisa diganti zoom default sesuai keinginan
            } else {
                alert("Tidak ada marker ditemukan untuk desa ini.");
            }
        })
        .catch(() => alert("Gagal memuat marker"))
        .finally(() => showLoading(false));
}


function showMarkerModal(id, kategori) {
    const modal = document.getElementById('detailModal');
    const title = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');

    modal.classList.remove('hidden');
    title.innerText = 'Memuat detail...';
    content.innerHTML = 'Mengambil data...';

    fetch(`/desa-dalam-peta/marker-detail?kategori=${kategori}&id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (kategori == 9) {
                // Modal khusus jembatan
                title.innerText = data.nama ?? 'Data Jembatan';
                content.innerHTML = `
<div class="text-sm text-gray-700">
    <!-- Gambar -->
    ${data.foto ? `
        <div class="flex justify-center mb-4">
            <img src="/storage/foto_jembatan/${data.foto}" class="rounded shadow max-h-64 object-contain" />
        </div>
    ` : ''}

    <!-- Tabel Informasi -->
    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <div class="font-semibold text-gray-600">Nama Jembatan</div>
        <div class="text-gray-800">${data.nama}</div>

        <div class="font-semibold text-gray-600">Ukuran</div>
        <div class="text-gray-800">${data.panjang ?? '-'} m x ${data.lebar ?? '-'} m</div>

        <div class="font-semibold text-gray-600">Kondisi</div>
        <div class="text-gray-800">${data.kondisi ?? '-'}</div>

        <div class="font-semibold text-gray-600">Lokasi</div>
        <div class="text-gray-800">${data.lokasi ?? '-'}</div>

        <div class="font-semibold text-gray-600">RT/RW</div>
        <div class="text-gray-800">${data.rt}/${data.rw}</div>

        <div class="font-semibold text-gray-600">Desa</div>
        <div class="text-gray-800">${data.desa}</div>

        <div class="font-semibold text-gray-600">Kecamatan</div>
        <div class="text-gray-800">${data.kecamatan}</div>
    </div>
</div>

                `;
            }else if (kategori == 6) {
    // ✅ Pendidikan
    title.innerText = data.nama ?? 'Data Pendidikan';
    content.innerHTML = `
<div class="text-sm text-gray-700">
    ${data.foto ? `
        <div class="flex justify-center mb-4">
            <img src="/storage/foto_pendidikan/${data.foto}" class="rounded shadow max-h-64 object-contain" />
        </div>
    ` : ''}

    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <div class="font-semibold text-gray-600">Nama Pendidikan</div>
        <div class="text-gray-800">${data.nama ?? '-'}</div>

        <div class="font-semibold text-gray-600">Jenis</div>
        <div class="text-gray-800">${data.jenis ?? '-'}</div>

        <div class="font-semibold text-gray-600">Status</div>
        <div class="text-gray-800">${data.status ?? '-'}</div>

        <div class="font-semibold text-gray-600">RT/RW</div>
        <div class="text-gray-800">${data.rt}/${data.rw}</div>

        <div class="font-semibold text-gray-600">Desa</div>
        <div class="text-gray-800">${data.desa}</div>

        <div class="font-semibold text-gray-600">Kecamatan</div>
        <div class="text-gray-800">${data.kecamatan}</div>
    </div>
</div>
    `;
}  else if (kategori == 8) {
                // Modal khusus sarana ibadah
                title.innerText = data.nama ?? 'Data Sarana Ibadah';
                content.innerHTML = `
                    <div class="text-sm text-gray-700">
                        ${data.foto ? `
                            <div class="flex justify-center mb-4">
                                <img src="/storage/${data.foto}" class="rounded shadow max-h-64 object-contain" />
                            </div>
                        ` : ''}

                        <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                            <div class="font-semibold text-gray-600">Nama Sarana Ibadah</div>
                            <div class="text-gray-800">${data.nama}</div>

                            <div class="font-semibold text-gray-600">Jenis Sarana Ibadah</div>
                            <div class="text-gray-800">${data.jenis}</div>

                            <div class="font-semibold text-gray-600">RT/RW</div>
                            <div class="text-gray-800">${data.rt}/${data.rw}</div>

                            <div class="font-semibold text-gray-600">Desa</div>
                            <div class="text-gray-800">${data.desa}</div>

                            <div class="font-semibold text-gray-600">Kecamatan</div>
                            <div class="text-gray-800">${data.kecamatan}</div>
                        </div>
                    </div>
                `;
            }
             else {
                // Default pendidikan / ibadah
                title.innerText = data.nama ?? 'Detail Sarana';
                content.innerHTML = `
                    <div class="space-y-2 text-sm text-gray-700">
                        <div><strong>Jenis:</strong> ${data.jenis}</div>
                        <div><strong>RT/RW:</strong> ${data.rt}/${data.rw}</div>
                        <div><strong>Desa:</strong> ${data.desa}</div>
                        <div><strong>Kecamatan:</strong> ${data.kecamatan}</div>
                        ${data.foto ? `<img src="/storage/${data.foto}" class="mt-2 rounded shadow w-full max-w-xs" />` : ''}
                    </div>
                `;
            }
        })
        .catch(() => {
            title.innerText = 'Gagal Memuat Data';
            content.innerHTML = '<div class="text-red-600">Data tidak ditemukan.</div>';
        });
}



// Event listeners
document.getElementById('kategori').addEventListener('change', function () {
    const kategori = parseInt(this.value);
    const kecamatan = document.getElementById('kecamatan').value;
    if (geoLayer) {
        map.removeLayer(geoLayer);
        geoLayer = null;
    }
    if (markerCluster) {
        map.removeLayer(markerCluster);
        markerCluster = null;
    }
    if ([6, 8, 9].includes(kategori)) {
        setMarkerLegend(kategori);
        document.getElementById('tahun').classList.add('hidden');
        if (kecamatan) loadDesa(kecamatan);
    } else {
        setLegendTitle(kategori);
        document.getElementById('desa').classList.add('hidden');
        if (kategori && kecamatan) loadTahun(kategori, kecamatan);
    }
});

document.getElementById('kecamatan').addEventListener('change', function () {
    const kategori = parseInt(document.getElementById('kategori').value);
    const kecamatan = this.value;
    if ([6, 8, 9].includes(kategori)) {
        if (kecamatan) loadDesa(kecamatan);
    } else {
        if (kategori && kecamatan) loadTahun(kategori, kecamatan);
    }
});

document.getElementById('tahun').addEventListener('change', function () {
    const kategori = document.getElementById('kategori').value;
    const kecamatan = document.getElementById('kecamatan').value;
    const tahun = this.value;
    if (kategori && kecamatan && tahun) loadGeojson(kategori, kecamatan, tahun);
});

document.getElementById('desa').addEventListener('change', function () {
    const kategori = document.getElementById('kategori').value;
    const kecamatan = document.getElementById('kecamatan').value;
    const desaId = this.value;
    if ([6, 8, 9].includes(parseInt(kategori)) && desaId) {
        loadMarkers(kategori, kecamatan, desaId);
    }
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('detailModal').classList.add('hidden');
});
</script>
@endsection
