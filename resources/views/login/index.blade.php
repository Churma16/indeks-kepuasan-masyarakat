@extends('layouts.main-login')

@section('style')
    {{-- include main css --}}
    <link rel="stylesheet" type="text/css" href="css/login/util.css">
    <link rel="stylesheet" type="text/css" href="css/login/main.css">
@endsection


@section('login-content')
    <div class="limiter">

        <br>
        <div class="container-login100" style="background-image: url('img/bg-01.jpg');">

            <div class="row justify-content-center">
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show col-6 d-block" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="wrap-login100">


                    <span class="login100-form-logo">
                        {{-- <i class="zmdi zmdi-landscape"></i> --}}
                        <img class="" src='/img/logo-diskom-sm.png' style="max-width: 50% ">
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Admin Login
                    </span>
                    <form class="login100-form validate-form" action="/login" method="POST">
                        @csrf
                        <div class="wrap-input100 validate-input @error('email') is-invalid @enderror"
                            data-validate="Enter Email">
                            <input class="input100" type="email" name="email" id="email"
                                placeholder="JohnDoe@gmail.com" value="{{ old('email') }}" autofocus required>
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="password" id="password" placeholder="Password"
                                required>
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">
                                Login
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    {{-- script for jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- script for animsition --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>

    {{-- script for popper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    {{-- script for bootstrap --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- script for select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    {{-- script for moment --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    {{-- script for daterangepicker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>

    {{-- script for countdowntime --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countdowntime/2.6.0/countdowntime.min.js"></script>

    {{-- script for main --}}
    <script src="js/login/main.js"></script>
@endsection
