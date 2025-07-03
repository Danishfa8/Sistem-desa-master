import "./bootstrap";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { parseKategoriResponse } from "./parseKategori.js";

// Variabel penyimpanan data
let kecamatanData = [];
let desaData = [];
let kategoriData = [];

// Inisialisasi peta Leaflet
const map = L.map("map").setView([-6.9175, 107.6191], 12);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
}).addTo(map);

// Layer groups untuk marker desa, kategori, dan batas administratif
const desaMarkers = L.layerGroup().addTo(map);
const kategoriMarkers = L.layerGroup().addTo(map);
const boundaryLayers = L.layerGroup().addTo(map);

// DOM Elements
const kecamatanSelect = document.getElementById("kecamatan");
const desaSelect = document.getElementById("desa");
const kategoriSelect = document.getElementById("kategori");
const infoPanel = document.getElementById("infoPanel");
const infoContent = document.getElementById("infoContent");

// Tambahkan CSS custom untuk styling yang lebih baik
const customStyles = `
<style>
.custom-popup .leaflet-popup-content-wrapper {
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    border: 1px solid #e53e3e;
}

.custom-popup .leaflet-popup-tip {
    border-top-color: #e53e3e;
}

.custom-popup-desa .leaflet-popup-content-wrapper {
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    border: 1px solid #2563eb;
}

.custom-popup-desa .leaflet-popup-tip {
    border-top-color: #2563eb;
}

.leaflet-control-custom button {
    transition: all 0.3s ease;
    font-weight: 600;
}

.leaflet-control-custom button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.boundary-visible {
    background-color: #e53e3e !important;
    color: white !important;
    border-color: #e53e3e !important;
}

.boundary-hidden {
    background-color: white !important;
    color: #333 !important;
    border-color: rgba(0,0,0,0.2) !important;
}

/* Style untuk marker desa agar lebih kontras dengan boundary */
.desa-marker {
    background-color: #2563eb !important;
    border: 2px solid white !important;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4) !important;
}

.kategori-marker {
    background-color: #dc2626 !important;
    border: 2px solid white !important;
    box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4) !important;
}
</style>
`;

// Inject custom styles ke document head
document.head.insertAdjacentHTML("beforeend", customStyles);

// Tambahkan kontrol untuk toggle boundary dengan style yang ditingkatkan
const boundaryToggle = L.control({ position: "topleft" });
boundaryToggle.onAdd = function (map) {
    const div = L.DomUtil.create(
        "div",
        "leaflet-control leaflet-control-custom"
    );
    div.innerHTML = `
        <button id="toggleBoundary" class="boundary-visible" style="
            border: 2px solid #e53e3e; 
            border-radius: 8px; 
            padding: 10px 15px; 
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            background-color: #e53e3e;
            color: white;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(229, 62, 62, 0.3);
        ">
            <span>🗺️</span>
            <span>Sembunyikan Batas</span>
        </button>
    `;
    div.style.background = "none";
    div.style.border = "none";
    return div;
};
boundaryToggle.addTo(map);

function showLoading(element, text = "Loading...") {
    element.innerHTML = `<option value="">${text}</option>`;
    element.disabled = true;
}

function showError(message) {
    console.error(message);
}

// Fungsi untuk membuat spatial grid untuk menghindari overlap
function createSpatialGrid(villages, gridSize = 0.01) {
    const grid = new Map();
    const occupiedCells = new Set();

    return villages
        .map((village, index) => {
            const lat = parseFloat(village.latitude);
            const lng = parseFloat(village.longitude);

            if (isNaN(lat) || isNaN(lng)) return null;

            // Cari posisi grid yang tidak overlap
            let bestPosition = findAvailableGridPosition(
                lat,
                lng,
                gridSize,
                occupiedCells
            );

            return {
                ...village,
                adjustedLat: bestPosition.lat,
                adjustedLng: bestPosition.lng,
                originalLat: lat,
                originalLng: lng,
                gridPosition: bestPosition,
            };
        })
        .filter((v) => v !== null);
}

