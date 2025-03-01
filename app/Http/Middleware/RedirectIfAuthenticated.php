<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on the user's role
                $user = Auth::user();

                // Check the user's role and redirect accordingly
                switch ($user->is_admin) {
                    case 0:
                        return redirect()->route('admin.home');  // Admin Dashboard
                    case 1:
                        return redirect()->route('teacher.home');  // Teacher Dashboard
                    case 2:
                        return redirect()->route('student.home');  // Student Dashboard
                    // If the user's role doesn't match, do nothing or show an error message
                }
            }
        }

        return $next($request);
    }
}
