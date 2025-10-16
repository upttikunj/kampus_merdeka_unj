<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    protected $redirectsTo = '/login';

    public function index()
    {
        
        if (session('isLoggedIn') == true) {
            return redirect()->to('home');
        }
        return view('login');
    }
    public function attemptLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required']
        ]);

        // @dd($credentials);
        
        $url = env('SIAKAD_URI') . "/as400/signin";
        $response = Http::asForm()->post($url, $credentials);
        $response = json_decode($response);
        // echo $url;
        // @dd($response->status);
        // echo $response->status;
        if ($response->status != 1) {
            $this->logout($request);
            $request->flash();
            return redirect()->to('login')->with('login_msg', 'Gagal melakukan koneksi ke SIAKAD');
        }

        $set_session = $this->setUserSession($response);
        // @dd($set_session);

        if ($set_session) {
            if (session('user_cmode') == '2'){
                return redirect()->to('prodi');
            }elseif (session('user_cmode') == '9'){
                return redirect()->to('mahasiswa');
            }else{
                return redirect()->to('home');
            }

        } else {
            return redirect()->to('login')->with('login_msg', 'Server SQL tidak aktif');
        }
    }
    protected function setUserSession($user)
    {
        try {
            $akun = DB::table('ref_mode')->where('id', $user->mode)->first();
            $mode = $akun->mode;
            session([
                'user_name' => $user->nama,
                'user_username' => $user->username,
                'user_cmode' => $user->mode,
                'user_mode' => $mode,
                'user_sex' => $user->kelamin,
                'user_unit' => $user->unit,
                'user_token' => $user->Authorization,
                'isLoggedIn' => true,
            ]);
            
            return true;
        } catch (Exception $ex) {
            Log::info('User failed to login : ', ['username' => $user->username]);
            Log::debug($ex);
            return false;
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($this->redirectsTo);
    }
}
