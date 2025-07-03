<li class="nav-item">
    <a href="{{ url('admin_kabupaten/dashboard') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/dashboard' ? 'active' : '' }}">
        <i data-feather="home"></i>Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/kecamatans') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/kecamatans' ? 'active' : '' }}">
        <i data-feather="globe"></i>Kecamatan
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Data Desa</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/desas') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/desas' ? 'active' : '' }}">
        <i data-feather="grid"></i>Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/rt-rw-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/rt-rw-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>RT/RW
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/perangkat-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/perangkat-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>Perangkat Desa
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/profile-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/profile-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>Profile Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/pendapatan-desas') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/pendapatan-desas' ? 'active' : '' }}">
        <i data-feather="dollar-sign"></i>Pendapatan Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/pengeluaran') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/pengeluaran' ? 'active' : '' }}">
        <i data-feather="dollar-sign"></i>Pengeluaran Desa
    </a>
</li>


<li class="menu-title"><span data-key="t-menu">Kelembagaan</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/kelembagaan-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/kelembagaan-desa' ? 'active' : '' }}">
        <i data-feather="users"></i>Kelembagaan
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/bumdes') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/bumdes' ? 'active' : '' }}">
        <i data-feather="shopping-bag"></i>BUMDES
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/lpmdk') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/lpmdk' ? 'active' : '' }}">
        <i data-feather="slack"></i>LPMD/LPMK
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/pkk-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/pkk-desa' ? 'active' : '' }}">
        <i data-feather="award"></i>TP PKK
    </a>
</li>
<li class="menu-title"><span data-key="t-menu">Infrastruktur</span></li>
<li class="nav-item">
    <a href="{{ url('admin_kabupaten/jembatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/jembatan-desa' ? 'active' : '' }}">
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
                <a href="{{ url('admin_kabupaten/jalan-desa') }}"
                    class="nav-link {{ $current_url == 'admin_kabupaten/jalan-desa' ? 'active' : '' }}"
                    data-key="t-analytics">
                    Jalan Desa
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin_kabupaten/jalan-kabupaten-desa') }}"
                    class="nav-link {{ $current_url == 'admin_kabupaten/jalan-kabupaten-desa' ? 'active' : '' }}"
                    data-key="t-crm">
                    Jalan Kabupaten
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="menu-title"><span data-key="t-menu">Sosial</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/kerawanan-sosial-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/kerawanan-sosial-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Kerawanan Sosial
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/kondisi-lingkungan-keluarga-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/kondisi-lingkungan-keluarga-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Kondisi Lingkungan Keluarga
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/tempat-tinggal-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/tempat-tinggal-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Tempat Tinggal
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/disabilitas-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/disabilitas-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Disabilitas
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/balita-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/balita-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Balita
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/lansia-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/lansia-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Lansia
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/pendidikan-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/pendidikan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Pendidikan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/olahraga-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/olahraga-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Olahraga
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/pelaku-umkm-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/pelaku-umkm-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Pelaku UMKM
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Sarana & Prasarana</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/sarana-kesehatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/sarana-kesehatan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Kesehatan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/sarana-pendukung-kesehatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/sarana-pendukung-kesehatan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Pendukung Kesehatan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/sarana-ibadah-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/sarana-ibadah-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Ibadah
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/ekonomi') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/ekonomi' ? 'active' : '' }}">
        <i data-feather="settings"></i>Ekonomi
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/usaha-ekonomi') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/usaha-ekonomi' ? 'active' : '' }}">
        <i data-feather="settings"></i>Usaha Ekonomi
    </a>
</li>


<li class="nav-item">
    <a href="{{ url('admin_kabupaten/sarana-lainya-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/sarana-lainya-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Lainnya
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Industri & Energi</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/industri-penghasil-limbah-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/industri-penghasil-limbah-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Industri Penghasil Limbah
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/energi-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/energi-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Energi
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Sumber Daya</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/sumber-daya-alam-desa') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/sumber-daya-alam-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sumber Daya Alam
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Pengaturan Menu</span></li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/settings') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/settings' ? 'active' : '' }}">
        <i data-feather="settings"></i>Settings Website
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_kabupaten/users') }}"
        class="nav-link {{ $current_url == 'admin_kabupaten/users' ? 'active' : '' }}">
        <i data-feather="users"></i>Manajemen Pengguna
    </a>
</li>
