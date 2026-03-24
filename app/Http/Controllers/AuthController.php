<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\LoginLog;
use App\Mail\ActivationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
     * Store registration (step 1: email only)
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ], [
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al geregistreerd.',
        ]);

        // Create user with inactive status
        $activationToken = Str::random(64);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make(Str::random(32)), // Temporary password
            'role' => 'customer',
            'is_active' => false,
            'activation_token' => $activationToken,
        ]);

        // Generate activation link
        $activationLink = route('activation.show', ['token' => $activationToken]);

        // Send activation email
        try {
            Mail::to($user->email)->send(new ActivationEmail($user, $activationLink));
            \Log::info('Activation email sent to ' . $user->email);
        } catch (\Exception $e) {
            \Log::error('Failed to send activation email: ' . $e->getMessage());
            $user->delete(); // Delete user if email fails
            return back()->with('error', 'Kon geen e-mail versturen. Probeer later opnieuw.');
        }

        return redirect('/login')->with('success', 'Registratie gelukt! Controleer je e-mail voor de activatielink.');
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

            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Account is nog niet geactiveerd. Controleer je e-mail voor de activatielink.');
            }

            // Log the login with microsecond precision
            LoginLog::create([
                'user_id' => $user->id,
                'email_address' => $user->email,
                'action' => 'login',
                'logged_at_microseconds' => microtime(true),
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

        return back()->with('error', 'Ongeldige inloggegevens');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Log the logout with microsecond precision
            LoginLog::create([
                'user_id' => Auth::id(),
                'email_address' => Auth::user()->email,
                'action' => 'logout',
                'logged_at_microseconds' => microtime(true),
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
