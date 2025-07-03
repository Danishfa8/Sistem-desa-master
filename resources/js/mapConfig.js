import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { BoundaryManager } from "./boundaryManager.js";

// Kelas untuk mengelola konfigurasi peta dan layer
export class MapConfig {
    constructor(
        mapElementId,
        initialView = [-6.9175, 107.6191],
        initialZoom = 12
    ) {
        this.map = L.map(mapElementId).setView(initialView, initialZoom);
        this.initializeLayers();
        this.initializeLayerControl();

        // Initialize boundary manager
        this.boundaryManager = new BoundaryManager(this.map);
    }

    initializeLayers() {
        // Base tile layers
        this.baseLayers = {
            OpenStreetMap: L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {
                    attribution: "© OpenStreetMap contributors",
                    maxZoom: 19,
                }
            ),
            "CartoDB Positron": L.tileLayer(
                "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png",
                {
                    attribution: "© OpenStreetMap contributors © CARTO",
                    maxZoom: 19,
                }
            ),
            "CartoDB Dark Matter": L.tileLayer(
                "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
                {
                    attribution: "© OpenStreetMap contributors © CARTO",
                    maxZoom: 19,
                }
            ),
            Satellite: L.tileLayer(
                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                {
                    attribution:
                        "© Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community",
                    maxZoom: 19,
                }
            ),
        };

        // Administrative boundary layers (overlay layers) - External WMS
        this.overlayLayers = {
            "Batas Administrasi": L.tileLayer(
                "https://tiles.stadiamaps.com/tiles/stamen_toner_lines/{z}/{x}/{y}{r}.png",
                {
                    attribution:
                        "© Stadia Maps © Stamen Design © OpenMapTiles © OpenStreetMap contributors",
                    opacity: 0.6,
                    maxZoom: 19,
                }
            ),
            "WMS Batas Desa/Kelurahan": L.tileLayer.wms(
                "https://geoserver.big.go.id/geoserver/RBI/wms",
                {
                    layers: "RBI:batas_desa_or_kelurahan_indonesia",
                    format: "image/png",
                    transparent: true,
                    attribution: "© Badan Informasi Geospasial (BIG) Indonesia",
                    opacity: 0.4,
                    maxZoom: 19,
                }
            ),
            "WMS Batas Kecamatan": L.tileLayer.wms(
                "https://geoserver.big.go.id/geoserver/RBI/wms",
                {
                    layers: "RBI:batas_kecamatan_indonesia",
                    format: "image/png",
                    transparent: true,
                    attribution: "© Badan Informasi Geospasial (BIG) Indonesia",
                    opacity: 0.4,
                    maxZoom: 19,
                }
            ),
            "WMS Batas Kabupaten/Kota": L.tileLayer.wms(
                "https://geoserver.big.go.id/geoserver/RBI/wms",
                {
                    layers: "RBI:batas_kabupaten_or_kota_indonesia",
                    format: "image/png",
                    transparent: true,
                    attribution: "© Badan Informasi Geospasial (BIG) Indonesia",
                    opacity: 0.4,
                    maxZoom: 19,
                }
            ),
        };

        // Add default base layer
        this.baseLayers["OpenStreetMap"].addTo(this.map);

        // Marker layer groups
        this.desaMarkers = L.layerGroup().addTo(this.map);
        this.kategoriMarkers = L.layerGroup().addTo(this.map);

