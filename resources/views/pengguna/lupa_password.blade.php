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
        <div class="container-login100" style="background-image: url('../../assets/digilab/images/bg_login.png');background-size:cover;background-repeat:no-repeat;">
            <div class="wrap-login100" style="padding:30px 55px 37px 55px!important;background:white;">
                <span class="login100-form-logo">
                    <a href="{{ route('internal.auth.login') }}">
                        <img src="{{url('assets/digilab/images/ico2.png')}}" alt="" style="max-height: 115px; max-width:115px">
                    </a>
                </span>

                <span class="login100-form-title p-b-34" style="font-size:22px;">
                    Badan Informasi<br>Geospasial
                </span>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in show active">
                        <form class="login100-form" method="POST" action="{{ route('pengguna.updatePassword') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$user->id}}">
                            <div class="wrap-input100 validate-input" data-validate="Enter Email" style="border-bottom:2px solid rgb(21 50 92)">
                                <input type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{$user->email}}" readonly style="width:100%;">
                                @if ($errors->has('email'))
                                <span class="login100-form-alert" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Password" style="border-bottom:2px solid rgb(21 50 92)">
                                <input type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="{{ __('Password') }}" required style="width:100%;">
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter Password" style="border-bottom:2px solid rgb(21 50 92)">
                                <input type="password" class="input100" name="password_confirmation" id="password-confirm" placeholder="{{ __('Confirm Password') }}" required style="width:100%;" onkeyup="CekPassword()">
                            </div>
                            <span style="color:red;display:none;" id="allert_pass">*Password tidak sesuai</span>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>
    <script type="text/javascript">
    function CekPassword() {
     var sebelumnya = $('#password').val();
     var conf = $('#password-confirm').val();
     console.log(sebelumnya+' batas '+ conf);
     if (sebelumnya != conf) {
        $('#allert_pass').show();
     } else {
        $('#allert_pass').hide();
     }
        
    }
    </script>

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

    @if(Session::has('status'))
    <script type="text/javascript">
        swal('Berhasil', '{{session("status")}}', 'success');
    </script>
    <?php
    Session::forget('status');
    ?>
    @endif
</body>

</html>