<!DOCTYPE html>
<html>

<head>
    <title>Print {{ $questionnaire->judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
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
            width: 100%;
            margin-bottom: 30px;
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
</head>

<body>
    <h1>{{ $questionnaire->judul }}</h1>
    <p>{!! $questionnaire->deskripsi !!}r</p>
    <ul>
        <li>
            <p>Tanggal Pembuatan: {{ $questionnaire->waktu_ekspirasi_baru }}</p>
        </li>
        <li>
            <p>Tanggal Ekspirasi: {{ $questionnaire->waktu_pembuatan_new }}</p>
        </li>
    </ul>
    <h2>Rekap Kuesioner</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 15px" rowspan="2">No</th>
                <th rowspan="2">Pertanyaan</th>

                <th colspan="6" style="text-align: center">Jawaban</th>
            </tr>
            <tr>
                <th>Sangat Tidak Puas</th>
                <th>Tidak Puas</th>
                <th>Cukup Puas</th>
                <th>Puas</th>
                <th>Sangat Puas</th>
                <th>Jawaban Terbanyak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questionnaire->question as $q)
                <tr>
                    <td>{{ $q->nomor }}</td>
                    <td>{!! $q->isi !!}</td>
                    @for ($i = 1; $i < 6; $i++)
                        <td>{{ $answerCount[$q->id][$i] }}</td>
                    @endfor
                    @if ($answerCount[$q->id][6] == 1)
                        <td>Sangat Tidak Puas</td>
                    @elseif($answerCount[$q->id][6] == 2)
                        <td>Tidak Puas</td>
                    @elseif($answerCount[$q->id][6] == 3)
                        <td>Cukup Puas</td>
                    @elseif($answerCount[$q->id][6] == 4)
                        <td>Puas</td>
                    @elseif($answerCount[$q->id][6] == 5)
                        <td>Sangat Puas</td>
                    @endif

                </tr>
            @endforeach

        </tbody>
    </table>

    <p>Total Responden: 33</p>
</body>

</html>
