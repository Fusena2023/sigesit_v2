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


</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../assets/digilab/images/bg_1.jpg');">
            <div class="wrap-login100">
                    <span class="login100-form-logo">
                        <img src="{{url('assets/digilab/images/ico.png')}}" alt="" style="max-height: 115px; max-width:115px">
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Badan Informasi Geospasial
                    </span>
                    
                    <div class="container-login100-form-btn" style="border-bottom: 2px solid #ddd;padding-bottom:10px;margin-bottom:20px;">
                      <a class="login100-form-btn" id="menu1btn" data-toggle="tab" href="#menu1">Internal</a>&nbsp
                      <a class="login100-form-btn" id="homebtn" data-toggle="tab" href="#home">Pengguna</a>&nbsp
                    </div>
                    
                    <div class="tab-content">

                        <div id="menu1" class="tab-pane fade in active" style="display:none">
                            <form class="login100-form" id="login-user-internal-form" role="form" method="POST" action="{{url('logininternal') }}">
                            {{ csrf_field() }}
                            <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                <input id="email_internal" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                                @if ($errors->has('email'))
                                    <span class="login100-form-alert" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                <input id="password_internal" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required maxlength="50" placeholder="{{ __('Password') }}" autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="login100-form-alert" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            </div>
                            
                            <div class="validate-input" data-validate="Isi Captcha">
                                <center><div id="captcha-internal"></div></center>
                                @if ($errors->has('captcha'))
                                    <span class="login100-form-alert" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <div class="container-login100-form-btn">
                                <button type="button" class="login100-form-btn" onclick="verifyCaptchaInternal(grecaptcha.getResponse(widget_internal))">Masuk</button>
                            </div>
                            </form>
                        </div>

                        <div id="home" class="tab-pane fade in active" style="display:none">
                            <form class="login100-form" id="login-user-pengguna-form" method="POST" action="{{url('loginpengguna') }}">
                                @csrf
                                <div class="wrap-input100 validate-input" data-validate = "Enter username">
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

                                <div class="wrap-input100 validate-input" data-validate="Enter password">
                                    <input id="password_pengguna" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required maxlength="50" placeholder="{{ __('Password') }}" autocomplete="off">
                                    @if ($errors->has('password'))
                                        <span class="login100-form-alert" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                                </div>

                                <div class="validate-input" data-validate="Isi Captcha">
                                    <center><div id="captcha-pengguna"></div></center>
                                    @if ($errors->has('captcha'))
                                        <span class="login100-form-alert" role="alert">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <div class="container-login100-form-btn">
                                    <a class="liactive" href="{{ route('register') }}">Register</a>
                                    <button class="login100-form-btn" type="button" onclick="verifyCaptchaPengguna(grecaptcha.getResponse(widget_pengguna))">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                    </div><hr>
                    <a class="liactive" href="{{ url('/') }}">Kembali</a>
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
        $(document).ready(function(){
          $(".js-example-basic-single").select2();
          $("#homebtn").click(function(){
            $("#home").show();
            $("#menu1").hide();
            $("#menu2").hide();
            $("#homebtn").addClass("liactive").removeClass("login100-form-btn");
            $("#menu1btn").addClass("login100-form-btn").removeClass("liactive");
            $("#menu2btn").addClass("login100-form-btn").removeClass("liactive");
            $("#menu1").removeClass("active");
            $("#menu2").removeClass("active");
          });
          $("#menu1btn").click(function(){
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
        var widget_internal;
        var widget_pengguna;
        var onloadCallback = function() {
            widget_internal = grecaptcha.render('captcha-internal', {
                'sitekey': "{{config('captcha.site_key_recaptcha')}}",
                'theme': 'light'
            });
            widget_pengguna = grecaptcha.render('captcha-pengguna', {
                'sitekey': "{{config('captcha.site_key_recaptcha')}}",
                'theme': 'light'
            });
        }

        function verifyCaptchaInternal(result) {
            
            if($('#email_internal').val() == ""){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Email terlebih dahulu!',
                    showConfirmButton: true,
                });
            }else if($('#password_internal').val() == ""){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Password terlebih dahulu!',
                    showConfirmButton: true,
                });
            }else if (result !== "") {
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
            
            if($('#email_pengguna').val() == ""){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Email terlebih dahulu!',
                    showConfirmButton: true,
                });
            }else if($('#password_pengguna').val() == ""){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Password terlebih dahulu!',
                    showConfirmButton: true,
                });
            }else if (result !== "") {
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
                  swal('Berhasil','{{Session::get("success")}}','success');
              </script>
              <?php
                  Session::forget('success');
              ?>
          @endif
          @if(Session::has('error'))
              <script type="text/javascript">
                  swal('Gagal','{{Session::get("error")}}','error');
              </script>
              <?php
                  Session::forget('error');
              ?>
          @endif


</body>
</html>
