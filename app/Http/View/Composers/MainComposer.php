<?php

namespace App\Http\View\Composers;

use App\Models\UserFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 共通Viewで使用する変数をセットするためのComposer
 */
class MainComposer
{
    public function compose(View $view): void
    {
        $view->with('userFunctions', UserFunction::where('user_id', Auth::user()->id)
            ->orderBy('id')
            ->get());
    }
}
