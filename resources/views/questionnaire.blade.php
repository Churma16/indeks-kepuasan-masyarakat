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
                            @csrf
                            <div class="card py-3">
                                <div class="row px-3">
                                    <div class="col-lg-6">
                                        <div class="card-title">
                                            <b>Jenis Kelamin</b>
                                        </div>
                                        <div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="jeniskelamin"
                                                        id="jeniskelamin" value="Pria" required />
                                                    <span class="form-check-sign"></span>
                                                    Pria
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="jeniskelamin"
                                                        id="jeniskelamin" value="Wanita" required />
                                                    <span class="form-check-sign"></span>
                                                    Wanita
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-title">
                                            <b>Umur</b>
                                        </div>
                                        <div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="1" required />
                                                    <span class="form-check-sign"></span>
                                                    18-24 Tahun
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="2" required />
                                                    <span class="form-check-sign"></span>
                                                    25-34 Tahun
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="3" required />
                                                    <span class="form-check-sign"></span>
                                                    35-44 Tahun
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="4" required />
                                                    <span class="form-check-sign"></span>
                                                    45-54 Tahun
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="5" required />
                                                    <span class="form-check-sign"></span>
                                                    55-64 Tahun
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="umur"
                                                        id="umur" value="6" required />
                                                    <span class="form-check-sign"></span>
                                                    65 Tahun Keatas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($questionnaire->question as $question)
                                <div class="card py-3">
                                    <div class="col-lg-9">
                                        <div class="card-title">
                                            <b>Nomor {{ $question->nomor }}</b>
                                            {!! $question->isi !!}
                                        </div>

                                        <div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label"">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban{{ $question->id }}"
                                                        id="jawaban{{ $question->id }}radio5" value="5" required>
                                                    <span class="form-check-sign"></span>
                                                    Sangat Puas</label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label" for="jawaban{{ $question->id }}radio4">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban{{ $question->id }}"
                                                        id="jawaban{{ $question->id }}radio4" value="4" required>
                                                    <span class="form-check-sign"></span>Puas</label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label" for="jawaban{{ $question->id }}radio3">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban{{ $question->id }}"
                                                        id="jawaban{{ $question->id }}radio3" value="3" required>
                                                    <span class="form-check-sign"></span>Cukup Puas</label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label" for="jawaban{{ $question->id }}radio2">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban{{ $question->id }}"
                                                        id="jawaban{{ $question->id }}radio2" value="2" required>
                                                    <span class="form-check-sign"></span>Tidak Puas</label>
                                            </div>
                                            <div class="form-check form-check-radio">
                                                <label class="form-check-label" for="jawaban{{ $question->id }}radio1">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban{{ $question->id }}"
                                                        id="jawaban{{ $question->id }}radio1" value="1" required>
                                                    <span class="form-check-sign"></span>Sangat Tidak Puas</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                            <button type="submit" class="btn btn-info">Kirim Jawaban</button>
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
