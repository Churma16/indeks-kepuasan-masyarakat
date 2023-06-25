{{-- @dd($cat) --}}
@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 col-lg-12 px-3">
                    <div class="card-header pb-0">
                        <h4>Buat Detail Kuesioner</h4>
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
                                <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                    value="" placeholder="Masukan angka diantara 1 sampai 50" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-control" id="kategoriSelect" name="kategoriSelect"
                                    onchange="toggleInput()">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <option value="text">---- Masukan Kategori Baru ----</option>
                                    @foreach ($cat as $c)
                                        <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-1" id="textInputContainer" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="kategori" name="kategori"
                                            placeholder="Masukan Kategori Baru">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi-singkat" class="form-label">Deskripsi Singkat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-right-0 rounded rounded-left"
                                        id="deskripsi_singkat" name="deskripsi_singkat"
                                        placeholder="Deksripsi Singkat Kuesioner" value="" required>
                                    <div class="border border-left-0 rounded pt-1 px-1">
                                        <span id="charCount">0</span>/50
                                    </div>
                                </div>
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
                                @error('waktu_ekspirasi')
                                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Simpan Detail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>

@section('scripts')
    <script>
        function toggleInput() {
            var kategori = document.getElementById("kategoriSelect").value;
            var textInputContainer = document.getElementById("textInputContainer");

            if (kategori === "text") {
                textInputContainer.style.display = "block";
                document.getElementById("textInput").value = "";
            } else {
                textInputContainer.style.display = "none";
            }
        }
    </script>

    <script>
        var textInput = document.getElementById('deskripsi_singkat');
        var charCount = document.getElementById('charCount');

        textInput.addEventListener('input', function(event) {
            var inputValue = event.target.value;
            var filteredValue = inputValue.replace(/[^A-Za-z0-9 ]/g, '').slice(0, 50);
            event.target.value = filteredValue;
            charCount.textContent = filteredValue.length;
        });
    </script>

    <script>
        var textInput = document.getElementById('jumlah_soal');

        textInput.addEventListener('input', function(event) {
            var inputValue = event.target.value;
            var filteredValue = inputValue.replace(/\D/g, ''); // Remove non-digit characters
            if (filteredValue < 1 || filteredValue > 50) {
                filteredValue = ''; // Clear the input if the value is outside the range
                showErrorPopup();
            }
            event.target.value = filteredValue;
        });

        function showErrorPopup() {
            // Show your error popup implementation here
            alert('Please enter a value between 1 and 50.');
        }
    </script>
@endsection
