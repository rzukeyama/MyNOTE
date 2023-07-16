<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Messages\GeneralMessages;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * 利用者を登録する
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $result = $user->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        Mail::to($validated['email'])->send(new UserCreated($user));

        return redirect()->route('login')->with('success', GeneralMessages::CREATEUSER_SUCCESS);
    }

    /**
     * ログインを試行する
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $challenge = $request->only('email', 'password');

        if (Auth::attempt($challenge)) {
            $request->session()->regenerateToken();
            return redirect()->intended('/')->with('success', GeneralMessages::LOGIN_SUCCESSED);
        }

        return back()->with('error', GeneralMessages::LOGIN_FAILED);
    }

    /**
     * ログアウトする
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * パスワードを変更する
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePassword (Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        if (Hash::check($request->input('password'), Auth::user()->password)) {
            return back()->with('error', GeneralMessages::CONFIG_PASSWORD_IS_SAME);
        }

        $user = User::find(Auth::user()->id);
        $user->password = $request->input('password');
        if (! $user->save()) {
            return back()->with('error', GeneralMessages::DB_ERROR);
        }

        return redirect('/')->with('success', GeneralMessages::CONFIG_PASSWORD_CHANGED);
    }

    public function changeDisplayName (Request $request): RedirectResponse
    {
        $request->validate([
            'display_name' => 'required',
        ]);

        if ($request->input('display_name') === Auth::user()->display_name) {
            return back()->with('error', GeneralMessages::CONFIG_NAME_IS_SAME);
        }

        $user = User::find(Auth::user()->id);
        $user->display_name = $request->input('display_name');
        if (! $user->save()) {
            return back()->with('error', GeneralMessages::DB_ERROR);
        }

        return redirect('/')->with('success', GeneralMessages::CONFIG_NAME_CHANGED);
    }

}
