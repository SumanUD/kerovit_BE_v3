<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;
use Carbon\Carbon;
class LoginController extends Controller
{
    public function index(Request $request){
        if (Auth::check() && Auth::user()->role == 1) {
            return redirect('/'); // Redirect to home page if user is authenticated
        }
        return view('login');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required' 
        ]);
    
        if (Auth::attempt($attributes)) {
            // Check if the authenticated user's role is not 1
            if (Auth::user()->role != 1) {
                Auth::logout(); // Logout the user
                return back()->withErrors(['email' => 'You are not authorized.']);
            }
    
            $userIp = request()->ip();
            return redirect('/')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

public function postReset($token, Request $request)
{
    $validator = Validator::make($request->all(), [
       'password' => 'required|min:8|confirmed'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::where('remember_token', $token)->first();

    if ($user) {
        $currentTime = Carbon::now();
        $emailValidity = Carbon::parse($user->email_validity);

        $currentTimeInMinutes = $currentTime->hour * 60 + $currentTime->minute;
        $emailValidityInMinutes = $emailValidity->hour * 60 + $emailValidity->minute;

        $timeDifference = $currentTimeInMinutes - $emailValidityInMinutes;

        if ($timeDifference <= 10) {
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('/login')->with('success', 'Password updated successfully!');
        } else {
            return redirect()->back()->with('error', 'The link has expired. Please request a new password reset.');
        }
    } else {
        return redirect()->back()->with('error', 'User not found or invalid token.');
    }
}



    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = User::where('email', '=', $request->email)->first();

        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->	email_verified_at = now();
            $user->save();

            // Assuming ForgotPasswordMail class is correctly implemented
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect('/login')->with(['success' => 'Link sent to your email.']);
        } else {
        return redirect('/login')->with(['error' => 'This email is not registered.']);
        }
    }

    public function indexResetPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            return view('reset-password', ['token' => $token]);
        } else {
            return redirect('/login')->with(['error' => 'Invalid token.']);
        }
    }
}
