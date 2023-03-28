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
            "title" => 'Pilih Kuesioner',
            "posts" => Questionnaire::latest()->paginate(24),
        ]);
    }
}
