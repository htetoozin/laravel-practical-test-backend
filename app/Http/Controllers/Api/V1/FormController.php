<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\FormResource;
use App\Events\FormProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Form;
use Validator;


class FormController extends BaseController
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'customer_email'  => ['required', 'email'],
            'title' => ['required', 'string'],
            'fields' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), 422);
        }

        $attributes = $validator->validated();

        $form = Arr::except($attributes, ['customer_email']);

        $form['user_id'] = auth()->id();
        $form['fields'] = json_decode($form['fields']);
        $form['token'] = Str::uuid();

        $form = Form::create($form);

        $link = config('app.url') . "/forms/{$form->token}"; 
        FormProcessed::dispatch($attributes['customer_email'], $form, $link);

        $response = array_merge([],[
            'code' =>  '200',
            'status' => 'success',
            'data' => new FormResource($form),
        ]);

        return $response;
    }
}
