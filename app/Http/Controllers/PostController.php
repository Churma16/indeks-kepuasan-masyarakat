<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\Respondent;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            "title" => 'Daftar Kuesioner',
            "questionnaires" => Questionnaire::latest()->paginate(24),
        ]);
    }

    public function preview(Questionnaire $questionnaire)
    {
        return view('landing-post', [
            "title" => "Detail Kuesioner",
            "questionnaire" => $questionnaire,
        ]);
    }

    public function startQuest(Questionnaire $questionnaire)
    {
        $questionnaire->load(['question' => function ($query) {
            $query->orderBy('nomor', 'asc');
        }]);
        return view('questionnaire', [
            "questionnaire" => $questionnaire,
            "title" => "Hai"
        ]);
    }

    public function store(Questionnaire $questionnaire, Request $request)
    {
        $respondent = Respondent::create([
            'questionnaire_id' => $questionnaire->id,
            'umur' => $request->umur,
            'gender' => $request->jeniskelamin,
            'waktu_pengisian' =>Carbon::now(),
        ]);

        

        // mengambil id respondent paling tinggi untuk diinput pada jawaban
        $respondent= new Respondent();
        $respondent_id=$respondent->id_tertinggi; 
        
        // sort the array
        $questionnaire->load(['question' => function ($query) {
            $query->orderBy('nomor', 'asc');
        }]);

        //filling the answers array
        $answers = [];
        foreach($questionnaire->question as $q){
            $answer = [
                'respondent_id' => $respondent_id ,
                'question_id' => $q->id,
                'jawaban' => $request->input('jawaban' . $q->id),
            ];
            $answers[] = $answer;
        }

        // input to database answer
        foreach($answers as $a){
            Answer::create($a);
        }

        return redirect('posts/'.$questionnaire->link)->with('success', 'Terima Kasih Sudah Mengisi Kuesioner!');

    }
}
