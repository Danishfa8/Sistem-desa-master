<li class="nav-item">
    <a href="{{ url('admin_desa/dashboard') }}"
        class="nav-link {{ $current_url == 'admin_desa/dashboard' ? 'active' : '' }}">
        <i data-feather="home"></i>Dashboard
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/kecamatans') }}"
        class="nav-link {{ $current_url == 'admin_desa/kecamatans' ? 'active' : '' }}">
        <i data-feather="globe"></i>Kecamatan
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Data Desa</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/desas') }}" class="nav-link {{ $current_url == 'admin_desa/desas' ? 'active' : '' }}">
        <i data-feather="grid"></i>Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/rt-rw-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/rt-rw-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>RT/RW
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_desa/perangkat-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/perangkat-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>Perangkat Desa
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_desa/profile-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/profile-desa' ? 'active' : '' }}">
        <i data-feather="grid"></i>Profile Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/pendapatan-desas') }}"
        class="nav-link {{ $current_url == 'admin_desa/pendapatan-desas' ? 'active' : '' }}">
        <i data-feather="dollar-sign"></i>Pendapatan Desa
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/pengeluaran') }}"
        class="nav-link {{ $current_url == 'admin_desa/pengeluaran' ? 'active' : '' }}">
        <i data-feather="dollar-sign"></i>Pengeluaran Desa
    </a>
</li>


<li class="menu-title"><span data-key="t-menu">Kelembagaan</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/kelembagaan-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/kelembagaan-desa' ? 'active' : '' }}">
        <i data-feather="users"></i>Kelembagaan
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_desa/bumdes') }}"
        class="nav-link {{ $current_url == 'admin_desa/bumdes' ? 'active' : '' }}">
        <i data-feather="shopping-bag"></i>BUMDES
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_desa/lpmdk') }}" class="nav-link {{ $current_url == 'admin_desa/lpmdk' ? 'active' : '' }}">
        <i data-feather="slack"></i>LPMD/LPMK
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin_desa/pkk-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/pkk-desa' ? 'active' : '' }}">
        <i data-feather="award"></i>TP PKK
    </a>
</li>
<li class="menu-title"><span data-key="t-menu">Infrastruktur</span></li>
<li class="nav-item">
    <a href="{{ url('admin_desa/jembatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/jembatan-desa' ? 'active' : '' }}">
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
                <a href="{{ url('admin_desa/jalan-desa') }}"
                    class="nav-link {{ $current_url == 'admin_desa/jalan-desa' ? 'active' : '' }}"
                    data-key="t-analytics">
                    Jalan Desa
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin_desa/jalan-kabupaten-desa') }}"
                    class="nav-link {{ $current_url == 'admin_desa/jalan-kabupaten-desa' ? 'active' : '' }}"
                    data-key="t-crm">
                    Jalan Kabupaten
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="menu-title"><span data-key="t-menu">Sosial</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/kerawanan-sosial-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/kerawanan-sosial-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Kerawanan Sosial
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/kondisi-lingkungan-keluarga-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/kondisi-lingkungan-keluarga-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Kondisi Lingkungan Keluarga
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/tempat-tinggal-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/tempat-tinggal-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Tempat Tinggal
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/disabilitas-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/disabilitas-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Disabilitas
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/balita-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/balita-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Balita
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/lansia-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/lansia-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Lansia
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/pendidikan-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/pendidikan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Pendidikan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/olahraga-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/olahraga-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Olahraga
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/pelaku-umkm-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/pelaku-umkm-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Pelaku UMKM
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Sarana & Prasarana</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/sarana-kesehatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/sarana-kesehatan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Kesehatan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/sarana-pendukung-kesehatan-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/sarana-pendukung-kesehatan-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Pendukung Kesehatan
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/sarana-ibadah-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/sarana-ibadah-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Ibadah
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/ekonomi') }}"
        class="nav-link {{ $current_url == 'admin_desa/ekonomi' ? 'active' : '' }}">
        <i data-feather="settings"></i>Ekonomi
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/usaha-ekonomi') }}"
        class="nav-link {{ $current_url == 'admin_desa/usaha-ekonomi' ? 'active' : '' }}">
        <i data-feather="settings"></i>Usaha Ekonomi
    </a>
</li>


<li class="nav-item">
    <a href="{{ url('admin_desa/sarana-lainya-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/sarana-lainya-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sarana Lainnya
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Industri & Energi</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/industri-penghasil-limbah-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/industri-penghasil-limbah-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Industri Penghasil Limbah
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/energi-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/energi-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Energi
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Sumber Daya</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/sumber-daya-alam-desa') }}"
        class="nav-link {{ $current_url == 'admin_desa/sumber-daya-alam-desa' ? 'active' : '' }}">
        <i data-feather="settings"></i>Sumber Daya Alam
    </a>
</li>

<li class="menu-title"><span data-key="t-menu">Pengaturan Menu</span></li>

<li class="nav-item">
    <a href="{{ url('admin_desa/settings') }}"
        class="nav-link {{ $current_url == 'admin_desa/settings' ? 'active' : '' }}">
        <i data-feather="settings"></i>Settings Website
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('admin_desa/users') }}"
        class="nav-link {{ $current_url == 'admin_desa/users' ? 'active' : '' }}">
        <i data-feather="users"></i>Manajemen Pengguna
    </a>
</li>
