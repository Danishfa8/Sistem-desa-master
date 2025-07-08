<div id="map" class="w-full" style="height: 100vh; z-index: 0;"></div>

{{-- Legend --}}
<style>
    .legend {
        position: absolute;
        bottom: 20px;
        left: 20px;
        z-index: 10;
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
    <div class="legend-item"><img src="{{ asset('assets/icons/masjid.png') }}" class="legend-icon"> <span>Masjid / Mushola</span></div>
    <div class="legend-item"><img src="{{ asset('assets/icons/gereja.png') }}" class="legend-icon"> <span>Gereja</span></div>
    <div class="legend-item"><img src="{{ asset('assets/icons/pura.png') }}" class="legend-icon"> <span>Pura</span></div>
    <div class="legend-item"><img src="{{ asset('assets/icons/vihara.png') }}" class="legend-icon"> <span>Vihara</span></div>
    <div class="legend-item"><img src="{{ asset('assets/icons/kelenteng.png') }}" class="legend-icon"> <span>Kelenteng</span></div>
    <div class="legend-item"><img src="{{ asset('assets/icons/kantoragama.png') }}" class="legend-icon"> <span>Kantor Keagamaan</span></div>
</div>

@if($saranaIbadahMarkers->isEmpty())
    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 bg-white bg-opacity-90 text-gray-700 font-semibold text-sm px-4 py-2 rounded shadow z-[999]">
        Tidak ada data sarana ibadah untuk ditampilkan di desa ini.
    </div>
@endif

@foreach ($saranaIbadahMarkers as $saranaIbadahDesa)
    @include('layouts.partials.modal.frontend.saranaibadah_modal', ['saranaIbadahDesa' => $saranaIbadahDesa])
@endforeach

<script>
    const map = L.map('map').setView([
        {{ $desaLat ?? '-6.9514' }},
        {{ $desaLng ?? '109.4275' }}
    ], 15);

    const baseLayers = {
        "Peta Jalan": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }),
        "Peta Satelit": L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri',
            maxZoom: 19
        })
    };

    baseLayers["Peta Jalan"].addTo(map);
    L.control.layers(baseLayers).addTo(map);

    const markers = L.markerClusterGroup({
        maxClusterRadius: 60,
        disableClusteringAtZoom: 17,
        // zoomToBoundsOnClick: false
    });

    const iconMap = {
        'Masjid': '{{ asset("assets/icons/masjid.png") }}',
        'Mushola': '{{ asset("assets/icons/masjid.png") }}',
        'Gereja': '{{ asset("assets/icons/gereja.png") }}',
        'Pura': '{{ asset("assets/icons/pura.png") }}',
        'Vihara': '{{ asset("assets/icons/vihara.png") }}',
        'Kelenteng': '{{ asset("assets/icons/kelenteng.png") }}',
        'Kantor Lembaga Keagamaan': '{{ asset("assets/icons/kantoragama.png") }}',
    };

    @foreach ($saranaIbadahMarkers as $saranaIbadahDesa)
        {
            const iconUrl = iconMap["{{ $saranaIbadahDesa->jenis_sarana_ibadah }}"] || '{{ asset("assets/icons/masjid.png") }}';

            const icon = L.icon({
                iconUrl: iconUrl,
                iconSize: [32, 37],
                iconAnchor: [16, 37],
                popupAnchor: [0, -30]
            });

            const marker = L.marker(
                [{{ $saranaIbadahDesa->latitude }}, {{ $saranaIbadahDesa->longitude }}],
                { icon: icon }
            );

            marker.on('click', function () {
                openModal('{{ $saranaIbadahDesa->id }}');
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
    }

    markers.on('clusterclick', function (e) {
        map.fitBounds(e.layer.getBounds(), {
            padding: [30, 30],
            maxZoom: 15
        });
    });

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
