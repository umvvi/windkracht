<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_mobile' => 'required|string',
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

        // Validate all dates are in the future
        $now = \Carbon\Carbon::now();
        foreach ($request->session_dates as $dateString) {
            if (!$dateString) continue;
            
            $date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateString);
            
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

        // Create reservation
        $reservation = Reservation::create([
            'customer_id' => $customer->id,
            'package_id' => $package->id,
            'location_id' => $request->location_id,
            'total_price' => $package->price_per_person * ($package->type === 'duo' ? 2 : 1),
            'status' => 'pending_payment',
        ]);

        // Send invoice email (simulated)
        // Mail::send('emails.invoice', ['reservation' => $reservation], function($m) use ($customer) {
        //     $m->to($customer->email)->subject('Invoice for your kitesurfing lessons');
        // });

        return redirect()->route('customer.dashboard')
            ->with('success', 'Reservation created! An invoice has been sent to your email.');
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
