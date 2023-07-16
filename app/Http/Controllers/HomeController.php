<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $this->isSetName();
        return view('home/index')
            ->with('userFunctions', UserFunction::where('user_id', Auth::user()->id)
            ->orderBy('id')
            ->get());
    }

    private function isSetName()
    {
        if (is_null(Auth::user()->display_name)) {
            Session::flash('error', GeneralMessages::HOME_NAME_NOT_SET);
        }
    }
}
