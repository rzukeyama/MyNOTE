<?php

namespace App\Http\Controllers;

use App\Mail\Test;
use App\Messages\GeneralMessages;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $this->isSetName();
        $this->isNotSetFunction();

        return view('home/index');
    }

    public function testmail()
    {
        Mail::to(Auth::user()->email)->send(new Test());
    }

    public function layoutest()
    {
        return view('home.test')
            ->with('userFunctions', UserFunction::where('user_id', Auth::user()->id)
            ->orderBy('id')
            ->get());
    }

    /**
     * 表示名が設定されていなければ、表示名を設定するようにメッセージを表示する
     */
    private function isSetName()
    {
        if (is_null(Auth::user()->display_name)) {
            Session::flash('error', GeneralMessages::HOME_NAME_NOT_SET);
        }
    }

    private function isNotSetFunction()
    {
        if (! UserFunction::isNotSet(Auth::user()->id)) {
            Session::flash('error', GeneralMessages::HOME_FUNC_NOT_SET);
        }
    }
}
