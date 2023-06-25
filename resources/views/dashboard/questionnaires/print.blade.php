<!DOCTYPE html>
<html>

<head>
    <title>Print {{ $questionnaire->judul }}</title>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
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
                <td colspan="2" >Total</td>
                @for ($i = 1; $i <= count($ikm['ikmKelas']); $i++)
                    <td>{{ $ikm['ikmKelas'][$i] ?? 0 }}</td>
                @endfor
            </tr>
        </tbody>
    </table>

    <p>Total Responden: 33</p>
</body>

</html>
