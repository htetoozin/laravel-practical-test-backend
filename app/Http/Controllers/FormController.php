<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show(Request $request, $token) 
    {
        $form = Form::where('token', $token)->first();

        if(!$form){
            abort(404); 
        }
        
        return view('form', compact('form'));
    }
}