// Fungsi untuk mencari posisi grid yang tersedia
function findAvailableGridPosition(lat, lng, gridSize, occupiedCells) {
    const baseGridX = Math.floor(lng / gridSize);
    const baseGridY = Math.floor(lat / gridSize);

    // Coba posisi asli terlebih dahulu
    const originalKey = `${baseGridX},${baseGridY}`;
    if (!occupiedCells.has(originalKey)) {
        occupiedCells.add(originalKey);
        return { lat, lng, gridX: baseGridX, gridY: baseGridY };
    }

    // Cari posisi terdekat yang tersedia dengan spiral search
    for (let radius = 1; radius <= 10; radius++) {
        for (let dx = -radius; dx <= radius; dx++) {
            for (let dy = -radius; dy <= radius; dy++) {
                if (Math.abs(dx) !== radius && Math.abs(dy) !== radius)
                    continue;

                const newGridX = baseGridX + dx;
                const newGridY = baseGridY + dy;
                const key = `${newGridX},${newGridY}`;

                if (!occupiedCells.has(key)) {
                    occupiedCells.add(key);
                    const newLat = lat + dy * gridSize * 0.5;
                    const newLng = lng + dx * gridSize * 0.5;
                    return {
                        lat: newLat,
                        lng: newLng,
                        gridX: newGridX,
                        gridY: newGridY,
                    };
                }
            }
        }
    }

    // Fallback - tambahkan random offset kecil
    const randomOffset = Math.random() * 0.005;
    const randomAngle = Math.random() * 2 * Math.PI;
    return {
        lat: lat + randomOffset * Math.cos(randomAngle),
        lng: lng + randomOffset * Math.sin(randomAngle),
        gridX: baseGridX,
        gridY: baseGridY,
    };
}

// Fungsi untuk membuat boundary berbentuk natural (polygonal)
function createNaturalBoundary(
    village,
    index,
    totalVillages,
    minDistance = 0.003
) {
    const lat = village.adjustedLat || village.originalLat;
    const lng = village.adjustedLng || village.originalLng;

    // Variasi ukuran berdasarkan index dan posisi
    const baseRadius = 0.004 + (Math.sin(index * 0.7) + 1) * 0.002; // 0.004 - 0.008
    const radiusVariation = 0.6 + Math.random() * 0.4; // 0.6 - 1.0
    const finalRadius = baseRadius * radiusVariation;

    // Jumlah titik untuk polygon (6-10 titik untuk bentuk natural)
    const numPoints = 6 + Math.floor(Math.random() * 5);
    const angleStep = (2 * Math.PI) / numPoints;

    const coordinates = [];

    // Buat titik-titik polygon dengan variasi radius untuk bentuk organik
    for (let i = 0; i <= numPoints; i++) {
        // +1 untuk menutup polygon
        const angle = i * angleStep;

        // Variasi radius per titik untuk bentuk tidak beraturan
        const radiusVariationPerPoint = 0.7 + Math.random() * 0.6; // 0.7 - 1.3
        const pointRadius = finalRadius * radiusVariationPerPoint;

        // Tambahkan noise untuk bentuk lebih natural
        const angleNoise = (Math.random() - 0.5) * 0.3;
        const adjustedAngle = angle + angleNoise;

        const pointLat = lat + pointRadius * Math.cos(adjustedAngle);
        const pointLng = lng + pointRadius * Math.sin(adjustedAngle);

        coordinates.push([pointLng, pointLat]);
    }

    // Pastikan polygon tertutup
    coordinates[coordinates.length - 1] = coordinates[0];

    return {
        type: "Feature",
        properties: {
            name: village.nama_desa,
            desaId: village.id,
            kelas: village.klas || "Tidak ada data",
            status: village.stat_pem || "Tidak ada data",
            centerLat: lat,
            centerLng: lng,
            originalLat: village.originalLat,
            originalLng: village.originalLng,
            boundaryType: "natural",
            area: calculatePolygonArea(coordinates),
        },
        geometry: {
            type: "Polygon",
            coordinates: [coordinates],
        },
    };
}

// Fungsi untuk menghitung luas polygon (perkiraan)
function calculatePolygonArea(coordinates) {
    let area = 0;
    const n = coordinates.length - 1; // Exclude closing point

    for (let i = 0; i < n; i++) {
        const j = (i + 1) % n;
        area += coordinates[i][0] * coordinates[j][1];
        area -= coordinates[j][0] * coordinates[i][1];
    }
    return Math.abs(area) / 2;
}

// Fungsi untuk membuat boundaries dengan bentuk natural
function createDesaBoundaries(villages) {
    if (!villages || villages.length === 0) {
        return [];
    }

    const validVillages = villages.filter((desa) => {
        const lat = parseFloat(desa.latitude);
        const lng = parseFloat(desa.longitude);
        return !isNaN(lat) && !isNaN(lng);
    });

    if (validVillages.length === 0) return [];

    // Buat spatial grid untuk menghindari overlap
    const spatialMappedVillages = createSpatialGrid(validVillages);

    return spatialMappedVillages
        .map((village, index) =>
            createNaturalBoundary(village, index, spatialMappedVillages.length)
        )
        .filter((boundary) => boundary !== null);
}

