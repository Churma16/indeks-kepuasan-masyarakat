{{-- @dd(session('form_data')) --}}
@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 col-lg-10">
                    <div class="card-header pb-0">
                        <h4>{{ session('form_data.judul') }}</h4>
                    </div>
                    <div class="card-body px-4 pt-2 pb-2">
                        <div class="mb-3">
                            <label for="deskripsi-singkat" class="form-label">Deskripsi Singkat</label>
                            <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat"
                                placeholder="Deksripsi Singkat Kuesioner"
                                value="{{ session('form_data.deskripsi_singkat') }}" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <div class="card border-1 rounded-2 p-2" style="box-shadow: none"
                                >{{ session('form_data.kategori') }}

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <div class="card border-1 rounded-2 p-2" style="box-shadow: none">
                                {!! session('form_data.deskripsi') !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_soal" class="form-label">Jumlah Soal</label>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                value="{{ session('form_data.jumlah_soal') }}" placeholder="*max 50 soal" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Waktu Ekspirasi</label>
                            <input type="date" class="form-control" id="waktu_ekspirasi" name="waktu_ekspirasi"
                                value="{{ session('form_data.waktu_ekspirasi') }}" required readonly>
                        </div>
                    </div>


                    <form method="POST" action="/dashboard/questionnaires">
                        @csrf
                        <div class="card-header pb-0 border-top">
                            <h4>Buat Soal</h4>
                        </div>
                        <div class="card-body px-4 pt-2 pb-2">
                            @for ($i = 1; $i <= session('form_data.jumlah_soal'); $i++)
                                <div class="mb-3 border-top pt-2">
                                    <label for="question{{ $i }}" class="form-label">Nomor
                                        {{ $i }}</label>
                                    <input id="question{{ $i }}" type="hidden"
                                        name="question{{ $i }}">
                                    <trix-editor input="question{{ $i }}"></trix-editor>
                                </div>
                            @endfor
                        </div>
                        <div class="ps-4">
                            <button type="submit" class="btn btn-info">Unggah Kuesioner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</div>

@section('scripts')
    <script>
        $('trix-editor').attr('readonly', true);
    </script>
@endsection
