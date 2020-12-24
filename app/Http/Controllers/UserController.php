<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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

        return redirect()->intended(route('homepage.index'));
    }

    public function logout()
    {
        // TODO: Add functionality to method
    }


    /**
     * TODO: Move this to a different place
     */
    private function validateRegister()
    {
        // TODO: Add functionality to method
    }

    /**
     * TODO: Move this to a different place
     */
    private function createUser()
    {
        // TODO: Add functionality to method
    }

    /**
     * TODO: Move this to a different place
     */
    private function validateUser()
    {
        // TODO: Add functionality to method
    }

    /**
     * TODO: Move this to a different place
     */
    private function signinUser()
    {
        // TODO: Add functionality to method
    }
}