// Fungsi untuk menampilkan boundary desa dengan bentuk natural
function showBoundary(kecamatanId) {
    boundaryLayers.clearLayers();

    if (!kecamatanId || !desaData || desaData.length === 0) return;

    const kecamatan = kecamatanData.find((k) => k.id == kecamatanId);
    if (!kecamatan) return;

    // Buat boundaries natural untuk setiap desa
    const desaBoundaries = createDesaBoundaries(desaData);

    if (desaBoundaries.length === 0) return;

    // Array warna untuk variasi visual dengan palet yang lebih natural
    const colors = [
        "#22c55e", // Green
        "#3b82f6", // Blue
        "#f59e0b", // Amber
        "#ef4444", // Red
        "#8b5cf6", // Purple
        "#06b6d4", // Cyan
        "#84cc16", // Lime
        "#f97316", // Orange
        "#ec4899", // Pink
        "#6366f1", // Indigo
    ];

    desaBoundaries.forEach((geoJsonFeature, index) => {
        const color = colors[index % colors.length];
        const lighterColor = color + "40"; // Add transparency for fill

        const geoJsonLayer = L.geoJSON(geoJsonFeature, {
            style: {
                color: color,
                weight: 2,
                opacity: 0.8,
                fillColor: color,
                fillOpacity: 0.15,
                lineCap: "round",
                lineJoin: "round",
            },
            onEachFeature: function (feature, layer) {
                if (feature.properties) {
                    const props = feature.properties;
                    const areaKm2 = (props.area * 111 * 111).toFixed(3); // Rough conversion to km²

                    layer.bindPopup(
                        `
                        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                            <h4 style="margin: 0 0 10px 0; color: ${color}; display: flex; align-items: center;">
                                <span style="margin-right: 8px;">🏘️</span>
                                ${props.name}
                            </h4>
                            <div style="border-left: 3px solid ${color}; padding-left: 10px; margin: 8px 0;">
                                <p style="margin: 4px 0;"><strong>Kelas:</strong> ${
                                    props.kelas
                                }</p>
                                <p style="margin: 4px 0;"><strong>Status:</strong> ${
                                    props.status
                                }</p>
                                <div style="margin: 8px 0; font-size: 12px; color: #666;">
                                    <strong>Pusat Desa (Adjusted):</strong><br>
                                    Lat: ${props.centerLat.toFixed(6)}<br>
                                    Lng: ${props.centerLng.toFixed(6)}
                                </div>
                                ${
                                    props.originalLat !== props.centerLat
                                        ? `
                                <div style="margin: 8px 0; font-size: 11px; color: #888;">
                                    <strong>Posisi Asli:</strong><br>
                                    Lat: ${props.originalLat.toFixed(6)}<br>
                                    Lng: ${props.originalLng.toFixed(6)}
                                </div>
                                `
                                        : ""
                                }
                                <div style="margin: 8px 0; font-size: 11px; color: #666;">
                                    <strong>Perkiraan Luas:</strong> ~${areaKm2} km²
                                </div>
                                <p style="margin: 4px 0; font-style: italic; color: #666; font-size: 11px;">
                                    Boundary natural dengan bentuk organik
                                </p>
                            </div>
                        </div>
                        `,
                        {
                            maxWidth: 320,
                            className: "custom-popup",
                        }
                    );

                    // Hover effects dengan animasi smooth
                    layer.on("mouseover", function (e) {
                        this.setStyle({
                            weight: 3,
                            opacity: 1.0,
                            fillOpacity: 0.25,
                        });
                    });

                    layer.on("mouseout", function (e) {
                        this.setStyle({
                            weight: 2,
                            opacity: 0.8,
                            fillOpacity: 0.15,
                        });
                    });

                    // Click event untuk highlight
                    layer.on("click", function (e) {
                        // Reset semua layers
                        boundaryLayers.eachLayer((l) => {
                            if (l.setStyle && l !== this) {
                                l.setStyle({
                                    weight: 2,
                                    opacity: 0.4,
                                    fillOpacity: 0.08,
                                });
                            }
                        });

                        // Highlight yang diklik
                        this.setStyle({
                            weight: 4,
                            opacity: 1.0,
                            fillOpacity: 0.3,
                        });
                    });
                }
            },
        });

        boundaryLayers.addLayer(geoJsonLayer);
    });
}

