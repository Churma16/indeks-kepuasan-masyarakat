<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKuesioner = Questionnaire::count();
        $totalKuesionerAktif = Questionnaire::where('status_aktif','aktif')->count();
        $totalKuesionerHampirExpired = Questionnaire::where('status_aktif','aktif')->where('waktu_ekspirasi','<=',date('Y-m-d', strtotime('+7 days')))->count();

        return view('dashboard.index',[
            "title" => "Dashboard",
            "totalKuesioner" => $totalKuesioner,
            "totalKuesionerAktif" => $totalKuesionerAktif,
            "totalKuesionerHampirExpired" => $totalKuesionerHampirExpired,
        ]);
    }
}
