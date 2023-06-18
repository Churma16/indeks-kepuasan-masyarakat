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
            <div class="col-5">
                @if (session()->has('success'))
                    <div id="alertSuccess" class="alert alert-success alert-dismissible" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0">
                        <h4>Daftar Kuesioner</h4>
                        <div class="col-lg-2">
                            <a href="/dashboard/create-judul"><button type="button" class="btn btn-info"><i
                                        class="ni ni-fat-add"></i> Buat Kuesioner</button></a>
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
                                    @foreach ($questionnaires as $questionnaire)
                                        <tr>
                                            <td>
                                                <div class="d-flex ps-3 py-1">
                                                    {{-- <div>
                                                        <img src="/assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $loop->iteration }}
                                                        </h6>
                                                        {{-- <p class="text-xs text-secondary mb-0">
                                                            john@creative-tim.com
                                                        </p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex ps-3 py-1">
                                                    {{-- <div>
                                                        <img src="/assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $questionnaire->judul }}
                                                        </h6>
                                                        {{-- <p class="text-xs text-secondary mb-0">
                                                            john@creative-tim.com
                                                        </p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 ">
                                                    {{ $questionnaire->kategori }}
                                                </p>
                                                {{-- <p class="text-xs text-secondary mb-0">
                                                    Organization
                                                </p> --}}
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $questionnaire->jumlah_responden }}
                                                </p>
                                                {{-- <p class="text-xs text-secondary mb-0">
                                                    Organization
                                                </p> --}}
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $questionnaire->jumlah_pertanyaan }}
                                                </p>
                                                {{-- <p class="text-xs text-secondary mb-0">
                                                    Organization
                                                </p> --}}
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
                                                <a href="/dashboard/print/{{ $questionnaire->link }}"
                                                    class="badge bg-dark"><i class="bi bi-printer"></i>
                                                </a>
                                                <a href="/dashboard/questionnaires/{{ $questionnaire->link }}/edit"
                                                    class="badge bg-warning"><i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="/dashboard/questionnaires/{{ $questionnaire->link }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Are You Sure?')"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
@endsection
