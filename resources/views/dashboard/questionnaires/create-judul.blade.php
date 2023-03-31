@extends('dashboard.layouts.main')


@section('main')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Buat Judul Kuesioner</h4>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <form method="GET" action="{{ route('dashboard.redirect') }}">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="" required
                                autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Waktu Ekspirasi</label>
                            <input type="date" class="form-control" id="deskripsi" name="deskripsi" value="" required
                                autofocus>
                        </div>
                        <button type="submit" class="btn btn-info">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</div>

@section('scripts')
@endsection