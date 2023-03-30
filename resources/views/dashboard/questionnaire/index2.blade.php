@extends('dashboard.layouts.main')


@section('main')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Daftar Kuesioner</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Judul
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah Pertanyaan
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Waktu Ekspirasi
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Aksi
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questionnaires as $questionnaire)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                            alt="user1" />
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $questionnaire->judul }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            john@creative-tim.com
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
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
                                                    <span class="badge badge-sm bg-gradient-secondary">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $questionnaire->waktu_ekspirasi_baru }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="/dashboard/questionnaires/{{ $questionnaire->id }}" class="badge bg-info"><i
                                                        class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="/dashboard/posts//edit" class="badge bg-warning"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="/dashboard/posts//edit" class="badge bg-danger"><i class="bi bi-trash"></i>
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Projects table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Budget
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Completion
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-spotify.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Spotify
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $2,500
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">working</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                            style="
                                                            width: 60%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-invision.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="invision" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Invision
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $5,000
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">done</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="
                                                            width: 100%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-jira.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="jira" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Jira
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $3,400
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">canceled</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">30%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"
                                                            style="
                                                            width: 30%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-slack.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="slack" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Slack
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $1,000
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">canceled</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">0%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"
                                                            style="
                                                            width: 0%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-webdev.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="webdev" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Webdev
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $14,000
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">working</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">80%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="80"
                                                            style="
                                                            width: 80%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-xd.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="xd" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">
                                                        Adobe XD
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                $2,300
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">done</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="
                                                            width: 100%;
                                                        ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
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
