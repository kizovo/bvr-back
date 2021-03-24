<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            $result['data'] = [
                'user' => $user,
                'token' => $user->createToken('authToken')->accessToken
            ];
            return $this->trJsonSuccess($result, 200, 'Success Login');
        } else {
            return $this->trJsonError(401, 'Unauthorised');
        }
    }

    public function register(UserRequest $request) {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $result['data'] = [
            'user' => $user,
            'token' => $user->createToken('authToken')->accessToken
        ];

        return $this->trJsonSuccess($result, 200, 'Success Register');
    }
}
