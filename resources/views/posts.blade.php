@extends('layouts.main')

@section('content')
    <div class="wrapper">
        <br>
        <div class="section section-basic mt-5" id="basic-elements">
            <div class="container">
                <h3 class="title">Pilih Kuesioner</h3>
                <div class="row">
                    @if ($questionnaires->count() > 0)
                        @foreach ($questionnaires as $post)
                            <div class="col-md-4">
                                <div class="card" style="width: 20rem;">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $post->judul }}</h4>
                                        <p class="card-text">{{ $post->deskripsi_singkat }}</p>
                                        <small>Waktu Ekspirasi: {{ $post->waktu_ekspirasi_baru }}</small>
                                        <br>
                                        <a href="/posts/{{ $post->link }}" class="btn btn-info">Pilih Kuesioner</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center fs-4">Tidak Ada Kuesioner Ditemukan</p>
                    @endif

                </div>
                <div class="d-flex justify-content-center">
                    {{ $questionnaires->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
