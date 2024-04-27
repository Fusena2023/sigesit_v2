<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Pengguna;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users_pengguna']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users_pengguna'
        ]);

        if ($validator->fails()) {
            return redirect('/register#menu1')
                ->withErrors($validator)
                ->withInput();
        }

        $jabatan = $request->jabatan;
        $pendidikan = $request->pendidikan;
        if ($request->pekerjaan == "Lainnya") {
            $pekerjaan = $request->lainnya;
        } else {
            $pekerjaan = $request->pekerjaan;
        }
        $playanan = $request->playanan;
        $nama = $request->nama;
        $email = $request->email;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $pass = $request->password;
        $password = Hash::make($pass);
        $datenow = date('Y-m-d H:i:s');
        $jenis_kelamin = $request->jenis_kelamin;
        $nik = $request->nik;
        $npwp = $request->npwp;

        // $id = Pengguna::insertGetId([
        //     'nama'              => $nama,
        //     'email'             => $email,
        //     'alamat'            => $alamat,
        //     'no_telp'           => $telp,
        //     'password'          => $password,
        //     'jenis_pengguna'    => '1',
        //     'jabatan'           => $jabatan,
        //     'pendidikan'        => $pendidikan,
        //     'pekerjaan'         => $pekerjaan,
        //     'perolehan_pelayanan' => $playanan,
        //     'jenis_kelamin'     => $jenis_kelamin,
        //     'aktifasi'          => true,
        //     'created_at'        => $datenow,
        //     'updated_at'        => null,
        //     ]);

        $data = [
            'nama'              => $nama,
            'email'             => $email,
            'alamat'            => $alamat,
            'telepon'           => $telp,
            'password'          => $pass,
            'jabatan'           => $jabatan,
            'pendidikan'        => $pendidikan,
            'pekerjaan'         => $pekerjaan,
            'perolehan_pelayanan' => $playanan,
            'jenis_kelamin'     => $jenis_kelamin,
            'nik'               => $nik,
            'npwp'              => $npwp,
        ];

        $url = env('API_SIGESIT_URL').'/register';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($res);

        Session::flash('success', 'Registrasi Berhasil');

        return redirect()->to('/login');
    }

    public function storeinstansi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users_pengguna'
        ]);

        if ($validator->fails()) {
            return redirect('/register#home')
                ->withErrors($validator)
                ->withInput();
        }

        $jabatan = $request->jabatan;
        $pendidikan = $request->pendidikan;
        if ($request->pekerjaan == "Lainnya") {
            $pekerjaan = $request->lainnya;
        } else {
            $pekerjaan = $request->pekerjaan;
        }
        $playanan = $request->playanan;
        $nama = $request->nama;
        $email = $request->email;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $pass = $request->password;
        $password = Hash::make($pass);
        $datenow = date('Y-m-d H:i:s');
        $jenis_kelamin = $request->jenis_kelamin;

        $jinstansi = $request->jinstansi;
        $namainstansi = $request->namainstansi;
        $direktorat = $request->direktorat;
        $npwp = $request->npwp;

        // $id = Pengguna::insertGetId([
        //     'nama' => $nama,
        //     'email' => $email,
        //     'alamat_instansi' => $alamat,
        //     'no_telp' => $telp,
        //     'password' => $password,
        //     'jenis_pengguna' => '2',
        //     'jabatan'           => $jabatan,
        //     'pendidikan'        => $pendidikan,
        //     'pekerjaan'         => $pekerjaan,
        //     'perolehan_pelayanan' => $playanan,
        //     'jenis_kelamin'     => $jenis_kelamin,
        //     'aktifasi' => true,
        //     'jenis_instansi' => $jinstansi,
        //     'instansi' => $namainstansi,
        //     'direktorat' => $direktorat,
        //     'npwp' => $npwp,
        //     'created_at' => $datenow,
        //     'updated_at' => null,
        //     ]);

        $data = [
            'nama'              => $nama,
            'email'             => $email,
            'alamat_instansi'   => $alamat,
            'telepon'           => $telp,
            'password'          => $pass,
            'jabatan'           => $jabatan,
            'pendidikan'        => $pendidikan,
            'pekerjaan'         => $pekerjaan,
            'perolehan_pelayanan' => $playanan,
            'jenis_kelamin'     => $jenis_kelamin,
            'jenis_instansi'    => $jinstansi,
            'instansi'          => $namainstansi,
            'direktorat'        => $direktorat,
            'npwp'              => $npwp,
        ];

        $url = env('API_SIGESIT_URL').'/register-instansi';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($res);
        Session::flash('success', 'Registrasi Berhasil');

        return redirect()->to('/login');
    }
}
