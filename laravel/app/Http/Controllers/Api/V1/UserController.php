<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile() {
        $result['data'] = [
            'user' => User::user()
        ];
        return $this->trJsonSuccess($result, 200);
    }
}
