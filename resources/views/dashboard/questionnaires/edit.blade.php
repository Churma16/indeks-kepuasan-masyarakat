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
                                <select class="form-control" id="kategoriSelect" name="kategoriSelect">
                                    {{-- <option value="{{ $questionnaire->kategori }}" selected>{{ $questionnaire->kategori }} --}}
                                    </option>
                                    @foreach ($cat as $c)
                                        <option value="{{ $c }}"
                                            @if (old('kategori', $questionnaire->kategori)==$c) ? selected : @endif>{{ $c }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi-singkat" class="form-label">Deskripsi Singkat</label>
                                <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat"
                                    placeholder="Deksripsi Singkat Kuesioner"
                                    value="{{ old('deskripsi-singkat', $questionnaire->deskripsi_singkat) }}" required>
                                @error('deskripsi-singkat')
                                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input id="deskripsi" type="hidden" name="deskripsi"
                                    value="{{ $questionnaire->deskripsi }}">
                                <trix-editor input="deskripsi"
                                    data-trix-placeholder="Menjelaskan tentang apa kuesioner ini">
                                </trix-editor>
                                @error('deskripsi')
                                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Waktu Ekspirasi</label>
                                <input type="date" class="form-control" id="waktu_ekspirasi" name="waktu_ekspirasi"
                                    value="{{ $questionnaire->waktu_ekspirasi }}" required>
                                @error('waktu_ekspirasi')
                                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}</small>
                                @enderror
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
                                    <div class="text-danger validation-error" id="{{ $question->id }}_error"></div>
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

    <script>
        document.addEventListener('trix-file-accept', function(event) {
            event.preventDefault();
        });

        // document.addEventListener('submit', function(event) {
        //     var editors = document.querySelectorAll('trix-editor');
        //     for (var i = 0; i < editors.length; i++) {
        //         var editor = editors[i];
        //         var inputId = editor.getAttribute('input');
        //         var inputField = document.getElementById(inputId);

        //         if (editor.value.trim() === '') {
        //             inputField.setCustomValidity('This field is required.');
        //         } else {
        //             inputField.setCustomValidity('');
        //         }
        //     }
        // });
    </script>

    <script>
        // Add event listener to the form submit button
        document.querySelector('form').addEventListener('submit', function(event) {
            // Get all Trix editor inputs
            var trixEditors = document.querySelectorAll('trix-editor');

            // Check if any Trix editor is empty or contains only whitespace
            var hasEmptyEditor = false;
            trixEditors.forEach(function(editor) {
                // Get the original value of the Trix editor content
                var originalValue = editor.editor.getDocument().toString();

                // Get the trimmed value of the Trix editor content
                var trimmedValue = editor.editor.getDocument().toString().trim();

                // Check if the Trix editor is empty
                if (trimmedValue === '') {
                    hasEmptyEditor = true;
                    var inputId = editor.getAttribute('input');
                    var errorElement = document.getElementById(inputId + '_error');
                    errorElement.innerHTML =
                        '<i class="bi bi-exclamation-circle"></i> Field ini harus diisi.';
                }
                // Check if the Trix editor contains only whitespace
                else if (trimmedValue === originalValue) {
                    hasEmptyEditor = true;
                    var inputId = editor.getAttribute('input');
                    var errorElement = document.getElementById(inputId + '_error');
                    errorElement.innerHTML =
                        '<i class="bi bi-exclamation-circle"></i> Field ini tidak boleh hanya berisi spasi atau enter.';
                }
            });

            // Prevent form submission if any Trix editor is empty or contains only whitespace
            if (hasEmptyEditor) {
                event.preventDefault();
            }
        });
    </script>
@endsection
