<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticatedController extends BaseController
{
    /**
     * Login user
     * 
     * Routing: /v1/login
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email'     => ['required', 'email'],
            'password'  => ['required', 'min:4'],
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), 422);
        }

        $user = User::where('email', $request->email)->first();
 
        if (!$user || ! \Hash::check($request->password, $user->password)) {
            
            $message = 'The provided credentials are incorrect.';
            return $this->responseError($message, 422);
        }

        $user->tokens()->delete();
        
        $token = $user->createToken(config('app.sanctum_key'))->plainTextToken;

         $response = array_merge([],[
            'code' =>  '200',
            'status' => 'success',
            'user' => new UserResource($user),
            'token' => $token
        ]);

        return $response;
    }
}
