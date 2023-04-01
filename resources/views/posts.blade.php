@extends('layouts.main')



@section('container')
    <br>
    <div class="container col-md-11">

        <h1 class="">{{ $title }}</h1>

        <div class="row mt-3 mb-2">
            @if ($questionnaires->count() > 0)
                @foreach ($questionnaires as $post)
                    <div class="col-lg-3 mb-4">
                        <div class="card"
                            style="border-radius: 15px; min-height: 300px;background-color:#F8F9FA; border-color: #d1d1d1;">
                            <div class="card-body d-flex flex-column" >
                                <h5 class="card-title " style=" min-height: 10vw" >{{ $post->judul }}</h5>
                                <p class="card-text">{{ $post->deskripsi_singkat }}</p>
                                <div class="mt-auto">
                                    <small class="text-muted mb-2 d-block">Waktu ekspirasi:</small>
                                    <small class="text-muted mb-2 d-block">{{ $post->waktu_ekspirasi }}</small>
                                    <a href="/posts/{{ $post->id }}" class="btn btn-primary">Mulai</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-center fs-4">Tidak Ada Kuesioner Ditemukan</p>
            @endif

            <div class="d-flex justify-content-center">
                {{ $questionnaires->links() }}
            </div>
        </div>

    </div>
@endsection

{{-- <div class="col-lg-3 mt-3 d-flex">
    <div class="card"
        style="border-radius: 15px; background-color:#F8F9FA; border-color: #d1d1d1;min-height: 350px ">
        <div class="card-body">
            <div class="card-title">
                <h5>{{ $post->judul }}</h5>
            </div>
            <div class="card-text">
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                <small class="text-muted mt-2">Waktu Ekspirasi</small>
                <div class="mt-auto">

                    <a href="/posts" class="btn btn-primary mt-1  mt-auto">Mulai</a>
                </div>
            </div>

        </div>
    </div>
</div> --}}
