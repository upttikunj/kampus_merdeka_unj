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
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success" onclick="filterAktivitas()">Proses</button>
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
        <h3 class="card-title">Daftar Peserta Aktivitas</h3>
      </div>
      <div class="card-body">
        <table id="dataTable" class="table table-hover table-responsive">
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
<script>
var aktivitas_id = "All";

var url = "{{ route('prodi.list', ':aktivitas_id') }}";
url = url.replace(':aktivitas_id', aktivitas_id);

var table = $('#list-detail').DataTable({
  processing: true,
  serverSide: true,
  responsive: true,
  ajax: {
    url: url,
    type: 'get'
  },
  columns: [{
      data: 'DT_RowIndex',
      className: 'text-center',
      orderable: false,
      searchable: false,
      width: '36px',
    },
    {
      data: 'nim',
      name: 'nim',
      className: 'text-center',
      width: '100px'
    },
    {
      data: 'nama',
      name: 'nama',
    },
    {
      data: 'semester',
      name: 'semester',
      className: 'text-center',
      width: '120px'
    },
    {
      data: 'kode_mk',
      name: 'kode_mk',
      className: 'text-center',
      width: '120px'
    },
    {
      data: 'nama_mk',
      name: 'nama_mk',
    },
    {
      data: 'kelas',
      name: 'kelas',
      className: 'text-center',
      width: '120px'
    },
    {
      data: 'status_sync',
      name: 'status_sync',
      className: 'text-center',
      width: '120px'
    },
    {
      data: 'action',
      name: 'action',
      className: 'text-center',
      width: '120px',
      orderable: false,
      searchable: false
    }
  ]
});
function filterAktivitas(){
  var idAktivitas = $('#idaktivitas').val();
  alert (idAktivitas);
}

</script>
@endsection

