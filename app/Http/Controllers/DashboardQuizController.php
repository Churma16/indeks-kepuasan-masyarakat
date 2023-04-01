<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class DashboardQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaire = Questionnaire::all();
        return view('dashboard.questionnaires.index', [
            'title' => 'List Kuesioner',
            'questionnaires' => $questionnaire,
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
            'title' => 'Buat Kuesioner',
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

        $questionnaire = Questionnaire::create([
            'judul' => session('form_data.judul'),
            'deskripsi_singkat' => session('form_data.deskripsi_singkat'),
            'deskripsi' => session('form_data.deskripsi'),
            'kategori' => 'kosong',
            'waktu_ekspirasi' => session('form_data.waktu_ekspirasi'),
            'status_aktif' => 'Aktif'
        ]);

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
        return redirect('dashboard/questionnaires')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $questions = $questionnaire->question()->orderBy('nomor')->get();
        return view('dashboard.questionnaires.show', [
            'title' => 'Detail Kuesioner',
            'questionnaire' => $questionnaire,
            'questions' => $questions,
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

        return view('dashboard.questionnaires.edit', [
            'title' => 'Edit Kuesioner',
            'questionnaire' => $questionnaire,
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
        $questionnaire->update([
            'judul' => $request->input('judul'),
            'deskripsi_singkat' => $request->input('deskripsi_singkat'),
            'deskripsi' => $request->input('deskripsi'),
            'waktu_ekspirasi' => $request->input('waktu_ekspirasi'),
        ]);
    
        foreach ($questionnaire->question as $question) {
            $questionId = $question->id;
            $isi = $request->input($questionId);
            $question->update([
                'isi' => $isi,
            ]);
        }
    
        return redirect('dashboard/questionnaires')->with('success', 'Post has been updated!');
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

        return redirect('/dashboard/questionnaires')->with('success', 'Kuesioner berhasil dihapus!');
    }
}