// Load kecamatan dari API
async function loadKecamatan() {
    try {
        showLoading(kecamatanSelect, "Memuat kecamatan...");
        const res = await fetch("map/kecamatan");
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        kecamatanData = await res.json();

        kecamatanSelect.innerHTML =
            '<option value="">-- Pilih Kecamatan --</option>';
        kecamatanData.forEach((kec) => {
            const option = document.createElement("option");
            option.value = kec.id;
            option.textContent = kec.nama_kecamatan;
            kecamatanSelect.appendChild(option);
        });
        kecamatanSelect.disabled = false;

        desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
        desaSelect.disabled = true;
        kategoriSelect.innerHTML =
            '<option value="">-- Pilih Kategori --</option>';
        kategoriSelect.disabled = true;
    } catch (err) {
        showError("Gagal memuat data kecamatan: " + err.message);
        kecamatanSelect.innerHTML =
            '<option value="">Gagal memuat kecamatan</option>';
        kecamatanSelect.disabled = true;
    }
}

// Load desa berdasarkan kecamatan yang dipilih
async function loadDesa(kecamatanId) {
    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
    desaSelect.disabled = true;
    kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
    kategoriSelect.disabled = true;
    kategoriMarkers.clearLayers();
    desaMarkers.clearLayers();
    boundaryLayers.clearLayers();

    if (!kecamatanId) return;

    try {
        showLoading(desaSelect, "Memuat desa...");
        const res = await fetch(`map/desa/${kecamatanId}`);
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        desaData = await res.json();

        if (desaData.length === 0) {
            desaSelect.innerHTML = '<option value="">Tidak ada desa</option>';
            desaSelect.disabled = true;
            return;
        }

        desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
        desaData.forEach((desa) => {
            const option = document.createElement("option");
            option.value = desa.id;
            option.textContent = desa.nama_desa;
            desaSelect.appendChild(option);
        });
        desaSelect.disabled = false;

        showDesaMarkers(desaData);

        // Auto-show boundary ketika kecamatan dipilih
        showBoundary(kecamatanId);
    } catch (err) {
        showError("Gagal memuat data desa: " + err.message);
        desaSelect.innerHTML = '<option value="">Gagal memuat desa</option>';
        desaSelect.disabled = true;
    }
}

// Load kategori berdasarkan desa yang dipilih dan parsing data menggunakan parseKategoriResponse
async function loadKategori(desaId) {
    kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
    kategoriSelect.disabled = true;
    kategoriMarkers.clearLayers();

    if (!desaId) return;

    try {
        showLoading(kategoriSelect, "Memuat kategori...");
        const res = await fetch(`map/desa/${desaId}/kategori-data`);
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        const rawKategoriData = await res.json();

        // Parsing dengan fungsi yang sudah kita pisah
        kategoriData = parseKategoriResponse(rawKategoriData);

        if (kategoriData.length === 0) {
            kategoriSelect.innerHTML =
                '<option value="">Tidak ada kategori</option>';
            kategoriSelect.disabled = true;
            return;
        }

        kategoriSelect.innerHTML =
            '<option value="">-- Pilih Kategori --</option>';
        kategoriData.forEach((kategori) => {
            const option = document.createElement("option");
            option.value = kategori.id;
            option.textContent = `${kategori.nama} (${kategori.tipe})`;
            kategoriSelect.appendChild(option);
        });
        kategoriSelect.disabled = false;

        showKategoriMarkers(kategoriData);
    } catch (err) {
        showError("Gagal memuat data kategori: " + err.message);
        kategoriSelect.innerHTML =
            '<option value="">Gagal memuat kategori</option>';
        kategoriSelect.disabled = true;
    }
}

