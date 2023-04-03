<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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


        // Get All the Respondent's IKM
        $ikm=[];
        $ikm['ikmKelas'] = Answer::selectRaw('jawaban, count(*) as count')
        ->groupBy('jawaban')
        ->pluck('count', 'jawaban')
        ->toArray();
        

        //get the date of the last 14 day
        $date = [];
        for ($i=0; $i < 14; $i++) { 
            $date[] = date('d/m', strtotime('-'.$i.' days'));
        }
        $date = array_reverse($date);


        //get the respondent for the last 14 day
        $respondentCount = [];
        for ($i=0; $i < 14; $i++) { 
            $respondentCount[] = Respondent::whereDate('created_at', date('Y-m-d', strtotime('-'.$i.' days')))->count();
        }
        $respondentCount = array_reverse($respondentCount);


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
            'ikm' => $ikm,
            'date' => $date,
            'respondentCount' => $respondentCount,
        ]);
    }
}
