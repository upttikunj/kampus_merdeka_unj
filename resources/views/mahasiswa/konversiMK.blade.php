@extends('layouts.main')

@section('style')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
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
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">MK Konversi Mahasiswa</h3>
      </div>
      <div class="card-body">
       
        {{-- <button class="btn btn-outline-primary" id="addAktivitas" data-toggle="modal" data-target="#add-aktivitas-modal"><i class="ace-icon fa fa-plus"></i> Buka AKtivitas</button>

        <table id="dataTable" class="table table-hover table-responsive">
            <thead>
              <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Semester</th>
                <th scope="col">Judul Kegiatan</th>
                <th scope="col" class="text-center">Jenis Aktivitas</th>
                <th scope="col" class="text-center">No SK Tugas</th>
                <th scope="col">Tanggal SK Tugas</th>
                <th scope="col" class="text-center">Jenis Anggota</th>
                <th scope="col">Lokasi Kegiatan</th>
                <th scope="col">Program Kegiatan</th>
                <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rec_data as $item)
                <tr>
                  <td class="text-center align-top">{{ $loop->iteration }}</td>
                  <td class="text-center align-top">{{ $item->semester }}</td>
                  <td>{{ $item->judul_kegiatan }}</td>
                  <td>{{ $item->jenis_aktivitas }}</td>
                  <td>{{ $item->no_sk_tugas }}</td>
                  <td>{{ $item->tanggal_sk_tugas }}</td>
                  <td>{{ $item->jenis_anggota }}</td>
                  <td>{{ $item->lokasi_kegiatan }}</td>
                  <td>{{ ($item->program_kegiatan == '2')?"Luar Negeri":"Dalam Negeri" }}</td>
                  <td class="btn-group text-center">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn btn-sm btn-outline-warning mr-2" onclick="editAktivitas({{ $item->id }})"><i class="fas fa-edit"></i> </button>
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Detil Data" class="btn btn-sm btn-outline-success mr-2" onclick="detilAktivitas({{ $item->id }})"><i class="fas fa-eye"></i> </button>
                    <form action="{{ route('prodi.deleteAktivitas', ['id' => $item->id]) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus Aktivitas ini ?')"><i class="fas fa-trash"></i> </button>
                    </form>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table> --}}
      </div>
    </div>

    {{-- @include("prodi.addAktivitas") --}}
        
  </section>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      $(function() {

        $("#dataTable").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#dataTable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        //Date and time picker
        $('#start_date').datetimepicker({
          icons: {
            time: 'far fa-clock'
          }
        });
        $('#end_date').datetimepicker({
          icons: {
            time: 'far fa-clock'
          }
        });

      });
      function detilAktivitas(id)
      {
        // alert ('Detil Aktivitas');
        window.open("detilAktivitas/"+id,"_self")
      }
    
    </script>
@endsection