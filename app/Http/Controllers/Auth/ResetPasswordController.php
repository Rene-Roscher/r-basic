<?php

namespace RServices\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RServices\Http\Controllers\Controller;
use RServices\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function sendResetResponse(Request $request, $response)
    {
        return respond()->addMessage(trans($response), 'success')->setRedirect(route('manage.dashboard'))->response();
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);
    }

}
