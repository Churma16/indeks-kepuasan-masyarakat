{{-- @dd($cat) --}}
@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 col-lg-10">
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
                                <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                    value="" placeholder="Masukan angka diantara 1 sampai 50" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-control" id="kategoriSelect" name="kategoriSelect" onchange="toggleInput()">
                                        <option value="" selected disabled>Pilih Kategori</option>
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
@endsection
