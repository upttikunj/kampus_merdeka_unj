@extends('layouts.main')

@section('style')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('contain')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">{{ $title }}</a></li>
            <li class="breadcrumb-item active">{{ $subtitle }}</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="row col-12">
        <a href="../aktivitasMBKM" class="btn btn-sm ">kembali</a>
    </div>
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Aktivitas {{ $aktivitas['nama_aktivitas'] }}</h3>
      </div>
      <div class="card-body">
        <fieldset>
            {{-- <legend>Pendaftaran MBKM</legend> --}}
            <div class="mb-1 row">
                <div class="col-sm-6">
                    <label class="col-form-label">Program Kegiatan</label><br/>
                    <input type="hidden" id="id" name="id" value="{{ $aktivitas['id'] }}">
                    {{ ($aktivitas['program_kegiatan'] == '1')?"Dalam Negeri" : "Luar Negeri" }}
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label">Semester</label><br/>
                    {{ $aktivitas['semester'] }}
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-6">
                    <label class="col-form-label">Program Studi</label><br/>
                    {{ $prodi['isi'][0]['jenjangProdi'] .' '. $prodi['isi'][0]['namaProdi'] }}
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label">Fakultas</label><br/>
                    {{ $prodi['isi'][0]['namaFakultas'] }}
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-6">
                    <label class="col-form-label">No SK</label><br/>
                    {{ $aktivitas['no_sk_tugas'] }}
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label">Tanggal SK</label><br/>
                    {{ $aktivitas['tanggal_sk_tugas'] }}
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-6">
                    <label class="col-form-label">Jenis Aktivitas</label><br/>
                    {{ $aktivitas['nama_aktivitas'] }}
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label">Jenis Anggota</label><br/>
                    {{ ($aktivitas['jenis_anggota'] == '1')?'Personal':'Kelompok' }}
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-6">
                    <label class="col-form-label">Judul Kegiatan</label><br/>
                    {{ $aktivitas['judul_kegiatan'] }}
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label">Keterangan</label><br/>
                    {{ $aktivitas['keterangan'] }}
                </div>
            </div>
        </fieldset>
        
      </div>
    </div>    

    <div class="col-12">
        <div class="mt-4 mb-3 card shadow-none">
            <div class="card-header">
              <ul class="nav nav-justified">
                <li class="nav-item"><a data-toggle="tab" href="#peserta" class="nav-link font-weight-bold h6 {{ session('peserta_active') ?? '' }} show">Peserta</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#pembimbing" class="nav-link font-weight-bold h6 {{ session('pembimbing_active') ?? '' }} show">Pembimbing</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#penguji" class="nav-link font-weight-bold {{ session('penguji_active') ?? '' }} h6 show">Penguji</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#konversi" class="nav-link font-weight-bold {{ session('konversi_active') ?? '' }} h6 show">Paket Konversi</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane {{ session('peserta_active') ?? '' }} show" id="peserta" role="tabpanel">
                  @include('prodi.parts._peserta')
                </div>
                <div class="tab-pane {{ session('pembimbing_active') ?? '' }} show" id="pembimbing" role="tabpanel">
                  @include('prodi.parts._pembimbing')
                </div>
                <div class="tab-pane {{ session('penguji_active') ?? '' }} show" id="penguji" role="tabpanel">
                  @include('prodi.parts._penguji')
                </div>
                <div class="tab-pane {{ session('konversi_active') ?? '' }} show" id="konversi" role="tabpanel">
                    @include('prodi.parts._konversiMK')
                  </div>
              </div>
            </div>
        </div>
    </div>
  </section>

@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.js"></script>
    <script>

    </script>
@endsection