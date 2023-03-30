@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>{{ $questionnaire->judul }}</h5>
                        <p class="text-gray text-sm">{{ $questionnaire->deskripsi }}</p>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pertanyaan
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm ms-4">
                                                            {{ $question->nomor }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $question->isi }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="/dashboard/posts//edit" class="badge bg-warning"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="/dashboard/posts//edit" class="badge bg-danger"><i
                                                        class="bi bi-trash"></i>
                                                </a>
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
    @endsection
</div>

@section('scripts')
@endsection
