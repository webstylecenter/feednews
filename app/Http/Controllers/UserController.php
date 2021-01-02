<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class UserController extends BaseController
{
    public function login(): View
    {
        return view('user.login', ['bodyClass' => 'error403']);
    }

    public function register(Request $request): View
    {
        return view('user.register', ['bodyClass' => 'register', 'request' => $request]);
    }

    public function submitRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required'],
            'password' => ['required', 'min:6'],
            'gdpr' => ['required']
        ]);

        $user = User::create([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        Auth::loginUsingId($user->id, true);
        return redirect(route('homepage.index'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['Invalid credentials']);
        }

        $user = Auth::user();
        $user->last_login = Carbon::now();
        $user->ip_address = $request->ip();
        $user->user_agent = $request->userAgent();
        $user->save();

        return redirect()->intended(route('homepage.index'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect(route('homepage.index'));
    }

    public function redirectToOauth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function oAuthCallBack(Request $request): RedirectResponse
    {
        $user = Socialite::driver('google')->user();

        $dbUser = User::where('email', '=', $user->getEmail())->first();
        if (!$dbUser) {
            $dbUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'enabled' => true,
                'last_login' => Carbon::now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'password' => sha1(uniqid())
            ]);
        } else {
            $dbUser->last_login = Carbon::now();
            $dbUser->ip_address = $request->ip();
            $dbUser->user_agent = $request->userAgent();
            $dbUser->save();
        }

        Auth::loginUsingId($dbUser->id);
        return redirect(route('homepage.index'));
    }

    /**
     * TODO: Combine this with the login methods above
     */
    public function facebookRedirectToOauth()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookoAuthCallBack(Request $request): RedirectResponse
    {
        $user = Socialite::driver('facebook')->user();

        $dbUser = User::where('email', '=', $user->getEmail())->first();
        if (!$dbUser) {
            $dbUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'enabled' => true,
                'last_login' => Carbon::now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'password' => sha1(uniqid())
            ]);
        } else {
            $dbUser->last_login = Carbon::now();
            $dbUser->ip_address = $request->ip();
            $dbUser->user_agent = $request->userAgent();
            $dbUser->save();
        }

        Auth::loginUsingId($dbUser->id);
        return redirect(route('homepage.index'));
    }

    public function facebookRemoveUser()
    {
        // TODO: Make this functionality work
    }
}
