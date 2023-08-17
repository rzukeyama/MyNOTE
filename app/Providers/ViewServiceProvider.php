<?php

namespace App\Providers;

use App\Http\View\Composers\MainComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
         * 機能を追加したらここにも追加（ここに追加されている機能全てのテンプレートにログイン情報をセットする）
         */
        View::composer([
            'home.*',
            'key_values.*',
            'memo_lines.*',
            'user_functions.*',
            'notepads.*',
        ], MainComposer::class);
    }
}
