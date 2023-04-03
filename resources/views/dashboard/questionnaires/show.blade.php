{{-- @dd($ikm['ikmKelas']) --}}
@extends('dashboard.layouts.main')

@section('main')
    <div class="container-fluid py-4">
        <h3 class="">Detail Kuesioner</h3>
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                        Tanggal Pembuatan
                                    </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $questionnaire->waktu_pembuatan_new }}
                                        {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-folder-17 text-lg opacity-10" data-feather="files"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                        Tanggal Kadaluarsa
                                    </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $questionnaire->waktu_ekspirasi_baru }}
                                        {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                        Jumlah Soal
                                    </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $questionnaire->jumlah_pertanyaan }}
                                        {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-time-alarm text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                        Total Responden
                                    </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalRespondent }}
                                        {{-- <span class="text-success text-sm font-weight-bolder">+5%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
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
                            <a href="/dashboard/print/{{ $questionnaire->link }}"><button type="button" class="btn btn-dark"><i class="bi bi-printer"></i> Cetak Kuesioner</button></a>
                        </div>

                        <h4>{{ $questionnaire->judul }}</h4>
                        <div class="p2-3">
                            <p class="text-gray text-sm">{!! $questionnaire->deskripsi !!}</p>
                        </div>
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
                                                        <h6 class="mb-0 text-sm fw-normal ">
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
        <div class="row mt-4 justify-content-center">
            <div class="col-md-3 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <h5 class="font-weight-bolder">
                                Jenis Kelamin Responden
                            </h5>
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">
                                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                                        <div class="card-body ">
                                            <div class="chart">
                                                <canvas id="pie-chart-gender" class="chart-canvas" height="200px"></canvas>
                                            </div>
                                            <div>
                                                <div class="pb-1"
                                                    style="background-color: #17c1e8; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>Pria</small>
                                            </div>
                                            <div>
                                                <div
                                                    style="background-color: #cb0c9f; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>Wanita</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            {{-- <div class="col-lg-2 ms-auto text-center mt-5 mt-lg-0">
                                <div class="border-radius-lg h-100">
                                    <div>
                                        <div
                                            style="background-color: #ff0000; width: 20px; height: 20px; display: inline-block;">
                                        </div>
                                        <span>Series 1</span>
                                    </div>
                                    <div>
                                        <div
                                            style="background-color: #00ff00; width: 20px; height: 20px; display: inline-block;">
                                        </div>
                                        <span>Series 2</span>
                                    </div>

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-lg-0 mb-4">
                <div class="card" style="">
                    <div class="card-body p-3 " style="box-shadow:none">
                        <div class="row">
                            <h5 class="font-weight-bolder">
                                Umur Responden
                            </h5>
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100 ">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="chart col-sm-12">
                                                <canvas id="pie-chart-age" class="chart-canvas" height="200px"></canvas>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="pb-1"
                                                    style="background-color: #003f5c; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>18-24</small>
                                                <br>
                                                <div
                                                    style="background-color: #444e86; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>25-34</small>
                                                <br>
                                                <div
                                                    style="background-color: #945095; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>35-44</small>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="pb-1"
                                                    style="background-color: #dd5182; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>45-54</small>
                                                <br>
                                                <div
                                                    style="background-color: #ff6e54; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>55-64</small>
                                                <br>
                                                <div
                                                    style="background-color: #ffa600; width: 10px; height: 10px; display: inline-block;">
                                                </div>
                                                <small>65+</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <div class="col-lg-2 ms-auto text-center mt-5 mt-lg-0">
                                <div class="border-radius-lg h-100">
                                    <div>
                                        <div
                                            style="background-color: #ff0000; width: 20px; height: 20px; display: inline-block;">
                                        </div>
                                        <span>Series 1</span>
                                    </div>
                                    <div>
                                        <div
                                            style="background-color: #00ff00; width: 20px; height: 20px; display: inline-block;">
                                        </div>
                                        <span>Series 2</span>
                                    </div>

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100 p-3">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="">

                        <h5 style="font-weight: bolder" class="ps-2"> Indeks Kepuasan Masyarakat</h5>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="bar-chart-ikm" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h5 style="font-weight: bolder">Banyak Responden 14 Hari Terakhir</h5>
                            {{-- <p class="text-sm">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span>
                                in 2021
                            </p> --}}
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            @endsection
    </div>


    @section('scripts')
        <!--   Core JS Files   -->
        <script src="/assets/js/core/popper.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="/assets/js/plugins/chartjs.min.js"></script>
        <script>
            //Line Chart Banyak Responden
            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
            gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
            gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors


            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: [
                        @for ($i = 0; $i < count($date); $i++)
                            "{{ $date[$i] }}",
                        @endfor

                    ],
                    datasets: [{
                            label: "Banyak Responden",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [
                                @for ($i = 0; $i < 14; $i++)
                                    "{{ $respondentCount[$i] }}",
                                @endfor
                            ],
                            maxBarThickness: 6,
                        },
                        // {
                        //     label: "Websites",
                        //     tension: 0.4,
                        //     borderWidth: 0,
                        //     pointRadius: 0,
                        //     borderColor: "#3A416F",
                        //     borderWidth: 3,
                        //     backgroundColor: gradientStroke2,
                        //     fill: true,
                        //     data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                        //     maxBarThickness: 6,
                        // },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#b2b9bf",
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5],
                            },
                            ticks: {
                                display: true,
                                color: "#b2b9bf",
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                            },
                        },
                    },
                },
            });


            //pie chart
            var ctx4 = document.getElementById("pie-chart-gender").getContext("2d");

            new Chart(ctx4, {
                type: "pie",
                data: {
                    labels: ['Wanita', 'Pria'],
                    datasets: [{
                        label: "Projects",
                        weight: 9,
                        cutout: 0,
                        tension: 0.9,
                        pointRadius: 2,
                        borderWidth: 2,
                        backgroundColor: ['#cb0c9f', '#17c1e8'],
                        data: [{{ $genderWanita }}, {{ $genderPria }}],
                        fill: false
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                display: false,
                            }
                        },
                    },
                },
            });

            // pie chart age
            var ctx5 = document.getElementById("pie-chart-age").getContext("2d");

            new Chart(ctx5, {
                type: "pie",
                data: {
                    labels: ['18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                    datasets: [{
                        label: "Projects",
                        weight: 9,
                        cutout: 0,
                        tension: 0.9,
                        pointRadius: 2,
                        borderWidth: 2,
                        backgroundColor: ['#003f5c', '#444e86', '#955196', '#dd5182', '#ff6e54', '#ffa600'],
                        data: [
                            @for ($i = 1; $i <= 6; $i++)
                                '{{ $umur['umurKelas'][$i] ?? 0 }}',
                            @endfor
                        ],
                        fill: false
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                display: false,
                            }
                        },
                    },
                },
            });

            // Bar chart
            var barChart1 = document.getElementById("bar-chart-ikm").getContext("2d");

            new Chart(barChart1, {
                type: "bar",
                data: {
                    labels: ['Sangat Tidak Puas', 'Tidak Puas', 'Cukup Puas', 'Puas', 'Sangat Puas'],
                    datasets: [{
                        label: "Banyak jawaban",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: '#3A416F',
                        data: [
                            @for ($i = 1; $i <= count($ikm['ikmKelas']); $i++)
                                '{{ $ikm['ikmKelas'][$i] ?? 0 }}',
                            @endfor
                        ],
                        fill: false,
                        maxBarThickness: 35
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#9ca2b7'
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: true,
                                drawTicks: true,
                            },
                            ticks: {
                                display: true,
                                color: '#9ca2b7',
                                padding: 10
                            }
                        },
                    },
                },
            });
        </script>
    @endsection
