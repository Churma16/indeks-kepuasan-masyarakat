{{-- @dd($cat) --}}
@extends('dashboard.layouts.main')

@section('style')
    <style>
        #alertSuccess {
            animation: fadeOut 1s ease 4s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            {{-- <div class="col-5">
                @if (session()->has('success'))
                    <div id="alertSuccess" class="alert alert-success alert-dismissible" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
            </div> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0">
                        <h4>Daftar Kuesioner</h4>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-2 ms-4">
                            <a href="/dashboard/create-judul"><button type="button" class="btn btn-info"><i
                                        class="ni ni-fat-add"></i> Buat Kuesioner</button></a>
                        </div>
                        <div class="col-lg-4 col-md-6">

                        </div>
                        <div class="col-lg-2 col-md-2 ms-6 me-md-6 me-lg-1" style="">
                            <form action="/dashboard/questionnaires" id="kategoriSelector">
                                <select class="form-control" id="kategoriSelector" name="kategoriSelector"
                                    onchange="document.getElementById('kategoriSelector').submit();">
                                    <option value="">---- Pilih Kategori ----</option>
                                    @foreach ($cat as $c)
                                        <option value="{{ $c }}"
                                            @if (request('kategoriSelector')) ? selected : @endif>{{ $c }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3 ms-auto me-4">
                            <form action="/dashboard/questionnaires" id="search">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <a href="#" onclick="document.getElementById('search').submit()">
                                                <i class="bi bi-search bi-lg"></i>
                                            </a>
                                        </span>
                                        <input type="text" value="{{ request('search') }}" class="form-control ps-2"
                                            name="search" placeholder="Cari Kuesioner...">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7"
                                            style="width:10px">
                                            NO
                                        </th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                            Judul
                                        </th>
                                        <th
                                            class=" text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                            Kategori
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                            Banyak <br> Responden
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                            Jumlah <br> Pertanyaan
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                            Waktu <br> Ekspirasi
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                            Aksi
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="ps-5">
                                    @if ($questionnaires->count() > 0)
                                        @foreach ($questionnaires as $questionnaire)
                                            <tr>
                                                <td>
                                                    <div class="d-flex ps-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $loop->iteration }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex ps-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $questionnaire->judul }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 ">
                                                        {{ $questionnaire->kategori }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $questionnaire->jumlah_responden }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $questionnaire->jumlah_pertanyaan }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($questionnaire->status_aktif == 'Aktif')
                                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">Tidak
                                                            Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $questionnaire->waktu_ekspirasi_baru }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="/dashboard/questionnaires/{{ $questionnaire->link }}"
                                                        class="badge bg-info"><i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a href="/dashboard/questionnaires/{{ $questionnaire->link }}/edit"
                                                        class="badge bg-warning"><i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <form action="/dashboard/questionnaires/{{ $questionnaire->link }}"
                                                        method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="badge bg-danger border-0"
                                                            onclick="confirmDelete(event)">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                    <a href="/dashboard/print/{{ $questionnaire->link }}"
                                                        class="badge bg-dark"><i class="bi bi-printer"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="8">Tidak ada Kuesioner Ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center" style="color">
                                {{ $questionnaires->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    @endsection
</div>


@section('scripts')
    <script>
        setTimeout(function() {
            $('#alertSuccess').alert('close');
        }, 5000);
    </script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus Kuesioner?',
                text: "Kuesioner yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with the form submission
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: 'Success',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 3000, // Change the duration as per your needs
                showConfirmButton: false
            });
        @endif
    </script>
    {{-- <script>
        function submitForm() {
            document.getElementById("kategoriSelector").submit();
        }
    </script> --}}
@endsection
