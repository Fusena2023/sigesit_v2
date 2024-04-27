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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--sweetalertEND-->
    <style>
        .input100 {
            color: #15325c;
        }

        .focus-input100::before {
            background: #3e8abe !important;
        }

        .focus-input100::after {
            color: #15325c;
        }

        ::placeholder {
            color: #15325c !important;
        }

        .login100-form-btn::before {
            background-color: #15325c;
        }

        .login100-form-btn {
            color: white;
        }
    </style>


</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/digilab/images/bg_login.png');background-size:cover;background-repeat:no-repeat;">
            <div class="wrap-login100" style="padding:30px 55px 37px 55px!important;background:white;">
                <span class="login100-form-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{url('assets/digilab/images/ico2.png')}}" alt="" style="max-height: 115px; max-width:115px">
                    </a>
                </span>

                <span class="login100-form-title p-b-34" style="font-size:22px;">
                    Badan Informasi<br>Geospasial
                </span>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in show active">
                        <form class="login100-form" id="login-user-pengguna-form" method="POST" action="{{url('loginpengguna') }}">
                            @csrf
                            <input type="hidden" name="from_faq" value="{{request()->faq}}">
                            <input type="hidden" name="id_layanan" value="{{$id_layanan}}">
                            <input type="hidden" name="jenis" value="{{$jenis_layanan}}">
                            <div class="wrap-input100 validate-input" data-validate="Enter Email" style="border-bottom:2px solid rgb(21 50 92)">
                                <!--<select id="email" type="email" class="js-example-basic-single input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required style="width:100%;">
                                        <option value="{{ old('email') }}">{{ __('E-Mail Address') }}</option>
                                        @foreach($users as $users)
                                        <option value="{{$users->email}}">{{$users->nama}} ({{$users->email}})</option>
                                        @endforeach
                                    </select>-->
                                <input id="email_pengguna" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}" style="width:100%;">

                                @if ($errors->has('email'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter password" style="margin-bottom:0px;border-bottom:2px solid rgb(21 50 92)">
                                <input id="password_pengguna" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required maxlength="50" placeholder="{{ __('Password') }}" autocomplete="off">
                                @if ($errors->has('password'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                                <span id="lihat_pass" onclick="change()" class="input-group-text" style="margin-left: -2rem; position: relative; top: 12px">
                                    <!-- icon mata bawaan bootstrap  -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="wrap-input100" style="border-bottom:0px;text-align:right; display: block;">
                                <span style="font-family:'Poppins-Regular';font-size:14px;color:#15325c;">
                                    Lupa Password?
                                    <a href="{{ route('password.request') }}" style="color:#3e8abe;">Klik Disini</a></span>
                            </div>

                            <center>
                                <div class="validate-input" data-validate="Isi Captcha">
                                    <div id="captcha-pengguna"></div>
                                    @if ($errors->has('captcha'))
                                    <span class="login100-form-alert" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </center>
                            <br>
                            <div class="container-login100-form-btn">
                                <a class="liactive" href="{{ route('register') }}">Register</a>
                                <button class="login100-form-btn" type="button" onclick="verifyCaptchaPengguna(grecaptcha.getResponse(widget_pengguna))">
                                    Masuk
                                </button>
                            </div>
                        </form>
                    </div>

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
    <script type="text/javascript">
        function change() {

            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password_pengguna').type;

            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {

                //ubah form input password menjadi text
                document.getElementById('password_pengguna').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('lihat_pass').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                        </svg>`;
            } else {

                //ubah form input password menjadi text
                document.getElementById('password_pengguna').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('lihat_pass').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>`;
            }
        }
        $(document).ready(function() {
            $('#showPass').on('click', function() {
                var passInput = $("#password_pengguna");
                if (passInput.attr('type') === 'password') {
                    passInput.attr('type', 'text');
                } else {
                    passInput.attr('type', 'password');
                }
            })
            @if(session('success'))
            swal("Success", "{{Session::get('success')}}", "success");
            @endif
            @if($errors->has('g-recaptcha-response'))
            swal("Error", "Captcha Tidak Valid!", "error");
            @endif
            @if(session('error'))
            swal("Error", "{{Session::get('error')}}", "error");
            @endif
            @if($errors->has('email'))
            swal("Error", "Email / Password Tidak Valid!", "error");
            @endif
            @if($errors->has('password'))
            swal("Error", "Email / Password Tidak Valid!", "error");
            @endif
        });
    </script>
    <script type="text/javascript">
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
            });
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script type="text/javascript">
        var verifyCallback = function(response) {
            alert(response);
        }
        var widget_pengguna;
        var onloadCallback = function() {
            widget_pengguna = grecaptcha.render('captcha-pengguna', {
                'sitekey': "{{config('captcha.site_key_recaptcha')}}",
                'theme': 'light'
            });
        }

        function verifyCaptchaInternal(result) {

            if ($('#email_internal').val() == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Email terlebih dahulu!',
                    showConfirmButton: true,
                });
            } else if ($('#password_internal').val() == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Password terlebih dahulu!',
                    showConfirmButton: true,
                });
            } else if (result !== "") {
                $('#login-user-internal-form').submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Captcha terlebih dahulu!',
                    showConfirmButton: true,
                });
            }
        }

        function verifyCaptchaPengguna(result) {

            if ($('#email_pengguna').val() == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Email terlebih dahulu!',
                    showConfirmButton: true,
                });
            } else if ($('#password_pengguna').val() == "") {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Password terlebih dahulu!',
                    showConfirmButton: true,
                });
            } else if (result !== "") {
                $('#login-user-pengguna-form').submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Captcha terlebih dahulu!',
                    showConfirmButton: true,
                });
            }
        }
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