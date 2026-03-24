<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\Reservation;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    /**
     * Show owner dashboard
     */
    public function index()
    {
        $owner = Auth::user();
        $personalInfo = $owner->personalInformation;
        $unpaidReservations = Reservation::where('payment_received', false)->get();
        $totalRevenue = Reservation::where('payment_received', true)->sum('total_price');
        $totalReservations = Reservation::count();

        return view('owner.dashboard', compact(
            'personalInfo',
            'unpaidReservations',
            'totalRevenue',
            'totalReservations'
        ));
    }

    /**
     * Show personal information form
     */
    public function editPersonalInfo()
    {
        $personalInfo = Auth::user()->personalInformation;
        return view('owner.personal-info', compact('personalInfo'));
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
            'bsn' => 'nullable|string',
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
            'bsn',
        ]));

        if (!$personalInfo->user_id) {
            $personalInfo->user_id = $user->id;
        }

        $personalInfo->save();

        return redirect()->route('owner.dashboard')->with('success', 'Personal information updated successfully!');
    }

    /**
     * Change user role
     */
    public function changeUserRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|in:customer,instructor,owner',
        ]);

        $user = User::findOrFail($userId);

        // If changing to instructor, check if profile is complete
        if ($request->role === 'instructor') {
            $personalInfo = $user->personalInformation;

            // Check if profile exists and all required fields are filled
            if (!$personalInfo || empty($personalInfo->first_name) || empty($personalInfo->last_name) 
                || empty($personalInfo->street_address) || empty($personalInfo->city) 
                || empty($personalInfo->phone_mobile) || empty($personalInfo->bsn)) {
                
                return back()->with('error', 'Kan niet naar instructeur veranderen: dit persoon moet eerst hun volledige profiel invullen (inclusief BSN).');
            }
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "User role changed to {$request->role}");
    }

    /**
     * View customers
     */
    public function viewCustomers()
    {
        $customers = User::where('role', 'customer')->with('personalInformation')->get();
        return view('owner.customers', compact('customers'));
    }

    /**
     * View instructors
     */
    public function viewInstructors()
    {
        $instructors = User::where('role', 'instructor')->with('personalInformation')->get();
        return view('owner.instructors', compact('instructors'));
    }

    /**
     * View reservations and payment status
     */
    public function viewReservations()
    {
        $reservations = Reservation::with('customer', 'package', 'location')
            ->where('payment_received', false)
            ->get();

        return view('owner.reservations', compact('reservations'));
    }

    /**
     * Mark payment as received and confirm reservation
     */
    public function confirmPayment($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->markPaymentReceived();

        // Send confirmation emails (simulated)
        // Mail::send(...) to instructor
        // Mail::send(...) to customer

        return back()->with('success', 'Payment confirmed and customer notified!');
    }

    /**
     * Cancel lesson
     */
    public function cancelLesson(Request $request, $lessonId)
    {
        $request->validate([
            'type' => 'required|in:instructor_illness,bad_weather',
            'reason' => 'required|string',
        ]);

        $lesson = Lesson::findOrFail($lessonId);
        $lesson->cancel($request->type, $request->reason);

        return back()->with('success', 'Lesson cancelled!');
    }

    /**
     * View instructor schedule
     */
    public function viewInstructorSchedule(Request $request, $instructorId)
    {
        $instructor = User::findOrFail($instructorId);
        $viewType = $request->get('view', 'week');
        $date = $request->get('date', now());

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        $query = Lesson::where('instructor_id', $instructorId);

        if ($viewType === 'day') {
            $lessons = $query->whereDate('start_time', $date)->get();
        } elseif ($viewType === 'month') {
            $lessons = $query->whereMonth('start_time', $date->month)
                ->whereYear('start_time', $date->year)
                ->get();
        } else { // week
            $startOfWeek = $date->copy()->startOfWeek();
            $endOfWeek = $date->copy()->endOfWeek();
            $lessons = $query->whereBetween('start_time', [$startOfWeek, $endOfWeek])->get();
        }

        return view('owner.instructor-schedule', compact('instructor', 'lessons', 'viewType', 'date'));
    }

    /**
     * Manage customer
     */
    public function manageCustomer($customerId)
    {
        $customer = User::with('personalInformation', 'reservations.package')->findOrFail($customerId);
        return view('owner.manage-customer', compact('customer'));
    }

    /**
     * Manage instructor
     */
    public function manageInstructor($instructorId)
    {
        $instructor = User::with('personalInformation', 'lessons.reservation.customer')->findOrFail($instructorId);
        return view('owner.manage-instructor', compact('instructor'));
    }

    /**
     * Block/Unblock user
     */
    public function toggleUserStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User {$status}");
    }
}
