<aside class="main-sidebar sidebar-dark-warning bg-unj elevation-4">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link border-bottom border-warning">
    <img src="{{ asset('img/logo_unj_without_text.png') }}" alt="Logo UNJ" class="brand-image img-circle elevation-3 mt-0 mr-2" height="80" width="auto">
    <span class="brand-text font-weight-bold cinzel" style="font-size: 90%">Merdeka UNJ</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center"">
      <div class="image">
          <img src="{{ asset('img/user.png') }}" class="user-image img-circle elevation-2" alt="User Image">
      </div>
      <div class="info text-wrap">
        <span class="d-none d-md-inline font-weight-bold text-white">{{ $user }}</span>
        <a href="/logout">
          <i class="nav-icon fas fa-logout"></i>
          <p>
            Logout
          </p>
        </a>
      </div>
      {{-- <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('img/user.png') }}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">User</span>
          </a>
        </li>
      </ul> --}}
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        {{-- <li class="nav-item">
          <a href="/ubah_password" class="nav-link {{ $pass_active }}">
            <i class="nav-icon fas fa-key"></i>
            <p>
              Ubah Password
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li> --}}
        @if (session('user_cmode') == '9')
        <li class="nav-item">
          <a href="/mahasiswa" class="nav-link {{ $home_active }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Halaman Utama
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/mahasiswa/pendaftaran" class="nav-link {{ $daftar_active }}">
            <i class="nav-icon fas fa-star"></i>
            <p>
              Pendaftaran Aktivitas
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/mahasiswa/konversi_mk" class="nav-link {{ $konversi_active }}">
            <i class="nav-icon fas fa-paperclip"></i>
            <p>
              Konversi MK
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/mahasiswa/histori_aktivitas" class="nav-link {{ $history_active }}">
            <i class="nav-icon fas fa-bars"></i>
            <p>Histori Aktivitas</p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="#" class="nav-link {{ $aktivitas_active }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Aktivitas Mahasiswa
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pendaftaran" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pendaftaran Aktivitas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/konversi_mk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Konversi MK</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/histori_aktivitas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Histori Aktivitas</p>
              </a>
            </li>
          </ul>
        </li> --}}
        @elseif (session('user_cmode') == '2')
        <li class="nav-item">
          <a href="/prodi" class="nav-link {{ $home_active }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Halaman Utama
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/prodi/aktivitasMBKM" class="nav-link {{ $aktivitas_active }}">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Aktivitas MBKM
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/prodi/paketMK" class="nav-link {{ $paket_active }}">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Paket Konversi MBKM
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/prodi/konversiAktivitas" class="nav-link {{ $kovAktiv_active }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Konversi Aktivitas MBKM
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/prodi/konversiPermata" class="nav-link {{ $kovPermata_active }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Konversi Pertukaran Pelajar
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li> --}}
        @else
        <li class="nav-item">
          <a href="/outbound" class="nav-link">
            <i class="nav-icon fas fa-arrow-right"></i>
            <p>
              Menu
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li>
        @endif
        {{-- @if (session('user_cmode') == '1')
          <li class="nav-item">
            <a href="/data_dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Manajemen Data Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '2')
          <li class="nav-item">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Penerima Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '3')
          <li class="nav-item" title="Database Kelompok UKT">
            <a href="/dataUKT" class="nav-link {{ $dataukt_active }}">
              <i class="nav-icon fas fa-database"></i>
              <p>
                DataBase UKT
              </p>
            </a>
          </li>
          <li class="nav-item" title="Verifikasi Pengajuan Keringanan UKT yang masuk">
            <a href="/verifikasi_dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Verifikasi Pengajuan
                <span class="badge bg-danger ml-2 right">{{ $badges->where('status_pengajuan', 0)->count('id') == 0 ? '' : $badges->where('status_pengajuan', 0)->count('id') }}</span>
              </p>
            </a>
          </li>
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item" title="Cetak Laporan Penerima Keringanan UKT">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '4')
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '11')
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '13')
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '14')
          <li class="nav-item">
            <a href="/verifikasiDekan_dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Verifikasi Dekan <span class="badge bg-danger ml-2 right">{{ $badges->where('status_pengajuan', 1)->count('id') == 0 ? '' : $badges->where('status_pengajuan', 1)->count('id') }}</span>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '20')
          <li class="nav-item">
            <a href="/periode" class="nav-link {{ $periode_active }}">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Buka Periode
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/verifikasiWR2_dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Verifikasi WR II
                <span class="badge bg-danger ml-2 right">{{ $badges->where('status_pengajuan', 2)->count('id') == 0 ? '' : $badges->where('status_pengajuan', 2)->count('id') }}</span>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/penerima_dispensasi" class="nav-link {{ $penerima_active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link {{ $laporan_active }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Laporan Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @elseif (session('user_cmode') == '9')
          <li class="nav-item">
            <a href="/dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Keringanan UKT
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @else
          <li class="nav-item" title="Daftar Penerima Keringanan UKT">
            <a href="/pengajuan_dispensasi" class="nav-link {{ $dispen_active }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Daftar Penerima
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
        @endif
        <hr> 
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>--}}
      </ul>
    </nav>


    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
