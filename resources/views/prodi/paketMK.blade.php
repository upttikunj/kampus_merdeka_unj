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

  <section class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Filter Data Aktivitas</h3>
      </div>
      <div class="card-body">
        <form action="{{route('prodi.paketMK')}}" method="POST">
          @csrf
          @method('get')
          <div class="form-group">
              <label for="idaktivitas">Aktivitas</label>
              <select class="form-control select2" name="idaktivitas" id="idaktivitas" aria-label="Default select example">
                <option value="">Jenis Aktivitas Mahasiswa</option>
                @foreach ($aktivitas as $item)
                    @php
                    $namaAktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$item->jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;    
                    @endphp
                    <option value="{{ $item->id }}">{{ $namaAktivitas }} : {{ $item->judul_kegiatan }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Proses</button>
          </div>
        </form>
      </div>

    </div>
  </section>
  <section class="content">
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Peserta Aktivitas</h3>
      </div>
      <div class="card-body">
        <table id="table" class="table table-hover table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Jenis Aktivitas</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>IPK</th>
                <th>SKS KRS</th>
                <th>SKS Konversi MBKM</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($pesertaKegiatan as $item)
                <tr>
                  <td class="text-center align-top">{{ $loop->iteration }}</td>
                  <td class="text-center align-top">{{ $item->semester }}</td>
                  <td>{{ $item->nama_kegiatan }}</td>
                  <td>{{ $item->nama_jenis_aktivitas }}</td>
                  <td>{{ $item->nim }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->prodi }}</td>
                  <td>{{ $item->sks_krs }}</td>
                  <td>{{ $item->sks_konversi }}</td>
                  <td class="btn-group text-center">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Detil Data" class="btn btn-sm btn-outline-success mr-2" onclick="paketkan({{ $item->id }})"><i class="fas fa-eye"></i> </button>
                    <form action="{{ route('prodi.deletePeserta', ['id' => $item->id]) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus Mahasiswa di kegiatan ini ?')"><i class="fas fa-trash"></i> </button>
                    </form>

                  </td>
                </tr>
              @endforeach 
              
            </tbody>
          </table>
      </div>

    </div>
  </section>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      $(function() {

        $('#table').DataTable({
          "destroy": true,
          "paging": true,
          "searching": false
        });

      });
      
      function filterAktivitas()
      {
        var idjenis = $('#idaktivitas').val();
        alert (idjenis);

      }

    </script>
@endsection
