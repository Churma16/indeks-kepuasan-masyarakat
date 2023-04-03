@extends('layouts.main')
@stack('scripts')

@section('style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=your_site_key"></script>

    {{-- this script bellow is for the newest jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- this script bellow is for bootstrap ajax --}}
    <style src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"></style>
@endsection

@section('container')
    <br>
    <div class="container col-md-11">
        <h1 class="">{{ $title }}</h1>
    </div>
    <div class="container col-md-11 justify-content-center d-flex">

        <div class="px-4 py-5 my-5 text-center border col-lg-10"
            style="border-radius: 15px;background-color:#F8F9FA; border-color: #d1d1d1;">
            {{-- <img class="d-block mx-auto mb-4" src="/assets/brand/bootstrap-logo.svg" alt="" width="72"
            height="57" /> --}}

            <h3 class="fw-bold">{{ $questionnaire->judul }}</h3>
            <div class="col-lg-8 mx-auto">
                <p class=" mb-4">
                    {!! $questionnaire->deskripsi !!}
                </p>
                <p class="mb-4">
                    <i class="bi bi-calendar2-week"></i> Banyak Pertanyaan: {{ $questionnaire->jumlah_pertanyaan }}
                </p>
                <p class="mb-4">
                    <i class="bi bi-calendar2-week"></i> Waktu Ekspirasi: {{ $questionnaire->waktu_ekspirasi }}
                </p>

                <form action="/check-captcha" method="POST">
                    @csrf
                    <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-danger reload" id="reload">&#x21bb;</button>
                    </div>
                    <div class="row justify-content-center">

                        <div class="form-group my-2 col-4 justify-content-center">
                            <input type="text" class="form-control" placeholder="masukan Captcha" name="captcha">
                        </div>
                        @error('captcha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
                        <button type="button" class="btn btn-warning btn-sm px-4 gap-3">
                            Kembali </button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 gap-3">Mulai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
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

    <script>
        $(document).ready(function() {
            // Add click event handler for reload button
            $('#reload').click(function() {
                // Send AJAX request to reload-captcha route
                $.ajax({
                    type: 'GET',
                    url: '/reload-captcha',
                    success: function(data) {
                        // Replace captcha image with new image
                        $(".captcha span").html(data.captcha);
                    },
                    error: function() {
                        alert('An error occurred while reloading the captcha.');
                    }
                });
            });
        });

        {{-- this script gonna give a new captcha when it click --}}
    @endsection
