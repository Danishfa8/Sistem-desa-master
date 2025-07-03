// LayerManager.js - Management layer berdasarkan koordinat desa

import { CoordinateUtils } from "./coordinateUtils.js";

export class LayerManager {
    constructor(map) {
        this.map = map;
        this.layers = new Map();
        this.overlayLayers = new Map();
        this.layerControl = null;
        this.currentDesaLayers = [];
    }

    // Inisialisasi layer control
    initializeLayerControl(baseLayers = {}) {
        if (!this.layerControl) {
            this.layerControl = L.control
                .layers(
                    baseLayers,
                    {},
                    {
                        position: "topright",
                        collapsed: false,
                    }
                )
                .addTo(this.map);
        }
        return this.layerControl;
    }

    // Buat layer berdasarkan data desa
    createDesaLayers(desaData) {
        this.clearDesaLayers();

        if (!desaData || desaData.length === 0) return;

        // Group desa berdasarkan kecamatan
        const desaByKecamatan = this.groupDesaByKecamatan(desaData);

        // Buat layer untuk setiap kecamatan
        Object.keys(desaByKecamatan).forEach((kecamatanName) => {
            const desas = desaByKecamatan[kecamatanName];
            const layerId = `desa_${kecamatanName
                .replace(/\s+/g, "_")
                .toLowerCase()}`;

            const layer = this.createDesaLayer(desas, kecamatanName);

            if (layer) {
                this.layers.set(layerId, {
                    layer,
                    name: `Desa ${kecamatanName}`,
                    type: "desa",
                    data: desas,
                });

                this.currentDesaLayers.push(layerId);

                // Tambahkan ke layer control
                if (this.layerControl) {
                    this.layerControl.addOverlay(
                        layer,
                        `📍 Desa ${kecamatanName}`
                    );
                }

                // Add to map by default
                layer.addTo(this.map);
            }
        });

        // Fit map ke bounds semua desa
        this.fitMapToBounds(desaData);
    }

    // Group desa berdasarkan kecamatan
    groupDesaByKecamatan(desaData) {
        const grouped = {};

        desaData.forEach((desa) => {
            const kecamatanName =
                desa.kecamatan_nama || desa.nama_kecamatan || "Unknown";

            if (!grouped[kecamatanName]) {
                grouped[kecamatanName] = [];
            }

            grouped[kecamatanName].push(desa);
        });

        return grouped;
    }

    // Buat layer untuk desa dalam satu kecamatan
    createDesaLayer(desas, kecamatanName) {
        const layerGroup = L.layerGroup();
        let validMarkerCount = 0;

        desas.forEach((desa) => {
            const coordinates = CoordinateUtils.parseCoordinates(
                desa.latitude,
                desa.longitude
            );

            if (!coordinates) {
                console.warn(
                    `Desa ${desa.nama_desa} tidak memiliki koordinat yang valid`
                );
                return;
            }

            const marker = this.createDesaMarker(desa, coordinates);
            if (marker) {
                layerGroup.addLayer(marker);
                validMarkerCount++;
            }
        });

        return validMarkerCount > 0 ? layerGroup : null;
    }

    // Buat marker untuk desa
    createDesaMarker(desa, coordinates) {
        const marker = L.marker([coordinates.lat, coordinates.lng], {
            icon: L.divIcon({
                className: "custom-desa-marker",
                html: `<div class="desa-marker-content">
                    <div class="desa-marker-icon">🏘️</div>
                    <div class="desa-marker-label">${desa.nama_desa}</div>
                </div>`,
                iconSize: [120, 40],
                iconAnchor: [60, 35],
            }),
        });

        // Popup untuk desa
        marker.bindPopup(this.createDesaPopupContent(desa), {
            maxWidth: 300,
            className: "custom-popup",
        });

        // Tooltip
        marker.bindTooltip(desa.nama_desa, {
            permanent: false,
            direction: "top",
            offset: [0, -25],
        });

        return marker;
    }

    // Buat konten popup untuk desa
    createDesaPopupContent(desa) {
        const coordinates = CoordinateUtils.formatCoordinates(
            desa.latitude,
            desa.longitude
        );

        return `
            <div class="desa-popup">
                <h4 class="popup-title">📍 ${desa.nama_desa}</h4>
                <div class="popup-content">
                    <p><strong>Kecamatan:</strong> ${
                        desa.kecamatan_nama || desa.nama_kecamatan || "N/A"
                    }</p>
                    <p><strong>Kelas:</strong> ${
                        desa.klas || "Tidak ada data"
                    }</p>
                    <p><strong>Status:</strong> ${
                        desa.stat_pem || "Tidak ada data"
                    }</p>
                    <p><strong>Koordinat:</strong> ${coordinates}</p>
                    ${
                        desa.jumlah_penduduk
                            ? `<p><strong>Penduduk:</strong> ${desa.jumlah_penduduk} jiwa</p>`
                            : ""
                    }
                    ${
                        desa.luas_wilayah
                            ? `<p><strong>Luas:</strong> ${desa.luas_wilayah} km²</p>`
                            : ""
                    }
                </div>
                <div class="popup-actions">
                    <button onclick="window.mapManager?.focusOnDesa('${
                        desa.id
                    }')" class="btn-focus">
                        🎯 Fokus ke Desa
                    </button>
                </div>
            </div>
        `;
    }

