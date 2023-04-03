@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="card col-lg-12 mb-4">
                    <div class="card-header pb-0">
                        <div class="">
                            <a href="/dashboard/questionnaires/{{ $questionnaire->link }}/edit"><button type="button" class="btn btn-warning"><i
                                class="bi bi-pencil-square"></i> Edit Kuesioner</button></a>
                            <form action="/dashboard/questionnaires/{{ $questionnaire->link }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger border-0" onclick="return confirm('Are You Sure?')"><i
                                        class="bi bi-trash"></i> Hapus Kuesioner</button>
                            </form>
                        </div>

                        <h4>{{ $questionnaire->judul }}</h4>
                        <p class="text-gray text-sm">{!! $questionnaire->deskripsi !!}</p>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-start mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary text-dark font-weight-bolder opacity-7"
                                            style="width:10px">
                                            No
                                        </th>
                                        <th class="text-uppercase text-primary text-dark font-weight-bolder opacity-7">
                                            Pertanyaan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
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
                                                <div class="d-flex">
                                                    {{-- <div>
                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center ps-3">
                                                        <h6 class="mb-0 text-sm fw-normal">
                                                            {!! $question->isi !!}
                                                        </h6>
                                                    </div>
                                                </div>
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
