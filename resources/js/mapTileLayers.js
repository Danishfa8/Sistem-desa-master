// MapTileLayers.js - Konfigurasi dan management tile layers

export class MapTileLayers {
    constructor() {
        this.currentLayer = null;
        this.layerGroups = new Map();
        this.baseLayers = this.initializeBaseLayers();
    }

    initializeBaseLayers() {
        return {
            OpenStreetMap: {
                layer: L.tileLayer(
                    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                    {
                        attribution: "© OpenStreetMap contributors",
                        maxZoom: 19,
                    }
                ),
                name: "OpenStreetMap",
            },
            Satellite: {
                layer: L.tileLayer(
                    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                    {
                        attribution:
                            "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
                        maxZoom: 18,
                    }
                ),
                name: "Satellite",
            },
            Terrain: {
                layer: L.tileLayer(
                    "https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png",
                    {
                        attribution:
                            'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
                        maxZoom: 17,
                    }
                ),
                name: "Terrain",
            },
            CartoDB: {
                layer: L.tileLayer(
                    "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png",
                    {
                        attribution:
                            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                        subdomains: "abcd",
                        maxZoom: 19,
                    }
                ),
                name: "CartoDB Light",
            },
            Dark: {
                layer: L.tileLayer(
                    "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
                    {
                        attribution:
                            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                        subdomains: "abcd",
                        maxZoom: 19,
                    }
                ),
                name: "Dark Theme",
            },
        };
    }

    addToMap(map) {
        this.map = map;

        // Add default layer
        this.currentLayer = this.baseLayers["OpenStreetMap"].layer;
        this.currentLayer.addTo(map);

        // Create layer control
        this.createLayerControl();

        return this;
    }

    createLayerControl() {
        const baseLayersControl = {};

        Object.keys(this.baseLayers).forEach((key) => {
            baseLayersControl[this.baseLayers[key].name] =
                this.baseLayers[key].layer;
        });

        // Add layer control to map
        this.layerControl = L.control
            .layers(baseLayersControl, {})
            .addTo(this.map);

        return this.layerControl;
    }

    switchLayer(layerName) {
        if (this.baseLayers[layerName]) {
            if (this.currentLayer) {
                this.map.removeLayer(this.currentLayer);
            }

            this.currentLayer = this.baseLayers[layerName].layer;
            this.currentLayer.addTo(this.map);
        }
    }

    getCurrentLayer() {
        return this.currentLayer;
    }

    // Method untuk menambahkan custom tile layer
    addCustomLayer(name, url, options = {}) {
        const customLayer = L.tileLayer(url, {
            attribution: options.attribution || "",
            maxZoom: options.maxZoom || 18,
            ...options,
        });

        this.baseLayers[name] = {
            layer: customLayer,
            name: options.displayName || name,
        };

        // Update layer control jika sudah ada
        if (this.layerControl) {
            this.layerControl.addBaseLayer(
                customLayer,
                options.displayName || name
            );
        }

        return customLayer;
    }

    // Method untuk menghapus layer
    removeLayer(layerName) {
        if (this.baseLayers[layerName]) {
            const layer = this.baseLayers[layerName].layer;

            if (this.currentLayer === layer) {
                this.switchLayer("OpenStreetMap"); // Switch to default
            }

            if (this.layerControl) {
                this.layerControl.removeLayer(layer);
            }

            delete this.baseLayers[layerName];
        }
    }

    // Method untuk mendapatkan semua layer yang tersedia
    getAvailableLayers() {
        return Object.keys(this.baseLayers).map((key) => ({
            key,
            name: this.baseLayers[key].name,
        }));
    }
}
