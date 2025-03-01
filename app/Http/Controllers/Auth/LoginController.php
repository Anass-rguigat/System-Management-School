<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Override the redirectTo method to handle role-based redirection.
     */
    protected function redirectTo()
    {
        if (Auth::check()) {
            switch (Auth::user()->is_admin) {
                case 0:
                    return route('admin.home'); 
                case 1:
                    return route('teacher.home'); 
                case 2:
                    return route('student.home'); 
                default:
                    return route('login');  
            }
        }

        return route('login');  
    }

    /**
     * Override authenticated() method for additional control.
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect($this->redirectTo());
    }

    /**
     * Handle logout and redirect to login page.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Ensure only guests can access login and only authenticated users can log out.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
