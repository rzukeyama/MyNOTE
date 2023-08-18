<?php

namespace App\Providers;

use App\Models\UserFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

/**
 * ViewComposerの登録をするためのProviderクラス
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * 指定テンプレート「以外」の全テンプレートに同じ変数を渡す処理
         *
         * ・ログインセッションがないページをリストに記載
         */
        \Illuminate\Support\Facades\View::composer('*', function (View $view) {
            $excludes = [
                'create_user',
                'users.login',
                'emails.*',
            ];
            if (! in_array($view->getName(), $excludes)){
                $view->with('userFunctions', UserFunction::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                    ->orderBy('id')
                    ->get());
            }
        });
    }
}
