<div class="modal fade" tabindex="-1" role="dialog" id="add-aktivitas-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aktivitas Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('prodi.addAktivitas')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Semester Aktif</label>
                        <input type="text" class="form-control form-control-border" name="semester" value="{{ $periode['data'][0]['kode_semester'] . " - " . $periode['data'][0]['des_semester'] }}" readonly>
                        <input type="hidden" name="prodi" id="prodi" value="{{ $unit }}">
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                    <div class="form-group">
                        <label for="jenisAktivitas">Jenis Aktivitas</label><span class="text-red">*</span>
                        <select name="jenisAktivitas" id="jenisAktivitas" class="form-control form-control-border">
                            <option value="">Jenis Aktivitas Mahasiswa</option>
                            @foreach ($jenisAktivitas as $item)
                              <option value="{{ $item->id_jenis_aktivitas_mahasiswa }}">{{ $item->nama_jenis_aktivitas_mahasiswa }} {{ ($item->untuk_kampus_merdeka == '1')?"( MBKM )":"" }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="noSKTugas">Nomor SK Tugas</label>
                        <input type="text" class="form-control form-control-border" name="noSKTugas" id="noSKTugas" placeholder="Masukkan No SK Tugas">
                    </div>
                    <div class="form-group">
                        <label for="tanggalSKTugas">Tanggal SK Tugas</label>
                        <input type="text" class="form-control form-control-border datetimepicker-input" name="tanggalSKTugas" id="tanggalSKTugas" placeholder="Tanggal No SK Tugas" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                    </div>
                    <div class="form-group">
                        <label for="keanggotaan">Jenis Anggota</label><span class="text-red">*</span>
                        <div class="form-control form-control-border">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="keanggotaan" id="personal" value="1">
                                <label class="form-check-label" for="personal">Personal</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="keanggotaan" id="kelompok" value="2">
                                <label class="form-check-label" for="kelompok">Kelompok</label>
                              </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judulKegiatan">Judul Kegiatan</label><span class="text-red">*</span>
                        <textarea name="judulKegiatan" id="judulKegiatan" class="form-control" cols="30" rows="10" placeholder="Judul Kegiatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keteranganKegiatan">Keterangan Kegiatan</label>
                        <textarea name="keteranganKegiatan" id="keteranganKegiatan" class="form-control" cols="30" rows="10" placeholder="keterangan Kegiatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lokasiKegiatan">Lokasi/Tempat Kegiatan</label>
                        <input type="text" class="form-control form-control-border datetimepicker-input" name="lokasiKegiatan" id="lokasiKegiatan" placeholder="Lokasi Kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label><span class="text-red">*</span>
                        <div class="form-control form-control-border">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="program" id="dalam_negeri" value="1">
                                <label class="form-check-label" for="dalam_negeri">Dalam Negeri</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="program" id="luar_negeri" value="2">
                                <label class="form-check-label" for="luar_negeri">Luar Negeri</label>
                              </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalMulaiKegiatan">Tanggal Mulai Kegiatan</label>
                        <input type="text" class="form-control form-control-border datetimepicker-input" name="tanggalMulaiKegiatan" id="tanggalMulaiKegiatan" placeholder="Tanggal Mulai Kegiatan" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                    </div>
                    <div class="form-group">
                        <label for="tanggalAkhirKegiatan">Tanggal Akhir Kegiatan</label>
                        <input type="text" class="form-control form-control-border datetimepicker-input" name="tanggalAkhirKegiatan" id="tanggalAkhirKegiatan" placeholder="Tanggal Akhir Kegiatan" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                    </div>
                    {{-- <p class="mb-2"><code>*</code>Ukuran File Maksimal <code>2 MB</code></p> --}}
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>
