<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Location;
use App\Models\Lesson;
use App\Mail\ReservationConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerDashboardController extends Controller
{
    /**
     * Show customer dashboard
     */
    public function index()
    {
        $customer = Auth::user();
        $reservations = $customer->reservations()->with('package', 'location')->get();
        $personalInfo = $customer->personalInformation;

        return view('customer.dashboard', compact('reservations', 'personalInfo'));
    }

    /**
     * Show personal information form
     */
    public function editPersonalInfo()
    {
        $personalInfo = Auth::user()->personalInformation;
        return view('customer.personal-info', compact('personalInfo'));
    }

    /**
     * Update personal information
     */
    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'street_address' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'postal_code' => 'nullable|regex:/^\d{4}[A-Z]{2}$/i',
            'date_of_birth' => 'nullable|date|before:today',
            'phone_mobile' => 'required|regex:/^(\+31|0)[1-9]\d{1,9}$/',
        ], [
            'postal_code.regex' => 'Postcode moet het formaat XXXXAB hebben (4 cijfers en 2 letters), bijvoorbeeld 1234AB.',
            'phone_mobile.regex' => 'Telefoonnummer moet een geldig Nederlands nummer zijn (06... of +31...).',
            'date_of_birth.before' => 'Geboortedatum kan niet in de toekomst liggen.',
        ]);

        $user = Auth::user();
        $personalInfo = $user->personalInformation ?? new PersonalInformation();

        $personalInfo->fill($request->only([
            'first_name',
            'last_name',
            'street_address',
            'city',
            'postal_code',
            'date_of_birth',
            'phone_mobile',
        ]));

        if (!$personalInfo->user_id) {
            $personalInfo->user_id = $user->id;
        }

        $personalInfo->save();

        return redirect()->route('customer.dashboard')->with('success', 'Personal information updated successfully!');
    }

    /**
     * Show make reservation form
     */
    public function makeReservation()
    {
        $packages = Package::all();
        $locations = Location::all();

        return view('customer.make-reservation', compact('packages', 'locations'));
    }

    /**
     * Store reservation
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'location_id' => 'required|exists:locations,id',
            'session_dates' => 'required|array|min:1',
            'session_dates.*' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
        ]);

        $package = Package::find($request->package_id);
        $customer = Auth::user();
        $location = Location::find($request->location_id);

        // Validate all dates are in the future
        $now = \Carbon\Carbon::now();
        $filteredDates = array_filter($request->session_dates);
        
        // Validate we have the correct number of dates
        if (count($filteredDates) == 0) {
            return back()->withInput()->withErrors([
                'session_dates' => 'Selecteer ten minste één lesdatum.'
            ]);
        }
        
        if (count($filteredDates) != $package->num_sessions) {
            return back()->withInput()->withErrors([
                'session_dates' => 'U moet exact ' . $package->num_sessions . ' sessie(s) selecteren voor dit pakket.'
            ]);
        }
        
        foreach ($filteredDates as $dateString) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateString);
            } catch (\Exception $e) {
                return back()->withInput()->withErrors([
                    'session_dates' => 'Ongeldige datumnotatie. Gebruik format: JJJJ-MM-DD HH:MM.'
                ]);
            }
            
            if ($date->isPast()) {
                return back()->withInput()->withErrors([
                    'session_dates' => 'Alle lesdatum(s) moeten in de toekomst liggen.'
                ]);
            }
            
            if ($date->isBefore($now->addHours(24))) {
                return back()->withInput()->withErrors([
                    'session_dates' => 'Lessen moeten minstens 24 uur van tevoren worden geboekt.'
                ]);
            }
        }

        // Check for duplicate or overlapping times (lessons must be at least 3 hours apart)
        $dateObjectsArray = array_values(array_map(function($dateString) {
            return \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateString);
        }, $filteredDates));
        
        if (count($dateObjectsArray) < 1) {
            return back()->withInput()->withErrors([
                'session_dates' => 'Selecteer ten minste één lesdatum.'
            ]);
        }

        for ($i = 0; $i < count($dateObjectsArray); $i++) {
            for ($j = $i + 1; $j < count($dateObjectsArray); $j++) {
                $diff = abs($dateObjectsArray[$i]->diffInHours($dateObjectsArray[$j]));
                
                if ($diff == 0) {
                    return back()->withInput()->withErrors([
                        'session_dates' => 'U kunt niet dezelfde datum twee keer selecteren.'
                    ]);
                }
                
                // Only check 3-hour separation if there are 2+ sessions
                if ($package->num_sessions > 1 && $diff < 3) {
                    return back()->withInput()->withErrors([
                        'session_dates' => 'Lessen moeten minimaal 3 uur van elkaar verwijderd zijn.'
                    ]);
                }
            }
        }

        // Create reservation
        $reservation = Reservation::create([
            'customer_id' => $customer->id,
            'package_id' => $package->id,
            'location_id' => $request->location_id,
            'total_price' => $package->price_per_person * ($package->type === 'duo' ? 2 : 1),
            'status' => 'pending_payment',
        ]);

        // Create lessons for each session date
        $availableInstructors = User::where('role', 'instructor')->where('is_active', true)->get();
        $lessonDuration = 2; // Default 2 hours per lesson
        $lessons = [];
        $lessonDuration = 2.5; // Default 2.5 hours per lesson

        foreach ($filteredDates as $dateString) {
            $startTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateString);
            $endTime = $startTime->copy()->addHours($lessonDuration);

            // Get instructor with no conflicts (lessons must be 3 hours apart minimum)
            $instructor = null;
            foreach ($availableInstructors as $potentialInstructor) {
                $conflicts = \App\Models\Lesson::where('instructor_id', $potentialInstructor->id)
                    ->where('status', 'scheduled')
                    ->where(function ($q) use ($startTime, $endTime) {
                        $q->whereBetween('start_time', [$startTime->copy()->subHours(3), $endTime->copy()->addHours(3)])
                          ->orWhereBetween('end_time', [$startTime->copy()->subHours(3), $endTime->copy()->addHours(3)]);
                    })
                    ->exists();
                
                if (!$conflicts) {
                    $instructor = $potentialInstructor;
                    break;
                }
            }

            if (!$instructor) {
                $reservation->delete();
                return back()->withInput()->withErrors([
                    'session_dates' => 'Geen instructeur beschikbaar voor alle geselecteerde datums. Probeer andere datums.'
                ]);
            }

            if ($instructor) {
                $lesson = \App\Models\Lesson::create([
                    'reservation_id' => $reservation->id,
                    'instructor_id' => $instructor->id,
                    'location_id' => $request->location_id,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'status' => 'scheduled',
                ]);
                $lessons[] = $lesson;
            }
        }

        // Send reservation confirmation email with payment details
        try {
            Mail::to($customer->email)->send(new ReservationConfirmation($reservation, $lessons));
            \Log::info('Reservation confirmation email sent to ' . $customer->email . ' for reservation #' . $reservation->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send reservation confirmation email: ' . $e->getMessage());
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Reservering aangemaakt! Wacht op betaalbevestiging. ' . count($filteredDates) . ' les(sen) ingepland.');
    }

    /**
     * Mark payment as received
     */
    public function markPaymentReceived($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->customer_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized');
        }

        $reservation->markPaymentReceived();

        return back()->with('success', 'Payment marked as received!');
    }

    /**
     * Cancel lesson
     */
    public function cancelLesson(Request $request, $lessonId)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);

        $lesson = \App\Models\Lesson::findOrFail($lessonId);
        $reservation = $lesson->reservation;

        if ($reservation->customer_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized');
        }

        $lesson->cancel('customer_request', $request->reason);

        return back()->with('success', 'Lesson cancelled. You can now select a new date.');
    }

    /**
     * View reservations
     */
    public function viewReservations()
    {
        $reservations = Auth::user()->reservations()->with('package', 'location', 'lessons')->get();
        return view('customer.reservations', compact('reservations'));
    }
}
