{{-- @section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
@endsection --}}

<div class="modal fade" role="dialog" id="add-pembimbing-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembimbing Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('prodi.addPembimbing')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="idaktivitas" id="idaktivitas" value="{{ $aktivitas['id'] }}">
                        <label for="nidn_bimbing">Dosen Pembimbing</label><span class="text-red">*</span>
                        <select name="nidn_bimbing" id="nidn_bimbing" class="form-control select2" style="width:100%;">
                            @for ($dos=0;$dos<=$countDosen-1;$dos++)
                              <option value="{{ $arrDosen[$dos]['nidn'] }}">{{ $arrDosen[$dos]['namaGelar'] .' ('.$arrDosen[$dos]['nidn'] .' - '. $arrDosen[$dos]['status_dosen'] .') ' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_bimbing">Kategori Kegiatan</label>
                        <select name="kategori_bimbing" id="kategori_bimbing" class="form-control select2">
                            @foreach ($kategori as $ktg)
                              <option value="{{ $ktg->id_kategori_kegiatan }}">{{ $ktg->id_kategori_kegiatan }} - {{ $ktg->nama_kategori_kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pembimbing_ke">Pembimbing Ke</label>
                        <select name="pembimbing_ke" id="pembimbing_ke" class="form-control select2">
                            @for ($i=1;$i<=10;$i++)
                              <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>

