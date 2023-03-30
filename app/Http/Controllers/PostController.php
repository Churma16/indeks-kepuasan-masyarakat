<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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

            // kode dibawah ini akan mengubah format waktu yang ada di database
            $dateold=$questionnaire->waktu_ekspirasi,
            $datenew=date('d F Y',strtotime($dateold)),
            $questionnaire->waktu_ekspirasi=$datenew,

            // kode dibawah ini akan menghitung jumlah pertanyaan yang ada di kuesioner
            // $questionnaire->question->count() berarti menghitung jumlah data yang ada di tabel pertanyaan
            // $questionnaire->jumlah_pertanyaan=$questionnaire->question->count(),

            "questionnaire" => $questionnaire,


        ]);
    }
}
