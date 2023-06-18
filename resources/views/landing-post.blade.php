@extends('layouts.main')

@section('style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=your_site_key"></script>

    {{-- this script bellow is for the newest jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- this script bellow is for bootstrap ajax --}}
    <style src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"></style>
@endsection

@section('content')
    <div class="wrapper">
        <br>
        <div class="section section-basic mt-5" id="basic-elements">
            <div class="container">
                <h3 class="title">Detail Kuesioner</h3>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="container">
                            <div class="alert-icon">
                                <i class="now-ui-icons ui-2_like"></i>
                            </div>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title"><b>{{ $questionnaire->judul }}</b></h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-9">
                                <p class="card-text" style="text-align: justify; font-size: 1em; font-weight">{!! $questionnaire->deskripsi !!}</p>
                                <div>
                                    <i class="bi bi-card-list"></i> Banyak Pertanyaan:
                                    {{ $questionnaire->jumlah_pertanyaan }} Soal
                                </div>
                                <div class="fw-bold mt-1">
                                    <i class="bi bi-calendar2-week"></i> Waktu Ekspirasi:
                                    {{ $questionnaire->waktu_ekspirasi }}
                                </div>
                                <form class="mt-2" action="/check-captcha/{{ $questionnaire->link }}" method="POST">
                                    @csrf
                                    <div class="captcha">
                                        <span>{!! captcha_img('math') !!}</span>
                                        {{-- <button type="button" class="btn btn-danger reload"
                                            id="reload">&#x21bb;</button> --}}
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group my-2 col-6 justify-content-center">
                                            <input type="text" class="form-control" placeholder="Masukan Captcha"
                                                name="captcha">
                                        </div>

                                    </div>
                                    <div>
                                        @error('captcha')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
                                        <a href="/posts"><button type="button" class="btn btn-warning px-4 gap-3">
                                                Kembali </button></a>
                                        <button type="submit" class="btn btn-info px-4 gap-3">Mulai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: '/reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                },
                error: function() {
                    alert('An error occurred while reloading the captcha.');
                }
            });
        })
    </script>
@endsection
