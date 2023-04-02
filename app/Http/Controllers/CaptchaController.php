<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    public function reload_captcha()
    {
        dd('Function reached.');
        return response()->json(['captcha' => captcha_img()]);
    }

    public function check_captcha(Request $request){
        $request->validate([
            'captcha' => 'required|captcha'
        ]);

        return "Berhasil";
    }
}
