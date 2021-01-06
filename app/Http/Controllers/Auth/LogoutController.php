<?php


namespace RServices\Http\Controllers\Auth;


use RServices\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/')->withSuccess('Sie haben sich erfolgreich abgemeldet.');
    }

}
