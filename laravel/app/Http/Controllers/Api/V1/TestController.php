<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function sendMail() {
        Mail::to("someone@domain.com")->send(new TestMail());
        return $this->trJsonSuccess([], 200, 'Success send test email.');
    }

    public function dashboard() {
        dd('dashboard admin');
    }
}
