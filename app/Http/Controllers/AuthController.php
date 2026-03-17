<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Store registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one digit
                'regex:/[@#$%^&*]/', // At least one special character
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character (@, #, $, %, ^, &, *).',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'is_active' => true,
        ]);

        Auth::login($user);

        // Log the login
        LoginLog::create([
            'user_id' => $user->id,
            'action' => 'login',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Log the login
            LoginLog::create([
                'user_id' => $user->id,
                'action' => 'login',
            ]);

            // Redirect based on role
            if ($user->isOwner()) {
                return redirect()->route('owner.dashboard');
            } elseif ($user->isInstructor()) {
                return redirect()->route('instructor.dashboard');
            } else {
                return redirect()->route('customer.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Log the logout
            LoginLog::create([
                'user_id' => Auth::id(),
                'action' => 'logout',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@#$%^&*]/',
            ],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
