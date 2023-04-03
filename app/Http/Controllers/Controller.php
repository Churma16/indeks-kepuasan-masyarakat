<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Answer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToCreate(Request $request)
    {
        // Store the form data in a session variable
        session(['form_data' => $request->all()]);

        // asigning the html literal to a variable
        $text = session('form_data.deskripsi');
        $text = html_entity_decode($text);
        $text = htmlspecialchars($text);

        $session = session();

        $session->put('form_data.deskripsi_literal', $text);

        // Redirect the user to the create questionnaire page
        return redirect('/dashboard/questionnaires/create',);
    }

    public function show(Questionnaire $questionnaire)
    {
        return view('questionnaire', [
            "questionnaire" => $questionnaire,
            "title" => "Hai"
        ]);
    }

    public function showPrintPreview(Questionnaire $questionnaire)
    {


        $answerCount = [];

        foreach ($questionnaire->question as $q) {
            $answerCount[$q->id] = [
                1 => Answer::where('question_id', $q->id)->where('jawaban', 1)->count(),
                2 => Answer::where('question_id', $q->id)->where('jawaban', 2)->count(),
                3 => Answer::where('question_id', $q->id)->where('jawaban', 3)->count(),
                4 => Answer::where('question_id', $q->id)->where('jawaban', 4)->count(),
                5 => Answer::where('question_id', $q->id)->where('jawaban', 5)->count(),
                // choose which answer is the most chosen
                6 => Answer::where('question_id', $q->id)
                    ->select('jawaban')
                    ->groupBy('jawaban', 'respondent_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->jawaban,

            ];
        }

        // sort questions by number
        $questionnaire->question = $questionnaire->question->sortBy('nomor');
        return view('dashboard.questionnaires.print', [
            "questionnaire" => $questionnaire,
            "title" => "Hai",
            "answerCount" => $answerCount,
        ]);
    }
}
