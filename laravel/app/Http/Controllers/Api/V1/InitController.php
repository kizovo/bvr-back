<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class InitController extends Controller
{
    public function index() {
        return $this->trJsonSuccess([], 200, 'Welcome to API version 1');
    }
}
