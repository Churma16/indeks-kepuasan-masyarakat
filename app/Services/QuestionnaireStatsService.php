<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\Respondent;
use Carbon\Carbon;

class QuestionnaireStatsService
{
    public function calculateStats(Questionnaire $questionnaire)
    {
        $questionnaire_id = $questionnaire->id;

        $highestAgeArray = $this->getHighestAgeArray($questionnaire_id);
        $totalRespondent = $this->getTotalRespondent($questionnaire_id);
        $averageScore = $this->getAverageScore($questionnaire_id, $highestAgeArray);

        $questions = $questionnaire->question()->orderBy('nomor')->get();
        $genderWanita = Respondent::where('questionnaire_id', $questionnaire_id)->where('gender', 'wanita')->count();
        $genderPria = Respondent::where('questionnaire_id', $questionnaire_id)->where('gender', 'pria')->count();
        $lastEdit = Carbon::parse($questionnaire->update_at)->isoFormat('DD MMM YYYY');

        return[
            'title' => 'Detail Kuesioner',
            'questionnaire' => $questionnaire,
            'questions' => $questions,
            'genderWanita' => $genderWanita,
            'genderPria' => $genderPria,
            'totalRespondent' => $totalRespondent,
            'averageScore' => $averageScore,
            'lastEdit' => $lastEdit,
            'umur' => $this->getRespondentAge($questionnaire_id),
            'ikm' => $this->getRespondentSatifaction($questionnaire->question->pluck('id')->toArray()),
            'date' => $this->getLast14Day(),
            'respondentCount' => $this->getLast14DayRespondent($questionnaire_id),
            'percentCount' => $this->getCountinPercent($questionnaire_id, $highestAgeArray),
            'literalHighestAge' => $this->getLiteralHighestAge($highestAgeArray, $totalRespondent),
            'score' => $this->getSatisfactionScore($averageScore, $totalRespondent),
            'pengisiTerbanyak' => $this->getHighestFiller($questionnaire_id),
            'daysDifference' => $this->getDaysDifference($questionnaire->waktu_ekspirasi_baru),
        ];
    }

    public function getRespondentAge($questionaire_id)
    {
        $umur = [];
        $umur['umurKelas'] = Respondent::where('questionnaire_id', $questionaire_id)->selectRaw('umur, count(*) as count')
            ->groupBy('umur')
            ->pluck('count', 'umur')
            ->toArray();

        return $umur;
    }

    public function getRespondentSatifaction($idSoal)
    {
        $ikm = [];
        $ikm['ikmKelas'] = Answer::whereIn('question_id', $idSoal)
            ->selectRaw('jawaban, count(*) as count')
            ->groupBy('jawaban')
            ->pluck('count', 'jawaban')
            ->toArray();

        return $ikm;
    }

    public function getLast14Day()
    {
        $date = [];
        for ($i = 0; $i < 14; $i++) {
            $date[] = date('d/m', strtotime('-'.$i.' days'));
        }
        $date = array_reverse($date);

        return $date;
    }

    public function getLast14DayRespondent($questionaire_id)
    {
        $respondentCount = [];
        for ($i = 0; $i < 14; $i++) {
            $respondentCount[] = Respondent::where('questionnaire_id', $questionaire_id)
                ->whereDate('created_at', date('Y-m-d', strtotime('-'.$i.' days')))
                ->count();
        }
        $respondentCount = array_reverse($respondentCount);

        return $respondentCount;
    }

    public function getTotalRespondent($questionaire_id)
    {
        return Respondent::where('questionnaire_id', $questionaire_id)->count();
    }

    private function getAgeStatistic($questionaire_id)
    {
        $ansCountAll = [];
        for ($i = 1; $i < 6; $i++) {
            $ansCountAll[$i] = Respondent::where('questionnaire_id', $questionaire_id)->where('umur', $i)->count();
        }

        return $ansCountAll;
    }

    public function getHighestAgeArray($questionaire_id)
    {
        //Persen Pemilih
        $ansCountAll = $this->getAgeStatistic($questionaire_id);

        $highestAgeCount = max($ansCountAll);
        $highestAgeArray = array_keys($ansCountAll, $highestAgeCount);
        $highestAgeArray = reset($highestAgeArray);

        return $highestAgeArray;
    }

    public function getCountinPercent($questionaire_id, $highestAgeArray)
    {
        $totalRespondent = $this->getTotalRespondent($questionaire_id);

        $ansCount = Respondent::where('questionnaire_id', $questionaire_id)->where('umur', $highestAgeArray)->count();
        if ($ansCount == 0) {
            $percentCount = 0;
        } else {
            $percentCount = number_format(($ansCount / $totalRespondent) * 100, 2);
        }

        return $percentCount.'%';
    }

    public function getAverageScore($questionaire_id, $highestAgeArray)
    {
        // Mengambil Nilai Bobot Hasil Keppuasan pada Respondent Kategori Terbanyak
        // Mengambil ID responden dari database berdasarkan kuesioner dan umur
        $respondentIds = Respondent::where('questionnaire_id', $questionaire_id)
            ->where('umur', $highestAgeArray)
            ->pluck('id')
            ->toArray();

        // Pemetaan nilai jawaban ke bobot yang sesuai
        $answerMapping = [
            1 => -1,
            2 => -0.5,
            3 => 0,
            4 => 0.5,
            5 => 1,
        ];

        // Mengambil jawaban dari database dan melakukan transformasi menggunakan pemetaan bobot
        $transformedAnswers = Answer::whereIn('respondent_id', $respondentIds)
            ->pluck('jawaban')
            ->map(function ($value) use ($answerMapping) {
                return $answerMapping[$value] ?? $value;
            });

        // Menghitung nilai rata-rata dari jawaban yang telah diubah
        $averageScore = $transformedAnswers->average();

        return $averageScore;
    }

    public function getLiteralHighestAge($highestAgeArray, $totalRespondent)
    {
        $umurMapping = [
            1 => '18-24',
            2 => '25-34',
            3 => '35-44',
            4 => '45-54',
            5 => '55-64',
            6 => '65++',
        ];
        //menampilkan literal tertinggi
        if ($totalRespondent == 0) {
            $literalHighestAge = '-';
        } else {
            $literalHighestAge = $umurMapping[$highestAgeArray] ?? null;
        }

        return $literalHighestAge;
    }

    public function getSatisfactionScore($averageScore, $totalRespondent)
    {
        // Mencari Kemanakah nilai tersebut lebih dekat
        $scoreMapping = [
            [-1, 'Sangat Tidak Puas'],
            [-0.5, 'Tidak Puas'],
            [0, 'Cukup Puas'],
            [0.5, 'Puas'],
            [1, 'Sangat Puas'],
        ];

        usort($scoreMapping, function ($a, $b) use ($averageScore) {
            return abs($a[0] - $averageScore) <=> abs($b[0] - $averageScore);
        });

        if ($totalRespondent == 0) {
            $score = '-';
        } else {
            $score = $scoreMapping[0][1];
        }

        return $score;
    }

    public function getHighestFiller($questionaire_id)
    {
        $ansCountAll = $this->getAgeStatistic($questionaire_id);

        return max($ansCountAll);
    }

    public function getDaysDifference($questionnaire_new_end_date)
    {
        $ekspirasi = Carbon::parse($questionnaire_new_end_date);
        $endDate = Carbon::now();

        $daysDifference = $ekspirasi->diffInDays($endDate);

        return $daysDifference;
    }
}
