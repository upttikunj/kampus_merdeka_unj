<?php

namespace App\Http\Controllers;

use App\Helpers\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Hoa\Console;


class AktivitasController extends Controller
{
    public function pendaftaran()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login');
        }
        
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');
        $lsJenisAktivitas = DB::table('ref_jenis_aktivitas')->get();

        //referensi data
        $periode = Services::getPeriodeAktif();
        $aktifSemester = Services::getAktifMahasiswa(trim($periode['data'][0]['kode_semester']),session('user_username'),session('user_token'));
        $dataMahasiswa = Services::getDataMahasiswa(session('user_username'),session('user_token'));
        $prestasiMhs = Services::getDataIPK(session('user_username'));

        // print_r($periode);
        $arrData = [
            'title'         => 'Pendaftaran',
            'active'        => 'Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => '',
            'out_active'     => '',
            'pass_active'     => '',
            'lsJenisAktivitas'  => $lsJenisAktivitas,
            'periode'           => $periode,
            'statusAktif'       => $aktifSemester,
            'dataMahasiswa'     => $dataMahasiswa,
            'prestasiAkademik'  => $prestasiMhs,
            'aktivitas_active'    => 'active'
        ];
        return view('pendaftaran',$arrData);
    }

    public function konversi_krs()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login');
        }
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'KRS Konversi',
            'active'        => 'Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => '',
            'out_active'     => '',
            'pass_active'     => '',
            'aktivitas_active'    => 'active'
        ];
        return view('konversiMK',$arrData);
    }

    public function his_aktivitas()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login');
        }
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'History Aktivitas',
            'active'        => 'Aktivitas',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => '',
            'out_active'     => '',
            'pass_active'     => '',
            'aktivitas_active'    => 'active'
        ];
        return view('his_aktivitas',$arrData);
    }
}
