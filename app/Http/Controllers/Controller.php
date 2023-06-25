<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Models\Questionnaire;
use App\Models\Answer;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Redirect user to create questionnaire page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToCreate(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'waktu_ekspirasi' => 'required|date|after:today',
        ], [
            'waktu_ekspirasi.after' => 'Tanggal yang dimasukkan harus setelah hari ini.',
        ]);

        // Store the form data in a session variable
        session(['form_data' => $request->all()]);

        // Extract the description from the form data and encode it for displaying
        $text = session('form_data.deskripsi');
        $text = html_entity_decode($text);
        $text = htmlspecialchars($text);

        // Store the encoded description in a session variable
        $session = session();
        $session->put('form_data.deskripsi_literal', $text);

        // Taking only one category
        if (session('form_data.kategoriSelect') == 'text') {
            $session->forget('form_data.kategoriSelect');
        } elseif (session('form_data.kategoriSelect')) {
            $session->put('form_data.kategori', session('form_data.kategoriSelect'));
            $session->forget('form_data.kategoriSelect');
        }

        // Redirect the user to the create questionnaire page
        return redirect('/dashboard/questionnaires/create');
    }


    /**
     * Display the questionnaire.
     *
     * @param Questionnaire $questionnaire
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Questionnaire $questionnaire)
    {
        return view('questionnaire', [
            "questionnaire" => $questionnaire,
            "title" => "Hai"
        ]);
    }

    /**
     * Display the print preview of the questionnaire.
     *
     * @param Questionnaire $questionnaire
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPrintPreview(Questionnaire $questionnaire)
    {
        // Count the number of answers for each question in the questionnaire
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
                    ->pluck('jawaban')
                    ->toArray(),
            ];
        }

        // Get All the Respondent's IKM
        $idSoal = $questionnaire->question->pluck('id')->toArray();
        $ikm = [];
        $ikm['ikmKelas'] = Answer::whereIn('question_id', $idSoal)
            ->selectRaw('jawaban, count(*) as count')
            ->groupBy('jawaban')
            ->pluck('count', 'jawaban')
            ->toArray();

        // Sort the questions by number
        $questionnaire->question = $questionnaire->question->sortBy('nomor');

        // foreach ($answerCount as $questionId => $answers) {
        //     $uniqueMostChosenAnswers = array_unique($answers[6]);
        //     $answerCount[$questionId][6] = $uniqueMostChosenAnswers;
        // }

        return view('dashboard.questionnaires.print', [
            "questionnaire" => $questionnaire,
            "title" => "Hai",
            "answerCount" => $answerCount,
            "ikm" => $ikm,
        ]);
    }
}
