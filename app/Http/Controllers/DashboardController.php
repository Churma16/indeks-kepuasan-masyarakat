<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Respondent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKuesioner = Questionnaire::count();
        $totalKuesionerAktif = Questionnaire::where('status_aktif','aktif')->count();
        $totalKuesionerHampirExpired = Questionnaire::where('status_aktif','aktif')->where('waktu_ekspirasi','<=',date('Y-m-d', strtotime('+7 days')))->count();

        $totalRespondent = Respondent::count();
        
        $genderWanita = Respondent::where('gender','wanita')->count();
        $genderPria = Respondent::where('gender','pria')->count();

        // Get All the Respondent's Age
        $umur = [];
        $umur['umurKelas'] = Respondent::selectRaw('umur, count(*) as count')
        ->groupBy('umur')
        ->pluck('count', 'umur')
        ->toArray();

        return view('dashboard.index',[
            "title" => "Dashboard",
            "totalKuesioner" => $totalKuesioner,
            "totalKuesionerAktif" => $totalKuesionerAktif,
            "totalKuesionerHampirExpired" => $totalKuesionerHampirExpired,
            "totalRespondent" => $totalRespondent,
            "genderWanita" => $genderWanita,
            "genderPria" => $genderPria,
            // access with $umur['umurKelas'][array_key]
            'umur' => $umur,
        ]);
    }
}
