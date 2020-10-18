<?php


namespace RServices\Http\Controllers\Crud;


use Illuminate\Support\Facades\Auth;
use Nette\Caching\Cache;
use RServices\Http\Controllers\Controller;
use RServices\Providers\RouteServiceProvider;
use RServices\User;

class CrudController extends Controller
{

    public function signInto(User $entry)
    {
        $id = user()->id;
        Auth::loginUsingId($entry->id);
        \session()->put('sign_key', $id);
        return redirect(RouteServiceProvider::HOME);
    }

    public function signBack()
    {
        if (\session()->has('sign_key')) {
            Auth::loginUsingId(\session('sign_key'), true);
            \session()->forget('sign_key');
            return redirect(RouteServiceProvider::HOME);
        }
        return abort(404);
    }

}
