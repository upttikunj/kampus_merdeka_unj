@extends('layouts.main')
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
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Pendaftaran Aktivitas Mahasiswa</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button> --}}
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <fieldset>
                <legend>Pendaftaran MBKM</legend>
                <div class="mb-1 row">
                    <label for="periode" class="col-sm-4 col-form-label">Periode Aktivitas</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" name="periode" id="periode" value="{{ trim($periode['data'][0]['kode_semester']) .' - '. $periode['data'][0]['des_semester'] }} ({{ strtoupper($statusAktif['isi'][0]['status']) }}) ">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="nim" name="nim" value="{{ $dataMahasiswa['isi'][0]['nim'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="nama" name="nama" value="{{ $dataMahasiswa['isi'][0]['namaLengkap'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="prodi" class="col-sm-4 col-form-label">Program Studi</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="prodi" name="prodi" value="{{ $dataMahasiswa['isi'][0]['kodeProdi'] .' - '. $dataMahasiswa['isi'][0]['jenjangProdi'] .' '. $dataMahasiswa['isi'][0]['namaProdi'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="fakultas" class="col-sm-4 col-form-label">Fakultas</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" name="fakultas" id="fakultas" value="{{ $dataMahasiswa['isi'][0]['namaFakultas'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="angkatan" class="col-sm-4 col-form-label">Angkatan</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" name="angkatan" id="angkatan" value="{{ $dataMahasiswa['isi'][0]['angkatan'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="ipk" class="col-sm-4 col-form-label">Indek Prestasi Kumulatif</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="ipk" name="ipk" value="{{ $prestasiAkademik['isi'][0]['ipk'] }}">
                    </div>
                </div>
                <div class="mb-1 row">
                  <label for="sks_krs" class="col-sm-4 col-form-label">SKS KRS Terinput</label>
                  <div class="col-sm-7">
                  <input type="text" readonly class="form-control-plaintext" id="sks_krs" name="sks_krs" value="{{ strtoupper($statusAktif['isi'][0]['sks_krs']) }}">
                  </div>
              </div>
                <div class="mb-1 row">
                    <label for="idaktivitas" class="col-sm-4 col-form-label">Jenis Aktivitas Mahasiswa</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="idaktivitas" id="idaktivitas" aria-label="Default select example">
                            <option value="">Jenis Aktivitas Mahasiswa</option>
                            @foreach ($lsJenisAktivitas as $item)
                                @php
                                $namaAktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$item->jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;    
                                @endphp
                                <option value="{{ $item->id }}">{{ $namaAktivitas }} : {{ $item->judul_kegiatan }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </fieldset>
        </form>
      </div>

    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Pendaftaran</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button> --}}
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Semester</th>
              <th>Nim</th>
              <th>Nama</th>
              <th>Program Studi</th>
              <th>Fakultas</th>
              <th>IPK</th>
              <th>Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dataPeserta as $dft)
            @php
                $nim = $dft->nim;
                $getDataMhs = Http::get(env("SIAKAD_URI") . "/as400/dataMahasiswa/".$nim."/".session('user_token')."", []);
                $idAktivitas = $dft->idaktivitas;
                $kegiatan = DB::table('tr_aktivitas')->where('id',$idAktivitas)->first()->judul_kegiatan;
            @endphp
                <tr>
                    <td class="text-center align-top">{{ $loop->iteration }}</td>
                    <td>{{ $dft->semester }}</td>
                    <td>{{ $dft->nim }}</td>
                    <td>{{ $dft->nama }}</td>
                    <td>{{ $getDataMhs['isi'][0]['namaProdi'] }} ({{ $getDataMhs['isi'][0]['jenjangProdi'] }})</td>
                    <td>{{ $getDataMhs['isi'][0]['namaFakultas'] }}</td>
                    <td>{{ $dft->ipk }}</td>
                    <td>{{ $kegiatan }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.deleteAktivitas', ['id' => $dft->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus Aktivitas ini ?')"><i class="fas fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <br/>
      </div>
    </div>
  </section>
@endsection