// Fungsi tampilkan marker desa dengan style yang ditingkatkan
function showDesaMarkers(desas) {
    desaMarkers.clearLayers();
    kategoriMarkers.clearLayers();

    if (!desas || desas.length === 0) return;

    desas.forEach((desa) => {
        if (!desa.latitude || !desa.longitude) {
            console.warn(
                `Desa ${desa.nama_desa} tidak memiliki koordinat yang valid`
            );
            return;
        }

        const lat = parseFloat(desa.latitude);
        const lng = parseFloat(desa.longitude);
        if (isNaN(lat) || isNaN(lng)) {
            console.warn(
                `Koordinat desa ${desa.nama_desa} tidak valid: ${desa.latitude}, ${desa.longitude}`
            );
            return;
        }

        const marker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: "custom-div-icon",
                html: `<div class="desa-marker" style="
                    background-color: #2563eb; 
                    color: white; 
                    border-radius: 50%; 
                    width: 26px; 
                    height: 26px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-size: 12px; 
                    font-weight: bold; 
                    border: 2px solid white; 
                    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
                ">🏘️</div>`,
                iconSize: [26, 26],
                iconAnchor: [13, 13],
            }),
        });

        marker.bindPopup(
            `
            <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <h4 style="margin: 0 0 10px 0; color: #2563eb; display: flex; align-items: center;">
                    <span style="margin-right: 8px;">📍</span>
                    ${desa.nama_desa}
                </h4>
                <div style="border-left: 3px solid #2563eb; padding-left: 10px;">
                    <p style="margin: 4px 0;"><strong>Kelas:</strong> ${
                        desa.klas || "Tidak ada data"
                    }</p>
                    <p style="margin: 4px 0;"><strong>Status:</strong> ${
                        desa.stat_pem || "Tidak ada data"
                    }</p>
                    <p style="margin: 4px 0; font-size: 12px; color: #666;">
                        <strong>Koordinat:</strong> ${desa.latitude}, ${
                desa.longitude
            }
                    </p>
                </div>
            </div>
        `,
            {
                maxWidth: 300,
                className: "custom-popup-desa",
            }
        );

        desaMarkers.addLayer(marker);
    });

    if (desaMarkers.getLayers().length > 0) {
        const group = new L.featureGroup(desaMarkers.getLayers());
        map.fitBounds(group.getBounds().pad(0.1));
    }
}

// Fungsi tampilkan marker kategori
function showKategoriMarkers(kategoris) {
    kategoriMarkers.clearLayers();

    if (!kategoris || kategoris.length === 0) return;

    const iconMap = {
        "Tempat Ibadah": "🕌",
        Sekolah: "🏫",
        Kesehatan: "🏥",
        Transportasi: "✈️",
        Pemerintahan: "🏛️",
        Perdagangan: "🏪",
        Wisata: "🏖️",
        Perkantoran: "🏢",
        Olahraga: "⚽",
        Lainnya: "❓",
    };

    kategoris.forEach((kategori) => {
        if (!kategori.latitude || !kategori.longitude) {
            console.warn(
                `Kategori ${kategori.nama} tidak memiliki koordinat valid`
            );
            return;
        }

        const lat = parseFloat(kategori.latitude);
        const lng = parseFloat(kategori.longitude);
        if (isNaN(lat) || isNaN(lng)) return;

        const iconEmoji = iconMap[kategori.tipe] || "📍";

        const marker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: "custom-div-icon",
                html: `<div class="kategori-marker" style="
                    background-color: #dc2626; 
                    color: white; 
                    border-radius: 50%; 
                    width: 28px; 
                    height: 28px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-size: 16px; 
                    font-weight: bold; 
                    border: 2px solid white; 
                    box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
                ">${iconEmoji}</div>`,
                iconSize: [28, 28],
                iconAnchor: [14, 14],
            }),
        });

        marker.bindPopup(`
            <div>
                <h4>${kategori.nama}</h4>
                <p><strong>Tipe:</strong> ${kategori.tipe}</p>
                <p><strong>Alamat:</strong> ${
                    kategori.alamat || "Tidak ada data"
                }</p>
                <p><strong>Koordinat:</strong> ${kategori.latitude}, ${
            kategori.longitude
        }</p>
            </div>
        `);

        kategoriMarkers.addLayer(marker);
    });

    if (kategoriMarkers.getLayers().length > 0) {
        const group = new L.featureGroup(kategoriMarkers.getLayers());
        map.fitBounds(group.getBounds().pad(0.1));
    }
}

// Event listeners
kecamatanSelect.addEventListener("change", () => {
    const kecId = kecamatanSelect.value;
    loadDesa(kecId);
    infoPanel.classList.add("hidden");
    desaSelect.value = "";
    kategoriSelect.value = "";
});

