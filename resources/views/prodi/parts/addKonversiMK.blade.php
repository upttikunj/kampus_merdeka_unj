{{-- @section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
@endsection --}}
@php
    
@endphp
<div class="modal fade" role="dialog" id="add-konversiMK-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MK Konversi {{ $aktivitas['prodi'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('prodi.addKonversiMK')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="idaktivitas" id="idaktivitas" value="{{ $aktivitas['id'] }}">
                        <label for="penjadwalan">Penjadwalan Mata Kuliah Konversi</label><span class="text-red">*</span>
                        <select name="penjadwalan" id="penjadwalan" class="form-control select2" style="width:100%;">
                            
                            @for ($i=0;$i<=$countMK-1;$i++)
                              <option value="{{ $arrMK[$i]['id'] }}">{{ $arrMK[$i]['kelas'] .' | '.$arrMK[$i]['kodemk'] .' - '. $arrMK[$i]['namamk'] .' ('.$arrMK[$i]['sksmk'].') ' }}</option>
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