    // Buat layer berdasarkan kategori
    createKategoriLayers(kategoriData) {
        this.clearKategoriLayers();

        if (!kategoriData || kategoriData.length === 0) return;

        // Group kategori berdasarkan tipe
        const kategoriByType = this.groupKategoriByType(kategoriData);

        Object.keys(kategoriByType).forEach((typeName) => {
            const kategoris = kategoriByType[typeName];
            const layerId = `kategori_${typeName
                .replace(/\s+/g, "_")
                .toLowerCase()}`;

            const layer = this.createKategoriLayer(kategoris, typeName);

            if (layer) {
                this.layers.set(layerId, {
                    layer,
                    name: `Kategori ${typeName}`,
                    type: "kategori",
                    data: kategoris,
                });

                // Tambahkan ke layer control
                if (this.layerControl) {
                    const icon = this.getKategoriIcon(typeName);
                    this.layerControl.addOverlay(layer, `${icon} ${typeName}`);
                }

                // Add to map
                layer.addTo(this.map);
            }
        });
    }

    // Group kategori berdasarkan tipe
    groupKategoriByType(kategoriData) {
        const grouped = {};

        kategoriData.forEach((kategori) => {
            const typeName = kategori.tipe || "Lainnya";

            if (!grouped[typeName]) {
                grouped[typeName] = [];
            }

            grouped[typeName].push(kategori);
        });

        return grouped;
    }

    // Buat layer untuk kategori berdasarkan tipe
    createKategoriLayer(kategoris, typeName) {
        const layerGroup = L.layerGroup();
        let validMarkerCount = 0;

        kategoris.forEach((kategori) => {
            const coordinates = CoordinateUtils.parseCoordinates(
                kategori.latitude,
                kategori.longitude
            );

            if (!coordinates) {
                console.warn(
                    `Kategori ${kategori.nama} tidak memiliki koordinat yang valid`
                );
                return;
            }

            const marker = this.createKategoriMarker(
                kategori,
                coordinates,
                typeName
            );
            if (marker) {
                layerGroup.addLayer(marker);
                validMarkerCount++;
            }
        });

        return validMarkerCount > 0 ? layerGroup : null;
    }

    // Buat marker untuk kategori
    createKategoriMarker(kategori, coordinates, typeName) {
        const icon = this.getKategoriIcon(typeName);
        const color = this.getKategoriColor(typeName);

        const marker = L.marker([coordinates.lat, coordinates.lng], {
            icon: L.divIcon({
                className: "custom-kategori-marker",
                html: `<div style="background-color: ${color}; color: white; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">${icon}</div>`,
                iconSize: [28, 28],
                iconAnchor: [14, 14],
            }),
        });

        // Popup untuk kategori
        marker.bindPopup(this.createKategoriPopupContent(kategori), {
            maxWidth: 300,
            className: "custom-popup",
        });

        return marker;
    }

    // Buat konten popup untuk kategori
    createKategoriPopupContent(kategori) {
        const coordinates = CoordinateUtils.formatCoordinates(
            kategori.latitude,
            kategori.longitude
        );

        return `
            <div class="kategori-popup">
                <h4 class="popup-title">${kategori.nama}</h4>
                <div class="popup-content">
                    <p><strong>Tipe:</strong> ${kategori.tipe}</p>
                    <p><strong>Alamat:</strong> ${
                        kategori.alamat || "Tidak ada data"
                    }</p>
                    <p><strong>Koordinat:</strong> ${coordinates}</p>
                    ${
                        kategori.deskripsi
                            ? `<p><strong>Deskripsi:</strong> ${kategori.deskripsi}</p>`
                            : ""
                    }
                </div>
            </div>
        `;
    }

    // Get icon untuk kategori
    getKategoriIcon(tipe) {
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
        return iconMap[tipe] || "📍";
    }

    // Get color untuk kategori
    getKategoriColor(tipe) {
        const colorMap = {
            "Tempat Ibadah": "#4CAF50",
            Sekolah: "#2196F3",
            Kesehatan: "#F44336",
            Transportasi: "#FF9800",
            Pemerintahan: "#9C27B0",
            Perdagangan: "#00BCD4",
            Wisata: "#8BC34A",
            Perkantoran: "#607D8B",
            Olahraga: "#FF5722",
            Lainnya: "#795548",
        };
        return colorMap[tipe] || "#9E9E9E";
    }

    // Fit map ke bounds data
    fitMapToBounds(data) {
        const bounds = CoordinateUtils.calculateBounds(data);
        if (bounds) {
            this.map.fitBounds([bounds.southWest, bounds.northEast], {
                padding: [20, 20],
                maxZoom: 15,
            });
        }
    }

    // Clear semua layer desa
    clearDesaLayers() {
        this.currentDesaLayers.forEach((layerId) => {
            this.removeLayer(layerId);
        });
        this.currentDesaLayers = [];
    }

    // Clear semua layer kategori
    clearKategoriLayers() {
        const kategoriLayers = Array.from(this.layers.keys()).filter((id) =>
            id.startsWith("kategori_")
        );
        kategoriLayers.forEach((layerId) => {
            this.removeLayer(layerId);
        });
    }

    // Remove layer
    removeLayer(layerId) {
        const layerInfo = this.layers.get(layerId);
        if (layerInfo) {
            this.map.removeLayer(layerInfo.layer);

            if (this.layerControl) {
                this.layerControl.removeLayer(layerInfo.layer);
            }

            this.layers.delete(layerId);
        }
    }

    // Toggle layer visibility
    toggleLayer(layerId) {
        const layerInfo = this.layers.get(layerId);
        if (layerInfo) {
            if (this.map.hasLayer(layerInfo.layer)) {
                this.map.removeLayer(layerInfo.layer);
            } else {
                layerInfo.layer.addTo(this.map);
            }
        }
    }

    // Get layer info
    getLayerInfo(layerId) {
        return this.layers.get(layerId);
    }

    // Get all layers
    getAllLayers() {
        return Array.from(this.layers.entries()).map(([id, info]) => ({
            id,
            ...info,
        }));
    }
}
