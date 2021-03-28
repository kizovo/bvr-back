<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login() {
        if (Auth::guard('web')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $result['data'] = User::authUserDetail();
            return $this->trJsonSuccess($result, 200, 'Success Login');
        }
        return $this->trJsonError(401, 'Unauthorised');
    }

    public function register(UserRequest $request) {
        if (!User::isFound($request->email)) {
            $result['data'] = User::register($request->all());
            return $this->trJsonSuccess($result, 200, 'Success Register');
        }
        return $this->trJsonSuccess([], 200, 'Email is already registered');
    }

    public function adminLogin() {
        if (Auth::guard('web-admin')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $result['data'] = Admin::authUserDetail();
            return $this->trJsonSuccess($result, 200, 'Success Login');
        }
        return $this->trJsonError(401, 'Unauthorised');
    }

    public function adminRegister(UserRequest $request) {
        if (!Admin::isFound($request->email)) {
            $result['data'] = Admin::register($request->all());
            return $this->trJsonSuccess($result, 200, 'Success Register');
        }
        return $this->trJsonSuccess([], 200, 'Email is already registered');
    }
}
