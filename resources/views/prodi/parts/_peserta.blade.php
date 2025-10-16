<div class="peserta mb-2">
    <label class="col-form-label">Peserta Aktivitas</label>
    
    <table class="table table-sm table-warning table-bordered" style="width: 100%">
      <thead>
        <tr>
          <th class="align-middle text-center bg-red bg-gradient text-white">No.</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">NIM</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">Nama</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">Program Studi</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">Jumlah SKS KRS</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">Jumlah SKS Konversi</th>
          <th class="align-middle text-center bg-red bg-gradient text-white">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($peserta as $mhs)
            @php
                $nim = $mhs->nim;
                $url = env("SIAKAD_URI") . "/as400/dataMahasiswa/".$nim."/".session('user_token');
                // echo $url;
                $getDataMhs = Http::get($url, []);
                // @dd($getDataMhs);
                $idAktivitas = $mhs->idaktivitas;
                $kegiatan = DB::table('tr_aktivitas')->where('id',$idAktivitas)->first()->judul_kegiatan;
            @endphp
            <tr>
                <td class="text-center align-top">{{ $loop->iteration }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $getDataMhs['isi'][0]['namaProdi'] }} ({{ $getDataMhs['isi'][0]['jenjangProdi'] }}</td>
                <td>{{ $mhs->sks_krs }}</td>
                <td>{{ $mhs->sks_konversi }}</td>
                <td>
                  @if ($mhs->sks_konversi > 0)
                    
                  @else
                    <form action="{{ route('prodi.deletePeserta', ['id' => $mhs->id]) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan membatalkan Peserta Aktivitas ini ?')"><i class="fas fa-trash"></i> </button>
                    </form>    
                  @endif
                  
                </td>
            </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
  