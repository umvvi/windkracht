<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    /**
     * Show password setup form for activation
     */
    public function show($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        
        // Token should not be activated yet
        if ($user->is_active) {
            return redirect('/login')->with('error', 'Dit account is al geactiveerd.');
        }
        
        return view('auth.activate', compact('token'));
    }

    /**
     * Activate account with password
     */
    public function activate(Request $request, $token)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one digit
                'regex:/[@#$%^&*]/', // At least one special character
            ],
        ], [
            'password.min' => 'Wachtwoord moet minstens 12 karakters lang zijn.',
            'password.regex' => 'Wachtwoord moet minstens één hoofdletter, één getal en één speciaal teken (@, #, $, %, ^, &, *) bevatten.',
            'password.confirmed' => 'Wachtwoorden komen niet overeen.',
        ]);

        $user = User::where('activation_token', $token)->firstOrFail();
        
        // Activate user
        $user->password = Hash::make($request->password);
        $user->activation_token = null;
        $user->is_active = true;
        $user->save();

        // Auto-login
        Auth::login($user);

        // Log the login
        LoginLog::create([
            'user_id' => $user->id,
            'email_address' => $user->email,
            'action' => 'login',
            'logged_at_microseconds' => microtime(true),
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Registratie voltooid! Je bent automatisch ingelogd.');
    }
}
