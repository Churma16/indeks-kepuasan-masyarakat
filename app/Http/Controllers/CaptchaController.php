<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    // public function reload_captcha()
    // {
        // dd('Function reached.');
    //     return response()->json(['captcha' => captcha_img()]);
    // }

    public function check_captcha(Request $request, Questionnaire $questionnaire){

        $request->validate([
            'captcha' => 'required|captcha'
        ]);


        return redirect('/start/'.$questionnaire->link);

        // return view('questionnaire',[
        //     "questionnaire" => $questionnaire,
        //     "title"=> "Hai"
        // ]);
    }
}
