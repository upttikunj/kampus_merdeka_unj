<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Helpers\Services;
use App\Models\AktivitasModel;
use App\Models\PesertaAktivitasModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
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
            'daftar_active'  => '',
            'history_active'   => '',
            'konversi_active'  => ''
        ];
        return view('mahasiswa/index',$arrData);
    }

    public function pendaftaran()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login');
        }
        
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        
        //referensi data
        $periode = Services::getPeriodeAktif();
        $aktifSemester = Services::getAktifMahasiswa(trim($periode['data'][0]['kode_semester']),session('user_username'),session('user_token'));
        $dataMahasiswa = Services::getDataMahasiswa(session('user_username'),session('user_token'));
        $prestasiMhs = Services::getDataIPK(session('user_username'));
        

        $lsJenisAktivitas = DB::table('tr_aktivitas')->where('prodi',$dataMahasiswa['isi'][0]['kodeProdi'])->where('semester',$periode['data'][0]['kode_semester'])->orderBy('jenis_aktivitas')->get();
        
        $peserta = DB::table('tr_peserta_aktivitas')->where('nim',session('user_username'))->get();

        // var_dump($peserta);

        $arrData = [
            'title'         => 'Pendaftaran',
            'active'        => 'Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'daftar_active'  => '',
            'history_active'   => '',
            'konversi_active'  => '',
            'aktivitas_active'    => 'active',
            'lsJenisAktivitas'  => $lsJenisAktivitas,
            'periode'           => $periode,
            'statusAktif'       => $aktifSemester,
            'dataMahasiswa'     => $dataMahasiswa,
            'prestasiAkademik'  => $prestasiMhs,
            'dataPeserta'       => $peserta
        ];
        return view('mahasiswa.pendaftaran',$arrData);
    }

    public function konversi_mk()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'Konversi Mata Kuliah',
            'active'        => 'Konversi MK',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'daftar_active'  => '',
            'history_active'   => '',
            'konversi_active'  => 'active'
        ];
        return view('mahasiswa/konversiMK',$arrData);
    }
    public function histori_aktivitas()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'History Kegiatan Mahasiswa',
            'active'        => 'History Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'         => '',
            'subtitle'      => '',
            'home_active'   => '',
            'daftar_active'  => '',
            'history_active'   => 'active',
            'konversi_active'  => ''
        ];
        return view('mahasiswa/konversiMK',$arrData);
    }

    public function store (Request $request)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login')->with('login_msg', 'Masa Login anda habis, silakan login kembali');
        }

        $credentials = $request->validate([
            'nim'           => ['required'],
            'nama'          => ['required'],
            'prodi'         => ['required'],
            'periode'       => ['required'],
            'ipk'           => ['required'],
            'sks_krs'       => ['required'],
            'idaktivitas'   => ['required']
        ]);

        $id = "";
        $semester = trim($request->periode);
        $prodi = $request->prodi;
        $nim = $request->nim;
        $nama = $request->nama;
        $ipk = $request->ipk;
        $sks = $request->sks_krs;
        $idaktivitas = $request->idaktivitas;
        //explode
        $a = explode('-',$semester);
        $smt = trim($a[0]);
        $kdProdi = substr($prodi,0,5);
        
        // var_dump($smt);

        if (!isset($request->idaktivitas)) {
            return redirect()->back()->with('toast_error', 'Belum Pilih Jenis Aktivitasnya');
        }
        $getData = DB::table('tr_peserta_aktivitas')->where('idaktivitas',$idaktivitas)->get();
        $num = $getData->count();
        if ($num >= 1){
            return redirect()->back()->with('toast_error', 'Aktivitas ini sudah terdaftar');
        }

        if ($ipk < 3){
            return redirect()->back()->with('toast_error', 'IPK Anda tidak layak ');
        }
        
        try {
            DB::beginTransaction();
            PesertaAktivitasModel::updateOrCreate(
                [
                    'id'                => $id
                ],
                [
                    'prodi'             => $kdProdi,
                    'semester'          => $smt,
                    'nim'               => $nim,
                    'idaktivitas'       => $idaktivitas,
                    'nama'              => $nama,
                    'ipk'               => $ipk,
                    'sks_krs'           => $sks
                ]
            );

            DB::commit();
            return redirect()->route('mahasiswa.pendaftaran')->with('toast_success', 'Berhasil Mendaftar Aktivitas');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('mahasiswa.pendaftaran')->with('toast_error', 'Error : ' . $th->getMessage());
        }
    }

    public function deleteAktivitas($id)
    {
        $data = PesertaAktivitasModel::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('toast_success', 'Data Aktivitas telah dihapus')->with('dispen_active', 'active');
    }
}
