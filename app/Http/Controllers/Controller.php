<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToCreate(Request $request){
        {
            // Store the form data in a session variable
            session(['form_data' => $request->all()]);
        
            // Redirect the user to the create questionnaire page
            return redirect('/dashboard/questionnaires/create-question');
        }
    }
}