        // Add marker layers to overlay
        this.overlayLayers["Marker Desa"] = this.desaMarkers;
        this.overlayLayers["Marker Kategori"] = this.kategoriMarkers;
    }

    initializeLayerControl() {
        // Layer control untuk switching antara base maps dan overlay
        this.layerControl = L.control
            .layers(this.baseLayers, this.overlayLayers, {
                position: "topright",
                collapsed: false,
            })
            .addTo(this.map);

        // Custom control untuk administrative boundaries
        this.createAdminBoundaryControl();
    }

    createAdminBoundaryControl() {
        const AdminBoundaryControl = L.Control.extend({
            onAdd: function (map) {
                const div = L.DomUtil.create(
                    "div",
                    "leaflet-control-admin-boundary"
                );
                div.style.backgroundColor = "white";
                div.style.padding = "12px";
                div.style.borderRadius = "8px";
                div.style.boxShadow = "0 3px 10px rgba(0,0,0,0.2)";
                div.style.fontSize = "13px";
                div.style.lineHeight = "1.4";
                div.style.minWidth = "200px";

                div.innerHTML = `
                    <div style="font-weight: bold; margin-bottom: 8px; color: #333; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                        🗺️ Batas Wilayah
                    </div>
                    <div style="margin-bottom: 10px;">
                        <div style="font-weight: 600; color: #666; margin-bottom: 4px; font-size: 11px;">CUSTOM BOUNDARIES</div>
                        <label style="display: block; margin-bottom: 4px; cursor: pointer;">
                            <input type="checkbox" id="custom-desa" style="margin-right: 8px;">
                            <span style="color: #ff6b6b;">●</span> Batas Desa (Custom)
                        </label>
                        <label style="display: block; margin-bottom: 6px; cursor: pointer;">
                            <input type="checkbox" id="custom-kecamatan" style="margin-right: 8px;">
                            <span style="color: #4ecdc4;">●</span> Batas Kecamatan (Custom)
                        </label>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #666; margin-bottom: 4px; font-size: 11px;">WMS LAYERS</div>
                        <label style="display: block; margin-bottom: 4px; cursor: pointer;">
                            <input type="checkbox" id="wms-desa" style="margin-right: 8px;">
                            <span style="color: #888;">●</span> WMS Desa/Kelurahan
                        </label>
                        <label style="display: block; margin-bottom: 4px; cursor: pointer;">
                            <input type="checkbox" id="wms-kecamatan" style="margin-right: 8px;">
                            <span style="color: #888;">●</span> WMS Kecamatan
                        </label>
                        <label style="display: block; cursor: pointer;">
                            <input type="checkbox" id="wms-kabupaten" style="margin-right: 8px;">
                            <span style="color: #888;">●</span> WMS Kabupaten/Kota
                        </label>
                    </div>
                `;

                // Prevent map interaction when clicking on control
                L.DomEvent.disableClickPropagation(div);
                L.DomEvent.disableScrollPropagation(div);
                return div;
            },
            onRemove: function (map) {
                // cleanup
            },
        });

        this.adminControl = new AdminBoundaryControl({ position: "topleft" });
        this.adminControl.addTo(this.map);

        // Event listeners untuk admin boundary checkboxes
        this.setupAdminBoundaryEvents();
    }

    setupAdminBoundaryEvents() {
        // Tunggu control ditambahkan ke DOM
        setTimeout(() => {
            // Custom boundary controls
            const customDesaCheckbox = document.getElementById("custom-desa");
            const customKecamatanCheckbox =
                document.getElementById("custom-kecamatan");

            // WMS layer controls
            const wmsDesaCheckbox = document.getElementById("wms-desa");
            const wmsKecamatanCheckbox =
                document.getElementById("wms-kecamatan");
            const wmsKabupatenCheckbox =
                document.getElementById("wms-kabupaten");

            // Custom boundary events
            if (customDesaCheckbox) {
                customDesaCheckbox.addEventListener("change", (e) => {
                    this.boundaryManager.toggleDesaBoundary(e.target.checked);
                });
            }

            if (customKecamatanCheckbox) {
                customKecamatanCheckbox.addEventListener("change", (e) => {
                    this.boundaryManager.toggleKecamatanBoundary(
                        e.target.checked
                    );
                });
            }

            // WMS layer events
            if (wmsDesaCheckbox) {
                wmsDesaCheckbox.addEventListener("change", (e) => {
                    if (e.target.checked) {
                        this.overlayLayers["WMS Batas Desa/Kelurahan"].addTo(
                            this.map
                        );
                    } else {
                        this.map.removeLayer(
                            this.overlayLayers["WMS Batas Desa/Kelurahan"]
                        );
                    }
                });
            }

            if (wmsKecamatanCheckbox) {
                wmsKecamatanCheckbox.addEventListener("change", (e) => {
                    if (e.target.checked) {
                        this.overlayLayers["WMS Batas Kecamatan"].addTo(
                            this.map
                        );
                    } else {
                        this.map.removeLayer(
                            this.overlayLayers["WMS Batas Kecamatan"]
                        );
                    }
                });
            }

            if (wmsKabupatenCheckbox) {
                wmsKabupatenCheckbox.addEventListener("change", (e) => {
                    if (e.target.checked) {
                        this.overlayLayers["WMS Batas Kabupaten/Kota"].addTo(
                            this.map
                        );
                    } else {
                        this.map.removeLayer(
                            this.overlayLayers["WMS Batas Kabupaten/Kota"]
                        );
                    }
                });
            }
        }, 100);
    }

    // Method untuk mengakses map instance
    getMap() {
        return this.map;
    }

    // Method untuk mengakses boundary manager
    getBoundaryManager() {
        return this.boundaryManager;
    }

    // Method untuk mengakses layer groups
    getDesaMarkers() {
        return this.desaMarkers;
    }

    getKategoriMarkers() {
        return this.kategoriMarkers;
    }

    // Method untuk fit bounds dengan padding
    fitBounds(layers, padding = 0.1) {
        if (layers && layers.length > 0) {
            const group = new L.featureGroup(layers);
            this.map.fitBounds(group.getBounds().pad(padding));
        }
    }

    // Method untuk set view ke koordinat tertentu
    setView(latlng, zoom = 15) {
        this.map.setView(latlng, zoom);
    }

    // Method untuk membersihkan semua marker
    clearAllMarkers() {
        this.desaMarkers.clearLayers();
        this.kategoriMarkers.clearLayers();
        this.boundaryManager.clearAllBoundaries();
    }

    // Method untuk toggle layer berdasarkan nama
    toggleOverlay(layerName, show = true) {
        const layer = this.overlayLayers[layerName];
        if (layer) {
            if (show) {
                layer.addTo(this.map);
            } else {
                this.map.removeLayer(layer);
            }
        }
    }

    // Method untuk update checkbox state
    updateBoundaryCheckbox(checkboxId, checked) {
        setTimeout(() => {
            const checkbox = document.getElementById(checkboxId);
            if (checkbox) {
                checkbox.checked = checked;
            }
        }, 100);
    }
}
