{{-- @dd($umur) --}}
<!DOCTYPE html>
<html>
<!-- bootstrap CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<head>
    <title>Print {{ $questionnaire->judul }}</title>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 10px;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0 10px;
        }

        p {
            margin: 0 0 10px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin-bottom: 30px;
            page-break-inside: avoid;
            overflow-x: auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <style>
        @media print {
            .col-md-6 {
                width: 50%;
                float: left;
            }
        }
    </style>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col text-center mx-auto">
            <h1>Rekap Kuesioner</h1>
            <hr>
        </div>
    </div>

    <h1>{{ $questionnaire->judul }}</h1>
    <p>{!! $questionnaire->deskripsi !!}</p>
    <div class="row">
        <div class="col">
            <h6>
                <strong>Detail Jawaban Kuesioner</strong>
            </h6>
            <ul>
                <li>
                    <p>Tanggal Pembuatan: {{ $questionnaire->waktu_ekspirasi_baru }}</p>
                </li>
                <li>
                    <p>Tanggal Ekspirasi: {{ $questionnaire->waktu_pembuatan_new }}</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h6>
                <strong>Detail Jenis Kelamin responden</strong>
            </h6>
            <ul>
                <li>
                    <p>Pria: {{ $genderPria }}</p>
                </li>
                <li>
                    <p>Wanita: {{ $genderWanita }}</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h6><strong>Detail Jenis Kelamin responden</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        @for ($i = 1; $i <= 3; $i++)
                            <li>
                                <p>Umur {{ $kelasUmur[$i] }}: {{ $umur['umurKelas'][$i] ?? 0 }}</p>
                            </li>
                        @endfor
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        @for ($i = 4; $i <= 6; $i++)
                            <li>
                                <p>Umur {{ $kelasUmur[$i] }}: {{ $umur['umurKelas'][$i] ?? 0 }}</p>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div>

        <h2>Detail Jawaban Kuesioner</h2>
        <table class="mx-auto">
            <thead>
                <tr>
                    <th style="width: 15px" rowspan="2">No</th>
                    <th rowspan="2">Pertanyaan</th>
                    <th colspan="5" style="text-align: center">Jawaban</th>
                    <th rowspan="2" style="width:15%">Jawaban Terbanyak</th>
                </tr>
                <tr>
                    <th style="width:10%">Sangat Tidak Puas</th>
                    <th style="width:10%">Tidak Puas</th>
                    <th style="width:10%">Cukup Puas</th>
                    <th style="width:10%">Puas</th>
                    <th style="width:10%">Sangat Puas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questionnaire->question as $q)
                    <tr>
                        <td>{{ $q->nomor }}</td>
                        <td>{!! $q->isi !!}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            <td>{{ $answerCount[$q->id][$i] }}</td>
                        @endfor
                        <td>
                            @foreach ($answerCount[$q->id][6] as $equalAnswer)
                                @if ($equalAnswer == 1)
                                    Sangat Tidak Puas
                                @elseif ($equalAnswer == 2)
                                    Tidak Puas
                                @elseif ($equalAnswer == 3)
                                    Cukup Puas
                                @elseif ($equalAnswer == 4)
                                    Puas
                                @elseif ($equalAnswer == 5)
                                    Sangat Puas
                                @endif
                                @if (!$loop->last)
                                    dan
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach


                <tr style="font-weight: bold">
                    <td colspan="2">Total</td>
                    @for ($i = 1; $i <= count($ikm['ikmKelas']); $i++)
                        <td>{{ $ikm['ikmKelas'][$i] ?? 0 }}</td>
                    @endfor
                    <td style="background-color: black">-</td>
                </tr>
            </tbody>
        </table>

        <p>Total Responden: 33</p>
    </div>
</body>

</html>
