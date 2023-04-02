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

    public function store(Questionnaire $questionnaire, Request $request){
        
    }
}
