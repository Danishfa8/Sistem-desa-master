@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Greeting --}}
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p class="text-muted mb-0">Berikut ringkasan data Sistem Informasi Desa.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Cards --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <p class="text-uppercase fw-medium text-muted mb-0">Total Users</p>
                    <h4 class="mt-4 text-secondary">{{ $userCount }}</h4>
                    <div class="mt-2 text-muted">Jumlah semua pengguna</div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <p class="text-uppercase fw-medium text-muted mb-0">Total Desa</p>
                    <h4 class="mt-4 text-secondary">{{ $desaCount }}</h4>
                    <div class="mt-2 text-muted">Jumlah semua desa</div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <p class="text-uppercase fw-medium text-muted mb-0">Total Kecamatan</p>
                    <h4 class="mt-4 text-secondary">{{ $kecamatanCount }}</h4>
                    <div class="mt-2 text-muted">Jumlah semua kecamatan</div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <p class="text-uppercase fw-medium text-muted mb-0">Total Data</p>
                    <h4 class="mt-4 text-secondary">{{ $totalData }}</h4>
                    <div class="mt-2 text-muted">Jumlah total dari semua tabel</div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->

    {{-- Bar Chart --}}
<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title mb-4">Diagram Total Data per Tabel</h4>
                
                {{-- Tambahkan height secara eksplisit di wrapper div --}}
                <div style="height: 300px;">
                    <canvas id="dataBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


</div><!-- container-fluid -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dataBarChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($tableCounts)) !!},
            datasets: [{
                label: 'Jumlah Data',
                data: {!! json_encode(array_values($tableCounts)) !!},
                backgroundColor: 'rgba(53, 119, 241, 0.8)',
                borderColor: 'rgba(53, 119, 241, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 30,
                        minRotation: 30
                    }
                }
            }
        }
    });
</script>

@endsection
