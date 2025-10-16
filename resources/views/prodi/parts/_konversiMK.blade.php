<div class="peserta mb-2">
  <label class="col-form-label">Mata Kuliah Konversi</label><br/>
  <button class="btn btn-outline-primary" id="addKonversiMK" data-toggle="modal" data-target="#add-konversiMK-modal"><i class="fa fa-plus"></i> MK Konversi </button>
  <table class="table table-sm table-warning table-bordered" style="width: 100%">
      <thead>
          <tr>
            <th class="align-middle text-center bg-red bg-gradient text-white">No.</th>
            <th class="align-middle text-center bg-red bg-gradient text-white">Kode Kelas/Seksi</th>
            <th class="align-middle text-center bg-red bg-gradient text-white">Kode MK</th>
            <th class="align-middle text-center bg-red bg-gradient text-white">Nama MK</th>
            <th class="align-middle text-center bg-red bg-gradient text-white">SKS MK</th>
            <th class="align-middle text-center bg-red bg-gradient text-white">Dosen</th>
            {{-- <th class="align-middle text-center bg-red bg-gradient text-white">Nama Dosen</th> --}}
            <th class="align-middle text-center bg-red bg-gradient text-white">Aksi</th>
          </tr>
      </thead>
    <tbody>
      @foreach ($mkKon as $mk)
      <?php 
          $url = env("SIAKAD_URI") . "/as400/kelasKuliahById/".$mk->idjadwal."/".session('user_token');
          $seksi = Http::get($url, []);
          // @dd($url);
          $dsn = $seksi['isi'][0]['dosen'];
          $jdsn = count($dsn);
          
          $dosen = "";
          for ($i=0; $i<$jdsn; $i++){
            if ($jdsn == 1){
              $dosen .= $dsn[$i]['nidn']."-".$dsn[$i]['nama'];
            }else{
              $dosen .= $dsn[$i]['nidn']."-".$dsn[$i]['nama']."<br>";
            }
          }
      ?>
        <tr>
              <td class="text-center align-top">{{ $loop->iteration }}</td>
              <td>{{ $seksi['isi'][0]['kelas'] }}</td>
              <td>{{ $seksi['isi'][0]['kodemk'] }}</td>
              <td>{{ $seksi['isi'][0]['namamk'] }}</td>
              <td>{{ $seksi['isi'][0]['sksmk'] }}</td>
              <td>{{ $dosen }}</td>
              <td>
                <form action="{{ route('prodi.deleteKonversiMK', ['id' => $mk->id]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus MK Konversi ini ?')"><i class="fas fa-trash"></i> </button>
                </form>  
              </td>
          </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</div>
@include("prodi.parts.addKonversiMK")