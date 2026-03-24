<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check if user has complete personal info
        if (!$user || !$user->personalInformation) {
            return redirect()->route($user->role === 'instructor' ? 'instructor.personal-info' : 'customer.personal-info')
                ->with('warning', 'Vul eerst je persoonlijke gegevens in voordat je verder gaat.');
        }

        $personalInfo = $user->personalInformation;

        // Required fields for both roles
        $requiredFields = ['first_name', 'last_name', 'street_address', 'city', 'phone_mobile'];

        // Additional required fields for instructors
        if ($user->role === 'instructor') {
            $requiredFields[] = 'bsn';
        }

        // Check if all required fields are filled
        $isComplete = collect($requiredFields)->every(fn($field) => !empty($personalInfo->$field));

        if (!$isComplete) {
            $message = $user->role === 'instructor'
                ? 'Vul alle verplichte velden in je profiel in (inclusief BSN voor instructeurs).'
                : 'Vul alle verplichte velden in je profiel in.';

            return redirect()->route($user->role === 'instructor' ? 'instructor.personal-info' : 'customer.personal-info')
                ->with('warning', $message);
        }

        return $next($request);
    }
}