// Event listener untuk desa selection dengan boundary individual
desaSelect.addEventListener("change", () => {
    const desaId = desaSelect.value;

    if (!desaId) {
        // Jika tidak ada desa dipilih, tampilkan semua boundary
        loadKategori(desaId);
        infoPanel.classList.add("hidden");
        kategoriSelect.value = "";

        // Tampilkan kembali semua boundary desa
        const currentKecId = kecamatanSelect.value;
        if (currentKecId) {
            showBoundary(currentKecId);
        }
        return;
    }

    // Highlight boundary desa yang dipilih
    highlightSelectedDesaBoundary(desaId);

    loadKategori(desaId);
    infoPanel.classList.add("hidden");
    kategoriSelect.value = "";
});

// Fungsi untuk highlight boundary desa yang dipilih
function highlightSelectedDesaBoundary(desaId) {
    const selectedDesa = desaData.find((desa) => desa.id == desaId);
    if (!selectedDesa) return;

    // Reset semua boundaries ke style normal
    boundaryLayers.eachLayer((layer) => {
        if (layer.setStyle) {
            layer.setStyle({
                weight: 2,
                opacity: 0.3,
                fillOpacity: 0.08,
            });
        }
    });

    // Highlight boundary desa yang dipilih
    boundaryLayers.eachLayer((layer) => {
        if (layer.feature && layer.feature.properties.desaId == desaId) {
            layer.setStyle({
                weight: 4,
                opacity: 1.0,
                fillOpacity: 0.3,
            });

            // Zoom ke desa yang dipilih
            const bounds = layer.getBounds();
            map.fitBounds(bounds, { padding: [20, 20] });

            // Buka popup
            layer.openPopup();
        }
    });
}

kategoriSelect.addEventListener("change", () => {
    const kategoriId = kategoriSelect.value;
    if (!kategoriId) {
        infoPanel.classList.add("hidden");
        return;
    }

    const kategori = kategoriData.find((k) => k.id == kategoriId);
    if (!kategori) {
        infoPanel.classList.add("hidden");
        return;
    }

    infoContent.innerHTML = `
        <h3>${kategori.nama}</h3>
        <p><strong>Tipe:</strong> ${kategori.tipe}</p>
        <p><strong>Alamat:</strong> ${kategori.alamat || "Tidak ada data"}</p>
        <p><strong>Koordinat:</strong> ${kategori.latitude}, ${
        kategori.longitude
    }</p>
    `;
    infoPanel.classList.remove("hidden");

    const marker = kategoriMarkers.getLayers().find((m) => {
        const latLng = m.getLatLng();
        return (
            latLng.lat == kategori.latitude && latLng.lng == kategori.longitude
        );
    });
    if (marker) {
        map.setView(marker.getLatLng(), 15);
        marker.openPopup();
    }
});

// Event listener untuk toggle boundary dengan animasi yang ditingkatkan
document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const toggleButton = document.getElementById("toggleBoundary");
        if (toggleButton) {
            let boundaryVisible = true;

            toggleButton.addEventListener("click", () => {
                // Tambahkan efek klik
                toggleButton.style.transform = "scale(0.95)";
                setTimeout(() => {
                    toggleButton.style.transform = "scale(1)";
                }, 100);

                if (boundaryVisible) {
                    // Sembunyikan boundary dengan fade effect
                    boundaryLayers.eachLayer((layer) => {
                        if (layer.setStyle) {
                            layer.setStyle({ opacity: 0, fillOpacity: 0 });
                        }
                    });

                    setTimeout(() => {
                        boundaryLayers.clearLayers();
                    }, 200);

                    toggleButton.innerHTML = `
                        <span>🗺️</span>
                        <span>Tampilkan Batas</span>
                    `;
                    toggleButton.className = "boundary-hidden";
                    toggleButton.style.backgroundColor = "white";
                    toggleButton.style.color = "#333";
                    toggleButton.style.borderColor = "rgba(0,0,0,0.2)";
                    toggleButton.style.boxShadow = "0 2px 8px rgba(0,0,0,0.1)";
                } else {
                    const currentKecId = kecamatanSelect.value;
                    if (currentKecId) {
                        showBoundary(currentKecId);
                    }
                    toggleButton.innerHTML = `
                        <span>🗺️</span>
                        <span>Sembunyikan Batas</span>
                    `;
                    toggleButton.className = "boundary-visible";
                    toggleButton.style.backgroundColor = "#e53e3e";
                    toggleButton.style.color = "white";
                    toggleButton.style.borderColor = "#e53e3e";
                    toggleButton.style.boxShadow =
                        "0 2px 8px rgba(229, 62, 62, 0.3)";
                }
                boundaryVisible = !boundaryVisible;
            });
        }
    }, 100);
});

loadKecamatan();
