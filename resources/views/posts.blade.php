@extends('layouts.main')

@section('content')
    <div class="wrapper">
        <br>
        <div class="section section-basic mt-5" id="basic-elements">
            <div class="container">
                <h3 class="title">Daftar Kuesioner</h3>
                <div class="row justify-content-center mb-3">
                    <div class="col-md-6">
                        <form action="/posts" id="search">
                            <div class="input-group">
                                <input type="text" value="{{ request('search') }}" class="form-control" name="search"
                                    placeholder="Cari Kuesioner...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <a href="#" onclick="document.getElementById('search').submit()">
                                            <i class="now-ui-icons ui-1_zoom-bold"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @if ($questionnaires->count() > 0)
                        @foreach ($questionnaires as $post)
                            <div class="col-lg-4 col-md-6">
                                <div class="card" style="height: 17rem;">
                                    <div class="card-body">
                                        <h4 class="card-title" style="font-weight:bold;margin-top:2%">{{ $post->judul }}
                                        </h4>
                                        <h6 class="card-text" style="position:absolute; top:0; margin-top: 150px;">
                                            {{ $post->deskripsi_singkat }}</h6>
                                        <small style="position:absolute; bottom:0; margin-bottom: 70px;">Waktu Ekspirasi:
                                            {{ $post->waktu_ekspirasi_baru }}</small>
                                    </div>
                                    <div class="card-footer" style="position: absolute; bottom: 0;">
                                        <a href="/posts/{{ $post->link }}" class="btn btn-info"
                                            style="margin-left: 20px; margin-bottom: 20px;">Pilih Kuesioner</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center fs-4 mt-4 ">Tidak Ada Kuesioner Ditemukan</h3>
                    @endif

                </div>
                <div class="d-flex justify-content-center">
                    {{ $questionnaires->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
