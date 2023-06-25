@extends('login.layouts.main')

@section('content')
    <main class="main-content mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('/img/kota-lama.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <div class="mb-3">
                                    <img src="/img/logo-diskom-sm.png">
                                </div>
                                <h5>Admin Login</h5>
                            </div>
                            <div class="card-body">
                                {{-- @if (session('loginError'))
                                    <div class="alert alert-danger text-white text-center" role="alert">
                                        {{ session('loginError') }}
                                    </div>
                                @endif --}}
                                @if ($errors->has('loginError'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: '{{ $errors->first('loginError') }}',
                                            timer: 3000, // Optional timer value in milliseconds
                                            showConfirmButton: false
                                        });
                                    </script>
                                @endif
                                <form role="form text-left" action="/login" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="SuratmanMuda@gmail.com" aria-label="Email"
                                            aria-describedby="email-addon" name="email" id="email"
                                            value="{{ old('email') }}" required autofocus />
                                        @error('email')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password"
                                            aria-label="Password" aria-describedby="password-addon" name="password"
                                            id="password" required />

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
@endsection
