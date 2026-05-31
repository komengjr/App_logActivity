<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function verifikasi_Login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $ip = request()->ip();
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = '103.146.244.1'; // Contoh IP Indonesia untuk keperluan testing di localhost
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (Auth::user()->akses == 'dir' || Auth::user()->akses == 'admin' || Auth::user()->akses == 'staff' || Auth::user()->akses == 'sdm') {
                return '<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                                            <strong>Greate!</strong> Selamat Datang ' . Auth::user()->name . '.
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <script>window.location.href = "' . route('dashboard_home') . '";</script>
                                        </div>';
            } else {
                // Mencari lokasi berdasarkan IP
                $locationData = Location::get($ip);

                // Ambil nama negara dan kota jika ditemukan
                $country = $locationData ? $locationData->countryName : 'Unknown';
                $city = $locationData ? $locationData->cityName : 'Unknown';

                // Simpan ke database log_login
                DB::table('z_login_logs')->insert([
                    'user_id'    => $request->email,
                    'ip_address' => $ip,
                    'country'    => $country,
                    'city'       => $city,
                    'user_agent' => request()->userAgent(),
                    'login_at'   => now(),
                ]);
                return '<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                                            <strong>Greate!</strong> Selamat Datang ' . Auth::user()->name . '.
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <script>window.location.href = "' . route('dashboard_home') . '";</script>
                                        </div>';
                // return redirect()->intended('home')->withSuccess('Kamu Berhasil Masuk di Account  ' . Auth::user()->name);
                # code...
            }
        }
        return '<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                                            <strong>Error!</strong> Username Dan Password Ada Kesalahan.
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
    }
    public function logout()
    {
        Auth::logout();

        return Redirect('/');
    }
}
