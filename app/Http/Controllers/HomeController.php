<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Helpers\Function;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    
    public function index()
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->to('login');
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
            'in_active'     => '',
            'out_active'    => '',
            'pass_active'     => '',
            'paket_active'     => '',
            'list_active'     => '',
            'aktivitas_active'    => ''
        ];
        return view('home',$arrData);
    }

    public function bangun_desa()
    {
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'Membangun Desa',
            'active'        => 'home',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => '',
            'out_active'    => 'active',
            'pass_active'     => '',
            'aktivitas_active'    => ''
        ];
        return view('outbound',$arrData);
    }
    public function inbound()
    {
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'Inbound',
            'active'        => 'home',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => 'active',
            'out_active'    => '',
            'pass_active'     => '',
            'paket_active'     => '',
            'aktivitas_active'    => ''
        ];
        return view('inbound',$arrData);
    }
    public function outbound()
    {
        $user = session('user_name');
        $mode = session('user_mode');
        $cmode = session('user_cmode');

        $arrData = [
            'title'         => 'Outbound',
            'active'        => 'home',
            'user'          => $user,
            'mode'          => '',
            'cmode'          => '',
            'subtitle'      => '',
            'home_active'   => '',
            'in_active'     => '',
            'out_active'    => 'active',
            'pass_active'     => '',
            'aktivitas_active'    => ''
        ];
        return view('outbound',$arrData);
    }
}
