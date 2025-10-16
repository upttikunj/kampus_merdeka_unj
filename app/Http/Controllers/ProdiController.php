<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Helpers\Services;
use App\Models\AktivitasModel;
use App\Models\KonversiMKModel;
use App\Models\PembimbingAktivitasModel;
use App\Models\PengujiAktivitasModel;
use App\Models\PesertaAktivitasModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Psy\Readline\Hoa\Console;
use DataTables;

class ProdiController extends Controller
{
    public function index()
    {

        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'Halaman Utama',
            'active'        => 'home',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => 'active',
            'paket_active'  => '',
            'list_active'   => '',
            'kovAktiv_active'  => '',
            'kovPermata_active'  => '',
            'aktivitas_active'  => ''
        ];
        return view('prodi/index',$arrData);
    }

    public function aktivitas()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $unit = session('user_unit');
        //service
        $periode = Services::getPeriodeAktif();
        $aktivitas = DB::table('ref_jenis_aktivitas')->where('untuk_kampus_merdeka','1')->get();
        
        //Main Data
        $aktivitasMhs = DB::table('tr_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('jenis_aktivitas')->get();

        foreach ($aktivitasMhs as $aktiv){
            $aktiv->nama_jenis_aktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$aktiv->jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;
        }

        $arrData = [
            'title'         => 'Aktivitas Mahasiswa MBKM Semester '.trim($periode['data'][0]['kode_semester']),
            'active'        => 'paket',
            'user'          => $user,
            'unit'          => $unit,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'paket_active'  => '',
            'aktivitas_active'  => 'active',
            'kovAktiv_active'  => '',
            'kovPermata_active'  => '',
            'list_active'   => '',
            'periode'       => $periode,
            'jenisAktivitas'=> $aktivitas,
            'rec_data'      => $aktivitasMhs
        ];
        return view('prodi/aktivitasMBKM',$arrData);
    }
    public function editAktivitas($id)
    {
        $data = AktivitasModel::findOrFail($id);
        return json_encode($data);
    }
    public function paket(Request $request)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $unit = session('user_unit');

        $periode = Services::getPeriodeAktif();
        $lsJenisAktivitas = DB::table('tr_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('jenis_aktivitas')->get();
        
        if (!isset($request->idaktivitas)) {
            $pesertaKegiatan = DB::table('tr_peserta_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('idaktivitas')->get();
        }else{
            $pesertaKegiatan = DB::table('tr_peserta_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->where('idaktivitas',$request->idaktivitas)->orderBy('idaktivitas')->get();
        }
        
        foreach ($pesertaKegiatan as $pes){
            $pes->nama_kegiatan = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->judul_kegiatan;
            $pes->id_jenis_aktivitas = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->jenis_aktivitas;
            $pes->nama_jenis_aktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$pes->id_jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;
        }

        $arrData = [
            'title'         => 'Paket Mata Kuliah Aktivitas Mahasiswa',
            'active'        => 'paket',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'paket_active'  => 'active',
            'list_active'   => '',
            'kovAktiv_active'  => '',
            'kovPermata_active'  => '',
            'aktivitas_active'  => '',
            'aktivitas'     => $lsJenisAktivitas,
            'pesertaKegiatan'=>$pesertaKegiatan
        ];
        return view('prodi/paketMK',$arrData);
    }
    
    
    public function addAktivitas(Request $request){
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $credentials = $request->validate([
            'semester'                  => ['required'],
            'prodi'                     => ['required'],
            'jenisAktivitas'            => ['required'],
            // 'noSKTugas'                 => ['required'],
            // 'tanggalSKTugas'            => ['required'],
            'keanggotaan'               => ['required'],
            'judulKegiatan'             => ['required'],
            // 'keteranganKegiatan'        => ['required'],
            // 'lokasiKegiatan'            => ['required'],
            // 'tanggalMulaiKegiatan'      => ['required'],
            // 'tanggalAkhirKegiatan'      => ['required']
        ]);

        $id = $request->id;
        $semester = $request->semester;
        $prodi = $request->prodi;
        $jenis_aktivitas = $request->jenisAktivitas;
        $no_sk_tugas = $request->noSKTugas;
        $tanggal_sk_tugas = ($request->tanggalSKTugas == "")?'0001-01-01':$request->tanggalSKTugas;
        $jenis_anggota = $request->keanggotaan;
        $judul_kegiatan = $request->judulKegiatan;
        $keterangan = $request->keteranganKegiatan;
        $lokasi_kegiatan = $request->lokasiKegiatan;
        $program_kegiatan = $request->program;
        $tanggal_mulai = $request->tanggalMulaiKegiatan;
        $tanggal_akhir = $request->tanggalAkhirKegiatan;
        //explode
        $a = explode('-',$semester);
        $smt = $a[0];
        $x = explode('-',$tanggal_sk_tugas);
        $tanggalSK = $x[2]."-".$x[1]."-".$x[0];
        $y = explode('-',$tanggal_mulai);
        $tanggalMulai = $y[2]."-".$y[1]."-".$y[0];
        $z = explode('-',$tanggal_akhir);
        $tanggalAkhir = $z[2]."-".$z[1]."-".$z[0];

        if (!isset($request->jenisAktivitas)) {
            return redirect()->back()->with('toast_error', 'Belum Pilih Jenis Aktivitasnya');
        }

        try {
            DB::beginTransaction();
            AktivitasModel::updateOrCreate(
                [
                    'id'                => $id
                ],
                [
                    'prodi'             => $prodi,
                    'semester'          => $smt,
                    'no_sk_tugas'       => $no_sk_tugas,
                    'tanggal_sk_tugas'  => $tanggalSK,
                    'jenis_aktivitas'   => $jenis_aktivitas,
                    'jenis_anggota'     => $jenis_anggota,
                    'judul_kegiatan'    => $judul_kegiatan,
                    'keterangan'        => $keterangan,
                    'lokasi_kegiatan'   => $lokasi_kegiatan,
                    'program_kegiatan'  => $program_kegiatan,
                    'tanggal_mulai'     => $tanggalMulai,
                    'tanggal_akhir'     => $tanggalAkhir
                ]
            );

            DB::commit();
            return redirect()->route('prodi.aktivitasMBKM')->with('toast_success', 'Penambahan Aktivitas Berhasil ');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('prodi.aktivitasMBKM')->with('toast_error', 'Error : ' . $th->getMessage());
        }
    }
    
    public function deleteAktivitas($id){
        $data = AktivitasModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data telah dihapus');
    }
    public function deleteKonversiMK($id){
        $data = KonversiMKModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data telah dihapus')->with('konversi_active', 'active');
    }
    public function deleteDosenPenguji($id){
        $data = PengujiAktivitasModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data telah dihapus')->with('penguji_active', 'active');
    }
    public function deleteDosenPembimbing($id){
        $data = PembimbingAktivitasModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data telah dihapus')->with('pembimbing_active', 'active');
    }
    public function deletePeserta($id){
        $data = PesertaAktivitasModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data telah dihapus')->with('peserta_active', 'active');
    }

    public function pesertaAktivitas($id){
        return view('prodi/pesertaAktivitas');
    }
    public function detilAktivitas($id)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $unit = session('user_unit');


        $aktivitasMhs = Functions::aktivitasByID($id);
        $aktivitas = array();
        foreach ($aktivitasMhs as $act){
            $jenis_aktivitas = $act->jenis_aktivitas;
            $aktivitas['nama_aktivitas'] = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;
            $aktivitas['id'] = $act->id;
            $aktivitas['prodi'] = $act->prodi;
            $aktivitas['semester'] = $act->semester;
            $aktivitas['prodi'] = $act->prodi;
            $aktivitas['no_sk_tugas'] = $act->no_sk_tugas;
            $aktivitas['tanggal_sk_tugas'] = $act->tanggal_sk_tugas;
            $aktivitas['jenis_aktivitas'] = $act->jenis_aktivitas;
            $aktivitas['jenis_anggota'] = $act->jenis_anggota;
            $aktivitas['judul_kegiatan'] = $act->judul_kegiatan;
            $aktivitas['keterangan'] = $act->keterangan;
            $aktivitas['lokasi_kegiatan'] = $act->lokasi_kegiatan;
            $aktivitas['program_kegiatan'] = $act->program_kegiatan;
            $aktivitas['tanggal_mulai'] = $act->tanggal_mulai;
            $aktivitas['tanggal_akhir'] = $act->tanggal_akhir;
        }
        $prodi = Services::getProdi($act->prodi);
        $dosen = Services::getDosenSeUNJ('All',session('user_token'));
        $mkKonversi = Http::get(env("SIAKAD_URI") . "/as400/penjadwalan/".trim($aktivitas['semester'])."/".$aktivitas['prodi']."/".session('user_token')."", []);
        $countMK = count($mkKonversi['isi']);
        $arrMK = $mkKonversi['isi'];   

        // @dd($arrMK);
        
        $peserta =DB::table('tr_peserta_aktivitas')->where('idaktivitas',$id)->get();
        $dospem =DB::table('tr_pembimbing_aktivitas')->where('idaktivitas',$id)->get();
        $mkKonvers = DB::table('tr_konversi_mk')->where('idaktivitas',$id)->get();
        $dosuji =DB::table('tr_penguji_aktivitas')->where('idaktivitas',$id)->get();
        $kategori =DB::table('ref_kategori_kegiatan')->get();
        $lenDosen = count($dosen['isi']);
        $arrDosen = $dosen['isi'];
        if (Session::has('pembimbing_active')) {
            Session::forget('peserta_active');
            Session::forget('konversi_active');
            Session::forget('penguji_active');
        } else if (Session::has('penguji_active')) {
            Session::forget('peserta_active');
            Session::forget('pembimbing_active');
            Session::forget('konversi_active');
        } else if (Session::has('konversi_active')) {
            Session::forget('peserta_active');
            Session::forget('pembimbing_active');
            Session::forget('penguji_active');
        } else {
            Session::flash('peserta_active', 'active');
        }

        $arrData = [
            'title'         => 'Detil Aktivitas ',
            'active'        => 'Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'paket_active'  => '',
            'list_active'   => '',
            'kovAktiv_active'  => '',
            'kovPermata_active'  => '',
            'aktivitas_active'  => 'active',
            'aktivitas'     => $aktivitas,
            'prodi'         => $prodi,
            'peserta'       => $peserta,
            'pembimbing'    => $dospem,
            'penguji'       => $dosuji,
            'getDosen'      => $dosen,
            'countDosen'    => $lenDosen,
            'arrDosen'      => $arrDosen,
            'mkKon'         => $mkKonvers,
            'mkKonversi'    => $mkKonversi,
            'countMK'       => $countMK,
            'arrMK'         => $arrMK,
            'kategori'      => $kategori
        ];
        // @dd($arrData);
        
        return view('prodi/detilAktivitas',$arrData);
    }

    public function addPembimbing(Request $request){
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $credentials = $request->validate([
            'nidn_bimbing'              => ['required'],
            'kategori_bimbing'          => ['required'],
            'pembimbing_ke'             => ['required']
        ]);

        $id = $request->id;
        $idAktivitas = $request->idaktivitas;
        $nidn = $request->nidn_bimbing;
        $id_kategori = $request->kategori_bimbing;
        $pembimbing_ke = $request->pembimbing_ke;

        if (!isset($request->nidn)) {
            return redirect()->back()->with('toast_error', 'Belum Pilih Dosen Pembimbing');
        }

        try {
            DB::beginTransaction();
            PembimbingAktivitasModel::updateOrCreate(
                [
                    'id'                    => $id
                ],
                [
                    'idaktivitas'           => $idAktivitas,
                    'nidn'                  => $nidn,
                    'id_kategori_kegiatan'  => $id_kategori,
                    'pembimbing_ke'         => $pembimbing_ke
                ]
            );

            DB::commit();
            return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_success', 'Penambahan Pembimbing Aktivitas Berhasil ')->with('pembimbing_active', 'active');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_error', 'Error : ' . $th->getMessage())->with('pembimbing_active', 'active');
        }
    }

    public function addPenguji(Request $request){
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $credentials = $request->validate([
            'nidn'                      => ['required'],
            'kategori'                  => ['required'],
            'penguji_ke'             => ['required']
        ]);

        $id = $request->id;
        $idAktivitas = $request->idaktivitas;
        $nidn = $request->nidn;
        $id_kategori = $request->kategori;
        $penguji_ke = $request->penguji_ke;

        if (!isset($request->nidn)) {
            return redirect()->back()->with('toast_error', 'Belum Pilih Dosen Penguji');
        }

        try {
            DB::beginTransaction();
            PengujiAktivitasModel::updateOrCreate(
                [
                    'id'                    => $id
                ],
                [
                    'idaktivitas'           => $idAktivitas,
                    'nidn'                  => $nidn,
                    'id_kategori_kegiatan'  => $id_kategori,
                    'penguji_ke'            => $penguji_ke
                ]
            );

            DB::commit();
            return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_success', 'Penambahan Penguji Aktivitas Berhasil ')->with('penguji_active', 'active');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_error', 'Error : ' . $th->getMessage())->with('penguji_active', 'active');
        }
    }

    public function addKonversiMK(Request $request)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $credentials = $request->validate([
            'penjadwalan'   => ['required']
        ]);

        $id = $request->id;
        $idAktivitas = $request->idaktivitas;
        $idJadwal = $request->penjadwalan;
        
        try {
            DB::beginTransaction();
            KonversiMKModel::updateOrCreate(
                [
                    'id'                    => $id
                ],
                [
                    'idaktivitas'           => $idAktivitas,
                    'idjadwal'                  => $idJadwal
                ]
            );

            DB::commit();
            // return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_success', 'Penambahan Konversi MK Aktivitas Berhasil ');
            return redirect()->back()->with('toast_success', 'Penambahan Konversi MK Aktivitas Berhasil')->with('konversi_active', 'active');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('prodi.detilAktivitas',$idAktivitas)->with('toast_error', 'Error : ' . $th->getMessage());
            return redirect()->back()->with('toast_error', 'Gagal Menambahkan Konversi MK Aktivitas')->with('konversi_active', 'active');
        }
    }

    public function konversiAktivitas()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $unit = session('user_unit');

        $periode = Services::getPeriodeAktif();
        $lsJenisAktivitas = DB::table('tr_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('jenis_aktivitas')->get();
        
        $pesertaKegiatan = DB::table('tr_peserta_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('idaktivitas')->get();
        foreach ($pesertaKegiatan as $pes){
            $pes->nama_kegiatan = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->judul_kegiatan;
            $pes->id_jenis_aktivitas = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->jenis_aktivitas;
            $pes->nama_jenis_aktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$pes->id_jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;
        }

        $arrData = [
            'title'         => 'Paket Mata Kuliah Aktivitas Mahasiswa',
            'active'        => 'konversiAktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'paket_active'  => '',
            'list_active'   => '',
            'aktivitas_active'  => '',
            'kovAktiv_active'  => 'active',
            'kovPermata_active'  => '',
            'aktivitas'     => $lsJenisAktivitas,
            'pesertaKegiatan'=>$pesertaKegiatan
        ];
        return view('prodi/konversiAktivitas',$arrData);
    }

    public function konversiPermata()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $unit = session('user_unit');

        $periode = Services::getPeriodeAktif();
        $lsJenisAktivitas = DB::table('tr_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('jenis_aktivitas')->get();
        
        $pesertaKegiatan = DB::table('tr_peserta_aktivitas')->where('prodi',session('user_unit'))->where('semester',$periode['data'][0]['kode_semester'])->orderBy('idaktivitas')->get();
        foreach ($pesertaKegiatan as $pes){
            $pes->nama_kegiatan = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->judul_kegiatan;
            $pes->id_jenis_aktivitas = DB::table('tr_aktivitas')->where('id',$pes->idaktivitas)->first()->jenis_aktivitas;
            $pes->nama_jenis_aktivitas = DB::table('ref_jenis_aktivitas')->where('id_jenis_aktivitas_mahasiswa',$pes->id_jenis_aktivitas)->first()->nama_jenis_aktivitas_mahasiswa;
        }

        $arrData = [
            'title'         => 'Paket Mata Kuliah Aktivitas Mahasiswa',
            'active'        => 'konversiPermata',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'paket_active'  => '',
            'list_active'   => '',
            'aktivitas_active'  => '',
            'kovAktiv_active'  => '',
            'kovPermata_active'  => 'active',
            'aktivitas'     => $lsJenisAktivitas,
            'pesertaKegiatan'=>$pesertaKegiatan
        ];
        return view('prodi/konversiPermata',$arrData);
    }
}
