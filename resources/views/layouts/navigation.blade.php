<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu"></div>
        @php
            $current_url = Request::path();
            $user = Auth::user();
        @endphp
        <ul class="navbar-nav" id="navbar-nav">
            {{-- Menu untuk Super Admin --}}
            @role('superadmin')
                <li class="nav-item">
                    <a href="{{ url('superadmin/dashboard') }}"
                        class="nav-link {{ $current_url == 'superadmin/dashboard' ? 'active' : '' }}">
                        <i data-feather="home"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/kecamatans') }}"
                        class="nav-link {{ $current_url == 'superadmin/kecamatans' ? 'active' : '' }}">
                        <i data-feather="globe"></i>Kecamatan
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Data Desa</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/desas') }}"
                        class="nav-link {{ $current_url == 'superadmin/desas' ? 'active' : '' }}">
                        <i data-feather="grid"></i>Desa
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/rt-rw-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/rt-rw-desa' ? 'active' : '' }}">
                        <i data-feather="grid"></i>RT/RW
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/perangkat-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/perangkat-desa' ? 'active' : '' }}">
                        <i data-feather="grid"></i>Perangkat Desa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/profile-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/profile-desa' ? 'active' : '' }}">
                        <i data-feather="grid"></i>Profile Desa
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/pendapatan-desas') }}"
                        class="nav-link {{ $current_url == 'superadmin/pendapatan-desas' ? 'active' : '' }}">
                        <i data-feather="dollar-sign"></i>Pendapatan Desa
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/pengeluaran') }}"
                        class="nav-link {{ $current_url == 'superadmin/pengeluaran' ? 'active' : '' }}">
                        <i data-feather="dollar-sign"></i>Pengeluaran Desa
                    </a>
                </li>


                <li class="menu-title"><span data-key="t-menu">Kelembagaan</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/kelembagaan-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/kelembagaan-desa' ? 'active' : '' }}">
                        <i data-feather="users"></i>Kelembagaan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/bumdes') }}"
                        class="nav-link {{ $current_url == 'superadmin/bumdes' ? 'active' : '' }}">
                        <i data-feather="shopping-bag"></i>BUMDES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/lpmdk') }}"
                        class="nav-link {{ $current_url == 'superadmin/lpmdk' ? 'active' : '' }}">
                        <i data-feather="slack"></i>LPMD/LPMK
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/pkk-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/pkk-desa' ? 'active' : '' }}">
                        <i data-feather="award"></i>TP PKK
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu">Infrastruktur</span></li>
                <li class="nav-item">
                    <a href="{{ url('superadmin/jembatan-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/jembatan-desa' ? 'active' : '' }}">
                        <i data-feather="home"></i>Data Jembatan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Data Jalan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('superadmin/jalan-desa') }}"
                                    class="nav-link {{ $current_url == 'superadmin/jalan-desa' ? 'active' : '' }}"
                                    data-key="t-analytics">
                                    Jalan Desa
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('superadmin/jalan-kabupaten-desa') }}"
                                    class="nav-link {{ $current_url == 'superadmin/jalan-kabupaten-desa' ? 'active' : '' }}"
                                    data-key="t-crm">
                                    Jalan Kabupaten
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Sosial</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/kerawanan-sosial-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/kerawanan-sosial-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Kerawanan Sosial
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/kondisi-lingkungan-keluarga-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/kondisi-lingkungan-keluarga-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Kondisi Lingkungan Keluarga
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/tempat-tinggal-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/tempat-tinggal-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Tempat Tinggal
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/disabilitas-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/disabilitas-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Disabilitas
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/balita-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/balita-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Balita
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/lansia-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/lansia-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Lansia
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/pendidikan-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/pendidikan-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Pendidikan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/olahraga-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/olahraga-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Olahraga
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/pelaku-umkm-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/pelaku-umkm-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Pelaku UMKM
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Sarana & Prasarana</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/sarana-kesehatan-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/sarana-kesehatan-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Sarana Kesehatan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/sarana-pendukung-kesehatan-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/sarana-pendukung-kesehatan-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Sarana Pendukung Kesehatan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/sarana-ibadah-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/sarana-ibadah-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Sarana Ibadah
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/ekonomi') }}"
                        class="nav-link {{ $current_url == 'superadmin/ekonomi' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Ekonomi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/usaha-ekonomi') }}"
                        class="nav-link {{ $current_url == 'superadmin/usaha-ekonomi' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Usaha Ekonomi
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url('superadmin/sarana-lainya-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/sarana-lainya-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Sarana Lainnya
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Industri & Energi</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/industri-penghasil-limbah-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/industri-penghasil-limbah-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Industri Penghasil Limbah
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/energi-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/energi-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Energi
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Sumber Daya</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/sumber-daya-alam-desa') }}"
                        class="nav-link {{ $current_url == 'superadmin/sumber-daya-alam-desa' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Sumber Daya Alam
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Pengaturan Menu</span></li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/settings') }}"
                        class="nav-link {{ $current_url == 'superadmin/settings' ? 'active' : '' }}">
                        <i data-feather="settings"></i>Settings Website
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('superadmin/users') }}"
                        class="nav-link {{ $current_url == 'superadmin/users' ? 'active' : '' }}">
                        <i data-feather="users"></i>Manajemen Pengguna
                    </a>
                </li>
            @endrole

            {{-- Menu untuk Admin Desa --}}
            @role('admin_desa')
                @include('layouts.partials.admin_desa')
            @endrole

            {{-- Menu untuk Admin Kabupaten --}}
            @role('admin_kabupaten')
                @include('layouts.partials.admin_kabupaten')
            @endrole
        </ul>
    </div>
    <!-- Sidebar -->
</div>
