<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    // public function redirectTo(Request $request)
    // {
    //     Log::info('Start code');

    //     try{
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('login'); // Redirect to login if no user is authenticated
    //     }

    //     if ($user->first_login) {
    //         // Update the first_login field to false
    //         $user->first_login == 0;
    //         $user->save();

    //         // Redirect to the first-time login page
    //         return redirect()->route('profile.setting', Auth::user()->id);
    //     } else {
    //         return redirect()->intended('mood.save1');
    //     }

    //     } catch (\Exception $e) {
    //         Log::error('Failed: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['error' => 'Failed'])
    //         ;
    //     }
    // }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
