<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class RegisteredUserController extends Controller
{
     /**
     * Create user register
     *
     * Routing: /v1/register
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()->first()], 422);
        }

        $data = $validator->validated();

        $user = User::create($data);
        $token = $user->createToken(config('app.sanctum_key'))->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }
}
