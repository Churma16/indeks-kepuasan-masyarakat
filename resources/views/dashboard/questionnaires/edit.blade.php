@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 col-md-12 col-lg-12 px-lg-3">
                    <div class="card-header pb-0">
                        <h3>{{ $title }}</h3>
                    </div>
                    <form method="post" class="mb-5" action="/dashboard/questionnaires/{{ $questionnaire->link }}">
                        @method('put')
                        @csrf
                        <div class="card-body px-4 pt-2 pb-2">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Kuesioner" value="{{ old('judul', $questionnaire->judul) }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-control" id="kategori" name="kategori" onchange="toggleInput()">
                                        <option value="{{ $questionnaire->kategori }}" selected>{{ $questionnaire->kategori }}</option>
                                        <option value="text">---- Masukan Kategori Baru ----</option>
                                        @foreach ($cat as $c)
                                            <option value="{{ $c }}">{{ $c }}</option>
                                        @endforeach
                                    </select>

                                <div class="mt-1" id="textInputContainer" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori Baru">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi-singkat" class="form-label">Deskripsi Singkat</label>
                                <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat"
                                    placeholder="Deksripsi Singkat Kuesioner"
                                    value="{{ old('deskripsi-singkat', $questionnaire->deskripsi_singkat) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input id="deskripsi" type="hidden" name="deskripsi"
                                    value="{{ $questionnaire->deskripsi }}">
                                <trix-editor input="deskripsi"
                                    data-trix-placeholder="Menjelaskan tentang apa kuesioner ini">
                                </trix-editor>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Waktu Ekspirasi</label>
                                <input type="date" class="form-control" id="waktu_ekspirasi" name="waktu_ekspirasi"
                                    value="{{ $questionnaire->waktu_ekspirasi }}" required>
                            </div>
                        </div>

                        <div class="card-header pb-0 border-top">
                            <h4>Edit Pertanyaan</h4>
                        </div>
                        <div class="card-body px-4 pt-2 pb-2">
                            @foreach ($questionnaire->question as $question)
                                <div class="mb-3 border-top pt-2">
                                    <label for="" class="form-label">Nomor {{ $question->nomor }}</label>
                                    <input id="{{ $question->id }}" type="hidden" name="{{ $question->id }}"
                                        value="{{ old($question->id, $question->isi) }}">
                                    <trix-editor input="{{ $question->id }}"></trix-editor>
                                </div>
                            @endforeach
                        </div>
                        <div class="ps-4">
                            <button type="submit" class="btn btn-info">Simpan Kuesioner</button>
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
