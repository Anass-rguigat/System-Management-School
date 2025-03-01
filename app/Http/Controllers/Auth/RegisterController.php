<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileMail;
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $hashedPassword = Hash::make($data['password']);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $hashedPassword,  // Store the hashed password
        ]);

        
        Mail::to($user->email)->send(new ProfileMail($data['password'], $user));

        return $user;
    }

    /**
     * Override the redirectTo property dynamically based on the user's role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (Auth::check()) {
            $user = Auth::user(); 

            switch ($user->is_admin) {
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
}
