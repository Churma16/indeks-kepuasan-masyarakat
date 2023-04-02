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
                <h3 class="title">Halaman Kuesioner</h3>
                <div class="card justify-content-start px-5">
                    <div class="card-body">
                        <h4 class="card-title"><b>{{ $questionnaire->judul }}</b></h4>
                        <div class="row mb-2">
                            <div class="col-lg-9 text-left">
                                {!! $questionnaire->deskripsi !!}
                            </div>
                        </div>

                        <div class="card-text mb-5">
                            <b>Petunjuk Pengisian Kuesioner:</b> <br>
                            1 = Sangat Tidak Puas, 2 = Tidak Puas, 3 = Cukup Puas, 4 = Puas, 5 = Sangat Puas
                        </div>

                        <h4 class="card-title"><b>Kuesioner</b></h4>
                        <form class="border-top" method="POST" action="/start/store/{{ $questionnaire->link }}">
                            @foreach ($questionnaire->question as $question)
                                
                                <div class="card py-3">
                                    <div class="col-lg-9">
                                        <div class="card-title">
                                            <b>Nomor {{ $question->nomor }}</b>
                                            {!! $question->isi !!}
                                        </div>

                                        <div>
                                            <label for="slider">Tingkat Kepuasan:</label>
                                            <br>
                                            <input type="range" id="slider" name="jawaban{{ $loop->iteration }}" min="1"
                                                max="5" step="1" list="labels">
                                            <datalist id="labels">
                                                <option value="1">Sangat Tidak Puas</option>
                                                <option value="2">Tidak Puas</option>
                                                <option value="3">Cukup Puas</option>
                                                <option value="4">Puas</option>
                                                <option value="5">Sangat Puas</option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-info">Selesai</button>
                        </form>
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
