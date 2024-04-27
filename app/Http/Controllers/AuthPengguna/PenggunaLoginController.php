<?php

namespace App\Http\Controllers\AuthPengguna;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Pengguna;
use Mail;
use Session;

class PenggunaLoginController extends Controller
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
    // protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest:pengguna')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $id_layanan = isset($_GET['id']) ? $_GET['id'] : null;
        $jenis_layanan = isset($_GET['jenis']) ? base64_decode($_GET['jenis']) : null;
        $users = Pengguna::where('aktifasi', true)->get();
        return view('auth.loginpengguna', compact('users', 'id_layanan', 'jenis_layanan'));
    }
    public function loginpengguna(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        $service = 'tes';
        // $service = getServiceLoginPengguna($request->email, $request->password);
        if ($service != NULL) {
            if (Auth::guard('pengguna')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //login last
                date_default_timezone_set("Asia/Bangkok");
                $datenow = date('Y-m-d H:i:s');
                $login_last = Pengguna::where('id', Auth::guard('pengguna')->user()->id)->update(['login_last' => $datenow]);
                if ($request->jenis == 'jasa' || $request->jenis == 'ig') {
                    return redirect()->intended(route('pengguna.tiketlayananjasa', $request->id_layanan));
                } else if ($request->jenis == 'peta') {
                    return redirect()->intended(route('pengguna.tiketlayananproduk', 'peta'));
                } else if ($request->jenis == 'pasut') {
                    return redirect()->intended(route('pengguna.index.pasang_surut'));
                } else if ($request->jenis == 'kontrak') {
                    return redirect()->intended(route('pengguna.index.kerja_sama'));
                } else if ($request->from_faq == 'yes') {
                    return redirect()->intended(route('pengguna.pesan.baru'));
                } else {
                    return redirect()->intended(route('home'));
                }
            }
        } else {
            Session::flash('error', 'Email atau password tidak sesuai');
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->intended('/login')->with('error', 'Email atau password tidak sesuai');
    }
    public function logout()
    {
        Auth::guard('pengguna')->logout();
        return redirect()->route('home');
    }
}
