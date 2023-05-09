<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Form;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'fields' => ['required', 'string'],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $data['user_id'] = auth()->id();
        $data['fields'] = json_decode($data['fields']);
        $data['token'] = Str::uuid();

        $form = Form::create($data);

        return response()->json(['success' => true]);
    }
}
