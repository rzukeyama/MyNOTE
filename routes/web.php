<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 利用者登録
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/create_user', [\App\Http\Controllers\UserController::class, 'create']);

Route::view('/login', 'users/login')->name('login');
Route::view('/create_user', 'create_user');

Route::get('/user/logout', [\App\Http\Controllers\UserController::class, 'logout']);

// 認証が必要なページ
Route::middleware('auth')->group(function() {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/user/confirm_password', function() {
        return view('/users/confirm_password');
    })->name('password.confirm');

    Route::post('/user/confirm_password', function (\Illuminate\Http\Request $request) {
        if (! \Illuminate\Support\Facades\Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['正しいパスワードを入力してください']
            ]);
        }
        $request->session()->passwordConfirmed();
        return redirect()->intended();
    })->middleware('throttle:6,1');

    Route::post('/user/change_password', [\App\Http\Controllers\UserController::class, 'changePassword']);

    // UserFunctionsController
    Route::resource('user_functions', \App\Http\Controllers\UserFunctionsController::class);

    // LineMemosController
    Route::resource('memo_lines', \App\Http\Controllers\MemoLinesController::class);

    /**
     * 利用者情報変更のため、再度パスワード認証が必要なRoute
     */
    Route::middleware('password.confirm')->group(function() {
        Route::view('/user/change_password', '/users/change_password');

        Route::view('/user/change_name', '/users/change_name');
        Route::post('/user/change_name', [\App\Http\Controllers\UserController::class, 'changeDisplayName']);

        Route::view('/user/delete', '/users/delete');
        Route::post('/user/delete', [\App\Http\Controllers\UserController::class, 'delete']);
    });

    Route::get('/testmail', [\App\Http\Controllers\HomeController::class, 'testmail']);
});

function httpGetPost()
{
    return ['get', 'post'];
}
