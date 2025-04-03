<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\RegistrationVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index() {
        return view('index');
    }

    public function customerRegistrationPage() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard'); // Redirect to the dashboard if logged in
        }
        return view('customer.auth.register');
    }

    public function customerRegister(RegisterRequest $request) {
        // Generate a 4-digit numeric verification code
        $verificationCode = rand(1000, 9999);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'verification_code' => $verificationCode,
        ]);

        // Send verification email using queue
        Mail::to($user->email)->queue(new RegistrationVerificationMail($verificationCode));

        return redirect()->route('otp.verify.page', ['email' => $request->email])
                         ->with('success', 'Verification code sent to your email.');
    }

    public function adminRegistrationPage() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard'); // Redirect to the dashboard if logged in
        }
        return view('admin.auth.register');
    }

    public function adminRegister(RegisterRequest $request) {
        // Generate a 4-digit numeric verification code
        $verificationCode = rand(1000, 9999);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'verification_code' => $verificationCode,
        ]);

        // Send verification email using queue
        Mail::to($user->email)->queue(new RegistrationVerificationMail($verificationCode));

        return redirect()->route('otp.verify.page', ['email' => $request->email])
                         ->with('success', 'Verification code sent to your email.');
    }

    public function showVerifyOtpPage(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->route('auth.login')->withErrors('Invalid request.');
        }
    
        if ($user->email_verified_at) {
            return redirect()->route('auth.login')->with('success', 'Your account is already verified. Please log in.');
        }
    
        return view('auth.verify_otp');
    }    

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|digits:4',
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->verification_code)
                    ->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => 'Invalid OTP. Please try again.']);
        }

        // Mark user as verified
        $user->email_verified_at = Carbon::now(); // Fill email_verified_at
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Your account has been verified! You can now log in.');
    }

    public function loginPage() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard'); // Redirect to the dashboard if logged in
        }
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Check if user is admin
        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'You are not allowed to login from here']);
        }

        // Check if user is verified
        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Your account is not verified. Please check your email.']);
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
        }

        return back()->withErrors(['password' => 'Invalid credentials.']);
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function logout(Request $request) {
        // Logout the user
        Auth::logout();
    
        // Clear session
        Session::flush();
        
        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirect to login with a success message
        return redirect()->route('login')
                         ->with('success', 'You have been logged out successfully.')
                         ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

}
