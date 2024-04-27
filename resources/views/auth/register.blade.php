<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>BIG</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/ico" href="{{url('assets/digilab/images/ico.png')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('logincss/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('logincss/css/main.css')}}">
    <!--===============================================================================================-->

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--sweetalertEND-->

    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    <!--hide arrows for type number-->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../assets/digilab/images/bg_1.jpg');">
            <div class="wrap-login100">
                <span class="login100-form-logo">
                    <img src="{{url('assets/digilab/images/ico.png')}}" alt="" style="max-height: 115px; max-width:115px">
                    </span>

                    <span class=" login100-form-title p-b-34 p-t-27">
                    Daftar Akun
                </span>

                <div class="container-login100-form-btn" style="border-bottom: 2px solid #ddd;padding-bottom:10px;margin-bottom:20px;">
                    <a class="login100-form-btn" id="menu1btn" data-toggle="tab" href="#menu1">Perorangan</a>&nbsp
                    <a class="login100-form-btn" id="homebtn" data-toggle="tab" href="#home">Instansi</a>&nbsp
                </div>

                <div class="tab-content">

                    <div id="menu1" class="tab-pane fade in active" style="display:none">
                        <form class="login100-form" id="login-user-internal-form" role="form" method="POST" action="{{ route('register.pengguna') }}">
                            {{ csrf_field() }}
                            @if ($errors->has('email'))
                            <span class="login10-form-alert" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <div class="wrap-input100 validate-input" data-validate="Enter username">
                                <input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                                <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter jabatan">
                                <input id="jabatan" type="jabatan" class="input100{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" value="{{ old('jabatan') }}" required placeholder="Jabatan">
                                @if ($errors->has('jabatan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('jabatan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf19d;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Pendidikan">
                                <select id="pendidikan" type="pendidikan" class="js-example-basic-single input100{{ $errors->has('pendidikan') ? ' is-invalid' : '' }}" name="pendidikan" required style="width:100%;">
                                    <option value="{{ old('pendidikan') }}">Pendidikan Terakhir</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="DIPLOMA">DIPLOMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                                @if ($errors->has('pendidikan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('pendidikan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Pekerjaan">
                                <select id="pekerjaan" type="pekerjaan" class="js-example-basic-single input100{{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}" name="pekerjaan" required style="width:100%;">
                                    <option value="{{ old('pekerjaan') }}">Pekerjaan</option>
                                    <option value="PNS">PNS</option>
                                    <option value="TNI">TNI</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @if ($errors->has('pekerjaan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('pekerjaan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Lainnya" id="PekerjaanLain" style="display:none">
                                <input id="Lainnya" type="lainnya" class="input100{{ $errors->has('lainnya') ? ' is-invalid' : '' }}" name="lainnya" value="{{ old('lainnya') }}" placeholder="Lainnya">
                                <span class="focus-input100" data-placeholder="&#xf175;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Perolehan Layanan">
                                <select id="playanan" type="text" class="js-example-basic-single input100{{ $errors->has('playanan') ? ' is-invalid' : '' }}" name="playanan" required style="width:100%;">
                                    <option value="{{ old('playanan') }}">Perolehan Layanan</option>
                                    <option value="datang">Datang Langsung</option>
                                    <option value="email">Email</option>
                                    <option value="telpon">Telpon/WA/SMS</option>
                                </select>
                                @if ($errors->has('playanan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('playanan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Nama">
                                <input id="nama" type="nama" class="input100{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required placeholder="Nama">
                                @if ($errors->has('nama'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Jenis Kelamin">
                                <select id="jenis_kelamin" type="text" class="js-example-basic-single input100{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" required style="width:100%;">
                                    <option value="{{ old('jenis_kelamin') }}">Jenis Kelamin</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                @if ($errors->has('jenis_kelamin'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf22c;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Alamat">
                                <input id="alamat" type="alamat" class="input100{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" required placeholder="Alamat">
                                @if ($errors->has('alamat'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf175;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter NIK">
                                <input min="1000000000000000" id="nik" type="number" class="input100{{ $errors->has('nik') ? ' is-invalid' : '' }}" name="nik" value="{{ old('nik') }}" required placeholder="NIK" onKeyPress="if(this.value.length==16) return false;" oninvalid="this.setCustomValidity('NIK must be 16 characters')"
                                oninput="setCustomValidity('')">
                                @if ($errors->has('alamat'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('nik') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf175;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter NPWP">
                                <input oninput="setCustomValidity('')" min="100000000000000" id="npwp" type="number" class="input100{{ $errors->has('npwp') ? ' is-invalid' : '' }}" name="npwp" value="{{ old('npwp') }}" required placeholder="NPWP" onKeyPress="if(this.value.length==15) return false;" oninvalid="this.setCustomValidity('NPWP must be 15 characters')">
                                @if ($errors->has('npwp'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf129;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter No Telpon">
                                <input pattern="[0-9]+" title="Phone must be numbers only" id="telp" type="number" class="input100{{ $errors->has('telp') ? ' is-invalid' : '' }}" name="telp" value="{{ old('telp') }}" required placeholder="No Telpon">
                                @if ($errors->has('telp'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('telp') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf2cc;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Password">
                                <input pattern="(?=.*[.!@#$%^&*])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be min 8 characters including upper case, lower case, number and symbol" id="password" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required placeholder="Password" autocomplete="off">
                                @if ($errors->has('password'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            </div>
                            <div class="validate-input" data-validate="Isi Captcha">
                                <center>
                                    <div id="captcha-perorangan"></div>
                                </center>
                                @if ($errors->has('captcha'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>

                            <div class="container-login100-form-btn">
                                <a class="liactive" href="{{ route('login') }}">Kembali</a>
                                <button id="btn-daftar" type="button" class="login100-form-btn" onclick="verifyCaptchaPerorangan(grecaptcha.getResponse(widget_perorangan))">Daftar</button>
                            </div>
                        </form>
                    </div>

                    <div id="home" class="tab-pane fade in active" style="display:none">
                        <form class="login100-form" id="login-user-pengguna-form" method="POST" action="{{route('register.penggunainstansi') }}">
                            @csrf
                            @if ($errors->has('email'))
                                <span class="login10-form-alert" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            <div class="wrap-input100 validate-input" data-validate="Enter username">
                                <input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                                <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter jabatan">
                                <input id="jabatan" type="jabatan" class="input100{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" value="{{ old('jabatan') }}" required placeholder="Jabatan">
                                @if ($errors->has('jabatan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('jabatan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf19d;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Pendidikan">
                                <select id="pendidikan" type="pendidikan" class="js-example-basic-single input100{{ $errors->has('pendidikan') ? ' is-invalid' : '' }}" name="pendidikan" required style="width:100%;">
                                    <option value="{{ old('pendidikan') }}">Pendidikan Terakhir</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="DIPLOMA">DIPLOMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                                @if ($errors->has('pendidikan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('pendidikan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Pekerjaan">
                                <select id="pekerjaanInstansi" type="pekerjaan" class="js-example-basic-single input100{{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}" name="pekerjaan" required style="width:100%;">
                                    <option value="{{ old('pekerjaan') }}">Pekerjaan</option>
                                    <option value="PNS">PNS</option>
                                    <option value="TNI">TNI</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @if ($errors->has('pekerjaan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('pekerjaan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Lainnya" id="PekerjaanLainIns" style="display:none">
                                <input id="lainnya" type="Lainnya" class="input100{{ $errors->has('lainnya') ? ' is-invalid' : '' }}" name="lainnya" value="{{ old('lainnya') }}" placeholder="Lainnya">
                                <span class="focus-input100" data-placeholder="&#xf175;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Perolehan Layanan">
                                <select id="playanan" type="text" class="js-example-basic-single input100{{ $errors->has('playanan') ? ' is-invalid' : '' }}" name="playanan" required style="width:100%;">
                                    <option value="{{ old('playanan') }}">Perolehan Layanan</option>
                                    <option value="datang">Datang Langsung</option>
                                    <option value="email">Email</option>
                                    <option value="telpon">Telpon/WA/SMS</option>
                                </select>
                                @if ($errors->has('playanan'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('playanan') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf247;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter JenisInstansi">
                                <select id="jinstansi" type="jinstansi" class="js-example-basic-single input100{{ $errors->has('jinstansi') ? ' is-invalid' : '' }}" name="jinstansi" required style="width:100%;">
                                    <option value="{{ old('jinstansi') }}">Jenis Instansi</option>
                                    <option value="Kementerian">Kementerian/Lembaga</option>
                                    <option value="Pendidikan">Institusi Pendidikan</option>
                                    <option value="Pemda">Pemda</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @if ($errors->has('jinstansi'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('jinstansi') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf109;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter NamaInstansi">
                                <input id="namainstansi" type="namainstansi" class="input100{{ $errors->has('namainstansi') ? ' is-invalid' : '' }}" name="namainstansi" value="{{ old('namainstansi') }}" required placeholder="Nama Instansi">
                                @if ($errors->has('namainstansi'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('namainstansi') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf127;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter Direktorat">
                                <input id="direktorat" type="direktorat" class="input100{{ $errors->has('direktorat') ? ' is-invalid' : '' }}" name="direktorat" value="{{ old('direktorat') }}" required placeholder="Direktorat">
                                @if ($errors->has('direktorat'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('direktorat') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf109;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter Alamat">
                                <input id="alamat" type="alamat" class="input100{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" required placeholder="Alamat">
                                @if ($errors->has('alamat'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf1ab;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter NPWP">
                                <input oninput="setCustomValidity('')" min="100000000000000" id="npwp" type="number" class="input100{{ $errors->has('npwp') ? ' is-invalid' : '' }}" name="npwp" value="{{ old('npwp') }}" required placeholder="NPWP" onKeyPress="if(this.value.length==15) return false;" oninvalid="this.setCustomValidity('NPWP must be 15 characters')">
                                @if ($errors->has('npwp'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf129;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter Nama">
                                <input id="nama" type="nama" class="input100{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required placeholder="Nama PIC">
                                @if ($errors->has('nama'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter Jenis Kelamin">
                                <select id="jenis_kelamin" type="text" class="js-example-basic-single input100{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" required style="width:100%;">
                                    <option value="{{ old('jenis_kelamin') }}">Jenis Kelamin</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                @if ($errors->has('jenis_kelamin'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf22c;"></span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Enter No Telpon">
                                <input pattern="[0-9]+" title="Phone must be numbers only" id="telp" type="number" class="input100{{ $errors->has('telp') ? ' is-invalid' : '' }}" name="telp" value="{{ old('telp') }}" required placeholder="No Telpon">
                                @if ($errors->has('telp'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('telp') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf2cc;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Password">
                                <input pattern="(?=.*[.!@#$%^&*])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be min 8 characters including upper case, lower case, number and symbol" id="password" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required placeholder="Password" autocomplete="off">
                                @if ($errors->has('password'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            </div>
                            <div class="validate-input" data-validate="Isi Captcha">
                                <center>
                                    <div id="captcha-instansi"></div>
                                </center>
                                @if ($errors->has('captcha'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>

                            <div class="container-login100-form-btn">
                                <a class="liactive" href="{{ route('login') }}">Kembali</a>
                                <button id="btn-instansi" class="login100-form-btn" type="button" onclick="verifyCaptchaInstansi(grecaptcha.getResponse(widget_instansi))">
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <a id="btn-back" class="liactive" href="{{ route('login') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{url('logincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{url('logincss/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('logincss/js/main.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/microplugin/0.0.3/microplugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sifter/0.5.3/sifter.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
            $("#homebtn").click(function() {
                $("#home").show();
                $("#menu1").hide();
                $("#menu2").hide();
                $("#homebtn").addClass("liactive").removeClass("login100-form-btn");
                $("#menu1btn").addClass("login100-form-btn").removeClass("liactive");
                $("#menu2btn").addClass("login100-form-btn").removeClass("liactive");
                $("#menu1").removeClass("active");
                $("#menu2").removeClass("active");
                $('#btn-back').hide();

            });
            $("#menu1btn").click(function() {
                $("#home").hide();
                $("#menu1").show();
                $("#menu2").hide();
                $("#menu1btn").addClass("liactive").removeClass("login100-form-btn");
                $("#homebtn").addClass("login100-form-btn").removeClass("liactive");
                $("#menu2btn").addClass("login100-form-btn").removeClass("liactive");
                $("#home").removeClass("active");
                $("#menu2").removeClass("active");
                $('#btn-back').hide();
            });
        });

        $('#pekerjaan').change(function() {
            let p = $(this).val();

            if (p == 'Lainnya') {
                $('#PekerjaanLain').show();
            } else {
                $('#PekerjaanLain').hide();
            }
        })
        $('#pekerjaanInstansi').change(function() {
            let p = $(this).val();

            if (p == 'Lainnya') {
                $('#PekerjaanLainIns').show();
            } else {
                $('#PekerjaanLainIns').hide();
            }
        })
    </script>

    <script type="text/javascript">
        var verifyCallback = function(response) {
            alert(response);
        }
        var widget_perorangan;
        var widget_instansi;
        var onloadCallback = function() {
            widget_perorangan = grecaptcha.render('captcha-perorangan', {
                'sitekey': "{{config('captcha.site_key_recaptcha')}}",
                'theme': 'light'
            });
            widget_instansi = grecaptcha.render('captcha-instansi', {
                'sitekey': "{{config('captcha.site_key_recaptcha')}}",
                'theme': 'light'
            });
        }

        function verifyCaptchaPerorangan(result) {
            if (result !== "") {
                $( "#btn-daftar" ).attr( "type", "submit" );
                // $('#login-user-internal-form').submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Captcha terlebih dahulu!',
                    showConfirmButton: true,
                });
            }
        }

        function verifyCaptchaInstansi(result) {
            if (result !== "") {
                $( "#btn-instansi" ).attr( "type", "submit" );
                // $('#login-user-pengguna-form').submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Captcha terlebih dahulu!',
                    showConfirmButton: true,
                });
            }
        }
    </script>

    <script>
        $(document).ready(function() { 
            if (location.hash == '#home'){
                $("#home").show();
                $("#menu1").hide();
                $("#homebtn").addClass("liactive").removeClass("login100-form-btn");
                $("#menu1btn").addClass("login100-form-btn").removeClass("liactive");
                $('#btn-back').hide();
            } else if (location.hash == '#menu1') {
                $("#home").hide();
                $("#menu1").show();
                $("#menu1btn").addClass("liactive").removeClass("login100-form-btn");
                $("#homebtn").addClass("login100-form-btn").removeClass("liactive");
                $('#btn-back').hide();
            } else {
                $("#home").hide();
                $("#menu1").hide();
            }

            if (location.hash) {
                $('a[href=\'' + location.hash + '\']').tab('show');
            }
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }
        });
    
        $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
        e.preventDefault()
        var tab_name = this.getAttribute('href')
        if (history.pushState) {
            history.pushState(null, null, tab_name)
        }
        else {
            location.hash = tab_name
        }
        localStorage.setItem('activeTab', tab_name)
    
        $(this).tab('show');
        return false;
        });

        $(window).on('popstate', function () {
            var anchor = location.hash ||
            $('a[data-toggle=\'tab\']').first().attr('href');
            $('a[href=\'' + anchor + '\']').tab('show');
        });

    </script>

    @if(Session::has('success'))
        <script type="text/javascript">
            swal('Berhasil', '{{Session::get("success")}}', 'success');
        </script>
        <?php
        Session::forget('success');
        ?>
        @endif
        @if(Session::has('error'))
        <script type="text/javascript">
            swal('Gagal', '{{Session::get("error")}}', 'error');
        </script>
        <?php
        Session::forget('error');
        ?>
    @endif

</body>
</html>