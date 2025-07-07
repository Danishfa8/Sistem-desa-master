<div id="map" style="width: 100%; height: 100%; min-height: 600px; z-index: 0;"></div>

<style>
    .legend {
        position: absolute;
        bottom: 20px;
        left: 20px;
        z-index: 40;
        background: white;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .legend-title {
        font-weight: bold;
        margin-bottom: 8px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .legend-icon {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }
</style>

<div class="legend">
    <div class="legend-title">Legenda Peta</div>
    <div class="legend-item">
        <img src="{{ asset('assets/icons/sekolah.ico') }}" class="legend-icon" alt="Ikon Sekolah">
        <span>Sarana Pendidikan</span>
    </div>
</div>

@if($pendidikanMarkers->isEmpty())
    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 bg-white bg-opacity-90 text-gray-700 font-semibold text-sm px-4 py-2 rounded shadow z-[999]">
        Tidak ada data pendidikan untuk ditampilkan di desa ini.
    </div>
@endif

{{-- Render semua modal pendidikan --}}
@foreach ($pendidikanMarkers as $item)
    @include('layouts.partials.modal.frontend.pendidikan_modal', ['pendidikan' => $item])
@endforeach

<script>
    const jalanLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    });

    const satelitLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri',
        maxZoom: 19
    });

    const map = L.map('map', { layers: [jalanLayer] });

    const baseLayers = {
        "Peta Jalan": jalanLayer,
        "Peta Satelit": satelitLayer
    };
    L.control.layers(baseLayers).addTo(map);

    const markers = L.markerClusterGroup({
        maxClusterRadius: 50,
        disableClusteringAtZoom: 16,
        zoomToBoundsOnClick: false
    });

    const pendidikanIcon = L.icon({
        iconUrl: '{{ asset("assets/icons/sekolah.ico") }}',
        iconSize: [32, 37],
        iconAnchor: [16, 37],
        popupAnchor: [0, -30]
    });

    @foreach ($pendidikanMarkers as $item)
        {
            let marker = L.marker(
                [{{ $item->latitude }}, {{ $item->longitude }}],
                { icon: pendidikanIcon }
            );

            marker.on('click', () => {
                openModal('{{ $item->id }}');
            });

            markers.addLayer(marker);
        }
    @endforeach

    map.addLayer(markers);

    if (markers.getLayers().length > 0) {
        map.fitBounds(markers.getBounds(), {
            padding: [30, 30],
            maxZoom: 15
        });
    } else {
        map.setView([
            {{ $desaLat ?? '-6.9514' }},
            {{ $desaLng ?? '109.4275' }}
        ], 15);
    }

    markers.on('clusterclick', function (e) {
        map.fitBounds(e.layer.getBounds(), {
            padding: [30, 30],
            maxZoom: 15
        });
    });

    // Modal handlers
    function openModal(id) {
        const modal = document.getElementById('showModal' + id);
        if (modal) modal.classList.remove('hidden');
    }

    function closeModal(id) {
        const modal = document.getElementById('showModal' + id);
        if (modal) modal.classList.add('hidden');
    }

    function handleOutsideClick(event, id) {
        const modalContent = event.currentTarget.querySelector('.bg-white');
        if (!modalContent.contains(event.target)) {
            closeModal(id);
        }
    }

</script>
