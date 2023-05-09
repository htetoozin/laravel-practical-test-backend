<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Events\FormProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Form;
use Validator;


class FormController extends Controller
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'customer_email'  => ['required', 'email'],
            'title' => ['required', 'string'],
            'fields' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $attributes = $validator->validated();

        $form = Arr::except($attributes, ['customer_email']);

        $form['user_id'] = auth()->id();
        $form['fields'] = json_decode($form['fields']);
        $form['token'] = Str::uuid();

        $form = Form::create($form);

        $link = config('app.url') . "/forms/{$form->token}"; 
        FormProcessed::dispatch($attributes['customer_email'], $form, $link);
        
        return response()->json(['success' => true]);
    }
}
