<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Respondent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class DashboardQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::latest();
        // dd(request('kategoriSelector'));
        if(request('search')){
            $questionnaires->where('judul', 'like', '%' . request('search') . '%');
        }
        if(request('kategoriSelector')){
            $questionnaires->where('kategori', 'like', '%' . request('kategoriSelector') . '%');
        }
        
        $questionnairesPag = $questionnaires->paginate(10)->withQueryString();
        $cat = Questionnaire::distinct()->orderBy('kategori')->pluck('kategori');

        return view('dashboard.questionnaires.index', [
            'title' => ' ',
            'questionnaires' => $questionnairesPag,
            'cat'=> $cat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.questionnaires.create-question', [
            'title' => 'Buat Pertanyaan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menginput questionnaire
        $questionnaire = Questionnaire::create([
            'judul' => session('form_data.judul'),
            'deskripsi_singkat' => session('form_data.deskripsi_singkat'),
            'deskripsi' => session('form_data.deskripsi'),
            'link' => Str::random(7),
            'kategori' => ucfirst(strtolower(session('form_data.kategori'))),
            'waktu_ekspirasi' => session('form_data.waktu_ekspirasi'),
            'status_aktif' => 'Aktif'
        ]);

        // menginput question
        $questions = [];
        for ($i = 1; $i <= session('form_data.jumlah_soal'); $i++) {
            $question = [
                'nomor' => $i,
                'isi' => $request->input('question' . $i),
            ];
            $questions[] = $question;
        }

        foreach ($questions as $q) {
            $question = new Question($q);
            $questionnaire->question()->save($question);
        }
        session()->forget('form_data');
        return redirect('dashboard/questionnaires/')->with('success', 'Kuesioner Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $totalRespondent = Respondent::where('questionnaire_id', $questionnaire->id)->count();

        $genderWanita = Respondent::where('questionnaire_id', $questionnaire->id)->where('gender', 'wanita')->count();
        $genderPria = Respondent::where('questionnaire_id', $questionnaire->id)->where('gender', 'pria')->count();
        $lastEdit = Carbon::parse($questionnaire->update_at)->isoFormat('DD MMM YYYY');


        // Get All the Respondent's Age
        $umur = [];
        $umur['umurKelas'] = Respondent::where('questionnaire_id', $questionnaire->id)->selectRaw('umur, count(*) as count')
            ->groupBy('umur')
            ->pluck('count', 'umur')
            ->toArray();


        // Get All the Respondent's IKM
        $idSoal = $questionnaire->question->pluck('id')->toArray();
        $ikm = [];
        $ikm['ikmKelas'] = Answer::whereIn('question_id', $idSoal)
            ->selectRaw('jawaban, count(*) as count')
            ->groupBy('jawaban')
            ->pluck('count', 'jawaban')
            ->toArray();


        //get the date of the last 14 day
        $date = [];
        for ($i = 0; $i < 14; $i++) {
            $date[] = date('d/m', strtotime('-' . $i . ' days'));
        }
        $date = array_reverse($date);


        //get the respondent for the last 14 day
        $respondentCount = [];
        for ($i = 0; $i < 14; $i++) {
            $respondentCount[] = Respondent::where('questionnaire_id', $questionnaire->id)
                ->whereDate('created_at', date('Y-m-d', strtotime('-' . $i . ' days')))
                ->count();
        }
        $respondentCount = array_reverse($respondentCount);


        //Persen Pemilih
        $ansCountAll = [];
        for ($i = 1; $i < 6; $i++) {
            $ansCountAll[$i] = Respondent::where('questionnaire_id', $questionnaire->id)->where('umur', $i)->count();
        }


        $highestAgeCount = max($ansCountAll);
        $highestAgeArray = array_keys($ansCountAll, $highestAgeCount);
        $highestAgeArray = reset($highestAgeArray);

        $umurMapping = [
            1 => '18-24',
            2 => '25-34',
            3 => '35-44',
            4 => '45-54',
            5 => '55-64',
            6 => '65++'
        ];

        //menampilkan literal tertinggi
        if ($totalRespondent == 0) {
            $literalHighestAge = "-";
        } else {
            $literalHighestAge = $umurMapping[$highestAgeArray] ?? null;
        }

        $ansCount = Respondent::where('questionnaire_id', $questionnaire->id)->where('umur', $highestAgeArray)->count();
        if ($ansCount == 0) {
            $percentCount = 0;
        } else {
            $percentCount = number_format(($ansCount / $totalRespondent) * 100, 2);
        }


        //Jawaban Tertinggi
        // $respondentsIds = [];
        // $respondentsIds = Respondent::where('questionnaire_id', $questionnaire->id)
        //     ->where('umur', $highestAgeArray)
        //     ->pluck('id')
        //     ->toArray();

        // $mapping = [
        //     1 => -1,
        //     2 => -0.5,
        //     3 => 0,
        //     4 => 0.5,
        //     5 => 1
        // ];

        // $jumlahPertanyaan = $questionnaire->getJumlahPertanyaanAttribute();
        // $jwbindvi = [];
        // foreach ($respondentsIds as $k) {
        //     $jwbindvi[] = Answer::where('respondent_id', $k)
        //         ->pluck('jawaban')
        //         ->map(function ($value) use ($mapping) {
        //             return $mapping[$value] ?? $value;
        //         })
        //         ->toArray();

        //     $fullArray = $jwbindvi;
        //     // Transform each subarray by dividing the sum by $jumlahPertanyaan
        //     foreach ($fullArray as &$subArray) {
        //         $subArray = array_sum($subArray) / $jumlahPertanyaan;
        //         unset($subArray);
        //     }
        // }

        // $avgScore= array_sum($fullArray) / count($fullArray);

        //Mengambil Nilai Bobot Hasil Keppuasan pada Respondent Kategori Terbanyak
        // Mengambil ID responden dari database berdasarkan kuesioner dan umur
        $respondentIds = Respondent::where('questionnaire_id', $questionnaire->id)
            ->where('umur', $highestAgeArray)
            ->pluck('id')
            ->toArray();

        // Pemetaan nilai jawaban ke bobot yang sesuai
        $answerMapping = [
            1 => -1,
            2 => -0.5,
            3 => 0,
            4 => 0.5,
            5 => 1
        ];

        // Mengambil jawaban dari database dan melakukan transformasi menggunakan pemetaan bobot
        $transformedAnswers = Answer::whereIn('respondent_id', $respondentIds)
            ->pluck('jawaban')
            ->map(function ($value) use ($answerMapping) {
                return $answerMapping[$value] ?? $value;
            });

        // Menghitung nilai rata-rata dari jawaban yang telah diubah
        $averageScore = $transformedAnswers->average();

        // Mencari Kemanakah nilai tersebut lebih dekat
        $scoreMapping = [
            [-1, "Sangat Tidak Puas"],
            [-0.5, "Tidak Puas"],
            [0, "Cukup Puas"],
            [0.5, "Puas"],
            [1, "Sangat Puas"],
        ];

        usort($scoreMapping, function ($a, $b) use ($averageScore) {
            return abs($a[0] - $averageScore) <=> abs($b[0] - $averageScore);
        });

        if ($totalRespondent == 0) {
            $score = "-";
        } else {
            $score = $scoreMapping[0][1];
        }


        //
        $questions = $questionnaire->question()->orderBy('nomor')->get();

        // Sisa hari
        $ekspirasi = Carbon::parse($questionnaire->waktu_ekspirasi_baru);
        $endDate = Carbon::now();
    
        $daysDifference = $ekspirasi->diffInDays($endDate);

        return view('dashboard.questionnaires.show', [
            'title' => 'Detail Kuesioner',
            'questionnaire' => $questionnaire,
            'questions' => $questions,
            "genderWanita" => $genderWanita,
            "genderPria" => $genderPria,
            // access with $umur['umurKelas'][array_key]
            'umur' => $umur,
            'ikm' => $ikm,
            'date' => $date,
            'respondentCount' => $respondentCount,
            "totalRespondent" => $totalRespondent,
            'percentCount' => $percentCount . '%',
            'averageScore' => $averageScore,
            'literalHighestAge' => $literalHighestAge,
            'score' => $score,
            'pengisiTerbanyak' => $highestAgeCount,
            'lastEdit' => $lastEdit,
            'daysDifference' => $daysDifference,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        // kode dibawah ini untuk mengurutkan nomor soal secara ascending 
        // dengan cara mengambil data dari relasi question pada model Questionnaire
        // load() adalah method dari laravel untuk eager loading yang berfungsi untuk mengambil data dari relasi
        $questionnaire->load(['question' => function ($query) {
            $query->orderBy('nomor', 'asc');
        }]);

        $cat = Questionnaire::distinct()->orderBy('kategori')->pluck('kategori');

        return view('dashboard.questionnaires.edit', [
            'title' => 'Edit Kuesioner',
            'questionnaire' => $questionnaire,
            'cat' => $cat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        // dd(request()->all());
        // Validate the form data
        $validatedData = $request->validate([
            'judul' => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi' => 'required',
            'waktu_ekspirasi' => 'required',
            'kategoriSelect' => 'required',
        ], [
            'deskripsi.after' => 'Tanggal yang dimasukkan harus setelah hari ini.',
        ]);
        $currentDate = Carbon::now()->format('Y-m-d');
        $ekspirasi = $validatedData['waktu_ekspirasi'];
    
        if ( $ekspirasi < $currentDate) {
            $validatedData['status_aktif'] = 'Tidak Aktif';
        } else {
            $validatedData['status_aktif'] = 'Aktif';
        }

        // Update the questionnaire with the validated data
        $questionnaire->update([
            'judul' => $validatedData['judul'],
            'deskripsi_singkat' => $validatedData['deskripsi_singkat'],
            'deskripsi' => $validatedData['deskripsi'],
            'waktu_ekspirasi' => $validatedData['waktu_ekspirasi'],
            'kategori' => $validatedData['kategoriSelect'],
            'status_aktif' => $validatedData['status_aktif'],

        ]);

        $questionData = [];

        foreach ($questionnaire->question as $question) {
            $questionId = $question->id;
            $isi = $request->input($questionId);

            $questionData[$questionId] = $isi;
        }

        $validator = Validator::make($questionData, [
            'required' => Rule::in(['required']),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        foreach ($questionnaire->question as $question) {
            $questionId = $question->id;
            $isi = $questionData[$questionId];

            $question->update([
                'isi' => $isi,
            ]);
        }

        return redirect('/dashboard/questionnaires/' . $questionnaire->link)->with('success', 'Post Berhasil Diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        Questionnaire::destroy($questionnaire->id);
        Question::destroy($questionnaire->question);

        return redirect('/dashboard/questionnaires')->with('success', 'Kuesioner Berhasil Dihapus!');
    }
}
