<?php

namespace RServices\Http\Controllers\Auth;

use Illuminate\Http\Request;
use RServices\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return respond()->addMessage(trans($response), 'success')->response();
    }

    public function sendResetLinkEmail(Request $request)
    {
    }

}
