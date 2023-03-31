@extends('dashboard.layouts.main')


@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 col-md-8">
                    <div class="card-header pb-0">
                        <h4>Buat Judul Kuesioner</h4>
                    </div>
                    <div class="card-body px-4 pt-2 pb-2">
                        <form method="GET" action="{{ route('dashboard.redirect') }}">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value=""
                                    placeholder="Judul Kuesioner" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_soal" class="form-label">Jumlah Soal</label>
                                <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal" value=""
                                    placeholder="*max 50 soal" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi-singkat" class="form-label">Deskripsi Singkat</label>
                                <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat"
                                    placeholder="Deksripsi Singkat Kuesioner" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input id="deskripsi" type="hidden" name="deskripsi">
                                <trix-editor input="deskripsi"
                                    data-trix-placeholder="Menjelaskan tentang apa kuesioner ini"></trix-editor>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Waktu Ekspirasi</label>
                                <input type="date" class="form-control" id="waktu_ekspirasi" name="waktu_ekspirasi"
                                    value="" required>
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
