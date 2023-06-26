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
                <div class="card text-center">
                    <div class="card-body p-5">
                        <h4 class="card-title"><b>{{ $questionnaire->judul }}</b></h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-9 ">
                                <div class="card-text mb-4" id="dynamicContent"
                                    style="text-align: justify; font-size: 1em; font-weight:normal;">
                                    {!! $questionnaire->deskripsi !!}</div>
                                <div>
                                    <i class="bi bi-card-list"></i> <strong>Banyak Pertanyaan:</strong>
                                    {{ $questionnaire->jumlah_pertanyaan }} Soal
                                </div>
                                <div class="fw-bold mt-1 mb-4">
                                    <i class="bi bi-calendar2-week"></i> <strong>Waktu Ekspirasi:</strong>
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
                                        @if ($questionnaire->status_aktif == 'Aktif')
                                            <button type="submit" class="btn btn-info px-4 gap-3">Mulai</button>
                                        @else
                                            <button type="button" class="btn btn-info px-4 gap-3"
                                                onclick="kadaluarsa(event)">Mulai</button>
                                        @endif
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
    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: 'Success',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 3000, // Change the duration as per your needs
                showConfirmButton: false
            });
        @endif
    </script>
    <script>
        function kadaluarsa(event) {
            event.preventDefault();
            setTimeout(function() {
                Swal.fire({
                    title: 'Gagal',
                    text: "Kuesioner Sudah Kadaluwarsa",
                    icon: 'error',
                    showConfirmButton: false
                });
            }, 500); // Delay execution by 500 milliseconds (adjust as needed)
        }
    </script>
    <script>
        function applyStylesToDynamicContent() {
            var dynamicContentElement = document.getElementById("dynamicContent");
            if (dynamicContentElement) {
                var divElement = dynamicContentElement.querySelector("div");
                if (divElement) {
                    divElement.style.textAlign = "justify";
                    divElement.style.fontSize = "1em";
                    divElement.style.fontWeight = "normal";
                }
            }
        }


        applyStylesToDynamicContent();
    </script>
@endsection
