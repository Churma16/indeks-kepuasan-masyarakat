@extends('layouts.main')

@section('container')
    <br>
    <div class="container col-md-11">
        <h1 class="">{{ $title }}</h1>
    </div>
    <div class="container col-md-11 justify-content-center d-flex">
        
        <div class="px-4 py-5 my-5 text-center border col-lg-10" style="border-radius: 15px;background-color:#F8F9FA; border-color: #d1d1d1;">
            {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72"
            height="57" /> --}}

            <h3 class="fw-bold">{{ $questionnaire->judul }}</h3>
            <div class="col-lg-6 mx-auto">
                <p class=" mb-4">
                    {{ $questionnaire->deskripsi }}
                </p>
                <p class="mb-4">
                    <i class="bi bi-calendar2-week"></i> Banyak Pertanyaan: {{ $questionnaire->jumlah_pertanyaan }}
                </p>
                <p class="mb-4">
                    <i class="bi bi-calendar2-week"></i> Waktu Ekspirasi: {{ $questionnaire->waktu_ekspirasi }}
                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
                    <button type="button" class="btn btn-primary btn-sm px-4 gap-3">
                        Mulai
                    </button>
                </div>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-warning btn-sm px-4 gap-3">
                        Kembali
                </div>

            </div>
        </div>
    </div>
@endsection
