@extends('layouts.layout')
@section('css')
<!-- slick CSS -->
<link rel="stylesheet" href="{{ asset('martine/css/slick.css') }}">
<!-- style CSS -->
<link rel="stylesheet" href="{{ asset('martine/css/style.css') }}">
<!-- Login css -->
<link rel="stylesheet" href="{{ asset('martine/css/login.css') }}">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('martine/Auth/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('martine/Auth/css/main.css') }}">
<style>
    .register-area {
        background-color: #B1CACC;
        border-radius:24px;
        padding:0;
    }
    .input100 {
        padding-left: 60px;
    }

    
</style>
@stop


@section('content')
<section class="ftco-section ftco-degree-bg">
    <div class="container-fluid ftco-animate">
        <div class="row justify-content-center">
            <div class="col-md-12 register-area">
                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ asset('auth/register') }}">
                                @csrf
                                <span class="login100-form-title">
                                    註冊
                                </span>
                                <div class="wrap-input100 validate-input" data-validate = "請輸入信箱">
                                    <input class="input100" type="text" name="email" placeholder="信箱">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input" data-validate = "請輸入密碼">
                                    <input class="input100" type="password" name="password" placeholder="密碼">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input">
                                    <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password" placeholder="再次輸入密碼">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                    
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "請輸入姓名">
                                    <input class="input100" type="text" name="name" placeholder="姓名">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "請輸入手機">
                                    <input class="input100" type="text" name="phone" placeholder="聯絡電話">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "請輸入地址">
                                    <input class="input100" type="text" name="address" placeholder="聯絡地址">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="container-login100-form-btn p-t-80 p-b-40">
                                    <button class="login100-form-btn">
                                        註冊
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection


@section('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('martine/Auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('martine/Auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('martine/Auth/js/main.js') }}"></script>
<script>

</script>
@stop