<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function authenticate(AuthRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $user->password))
        {
            throw ValidationException::withMessages([
                'email' => ['Invalid login credentials']
            ]);
        }

        $response = (object) [
            'user' => new UserResource($user),
            'token' => $user->createToken('auth')->plainTextToken
        ];

        return new AuthenticatedUserResource($response);
    }

    public function getUser(Request $request) 
    {
        // $user = $request->user();
        // return new UserResource($user);
        $users = User::all();
        return UserResource::collection($users);
    }
}
