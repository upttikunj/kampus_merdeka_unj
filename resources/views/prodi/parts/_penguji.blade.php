<div class="peserta mb-2">
    <label class="col-form-label">Dosen Penguji</label><br/>
    <button class="btn btn-outline-primary" id="addDosUji" data-toggle="modal" data-target="#add-penguji-modal"><i class="fa fa-plus"></i> Dosen Penguji Kegiatan </button>
    <table class="table table-sm table-warning table-bordered" style="width: 100%">
        <thead>
            <tr>
              <th class="align-middle text-center bg-red bg-gradient text-white">No.</th>
              <th class="align-middle text-center bg-red bg-gradient text-white">NIDN</th>
              <th class="align-middle text-center bg-red bg-gradient text-white">Nama Dosen</th>
              <th class="align-middle text-center bg-red bg-gradient text-white">Penguji ke</th>
              <th class="align-middle text-center bg-red bg-gradient text-white">Kategori Kegiatan</th>
              <th class="align-middle text-center bg-red bg-gradient text-white">Aksi</th>
            </tr>
        </thead>
      <tbody>
        @foreach ($penguji as $dsn)
        <?php 
          $getNamaDosen = Http::get(env("SIAKAD_URI") . "/as400/dataDosen/".$dsn->nidn."/".session('user_token')."", []);
          $namaKategori = DB::table('ref_kategori_kegiatan')->where('id_kategori_kegiatan',$dsn->id_kategori_kegiatan)->first()->nama_kategori_kegiatan;
        ?>
            <tr>
                <td class="text-center align-top">{{ $loop->iteration }}</td>
                <td>{{ $dsn->nidn }}</td>
                <td>{{ $getNamaDosen['isi'][0]['namaGelar'] }}</td>
                <td>{{ $dsn->penguji_ke }}</td>
                <td>{{ $namaKategori }}</td>
                <td>
                  <form action="{{ route('prodi.deleteDosenPenguji', ['id' => $dsn->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus Dosen Penguji ini ?')"><i class="fas fa-trash"></i> </button>
                  </form>
                </td>
            </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
  @include("prodi.parts.addPenguji")