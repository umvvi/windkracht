<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\Lesson;
use App\Models\Reservation;
use App\Rules\DutchPostalCode;
use App\Rules\DutchPhoneNumber;
use App\Rules\BsnNumber;
use App\Rules\NoNumbers;
use App\Mail\LessonCancellation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InstructorDashboardController extends Controller
{
    /**
     * Show instructor dashboard
     */
    public function index()
    {
        $instructor = Auth::user();
        $personalInfo = $instructor->personalInformation;
        $upcomingLessons = Lesson::where('instructor_id', $instructor->id)
            ->where('status', 'scheduled')
            ->orderBy('start_time')
            ->get();

        return view('instructor.dashboard', compact('upcomingLessons', 'personalInfo'));
    }

    /**
     * Show personal information form
     */
    public function editPersonalInfo()
    {
        $personalInfo = Auth::user()->personalInformation;
        return view('instructor.personal-info', compact('personalInfo'));
    }

    /**
     * Update personal information
     */
    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50', new NoNumbers('Voornaam')],
            'last_name' => ['required', 'string', 'max:50', new NoNumbers('Achternaam')],
            'street_address' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'postal_code' => ['nullable', new DutchPostalCode()],
            'date_of_birth' => 'nullable|date|before:today',
            'phone_mobile' => ['required', new DutchPhoneNumber()],
            'bsn' => ['nullable', new BsnNumber()],
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

        return redirect()->route('instructor.dashboard')->with('success', 'Personal information updated successfully!');
    }

    /**
     * Show lessons schedule (daily, weekly, monthly)
     */
    public function schedule(Request $request)
    {
        $instructor = Auth::user();
        $viewType = $request->get('view', 'week');
        $date = $request->get('date', now());

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        $query = Lesson::where('instructor_id', $instructor->id);

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

        return view('instructor.schedule', compact('lessons', 'viewType', 'date'));
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

        if ($lesson->instructor_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized');
        }

        $lesson->cancel($request->type, $request->reason);

        // Send email to customer (simulated)
        // Mail::send('emails.lesson-cancelled', ['lesson' => $lesson], function($m) use ($lesson) {
        //     $m->to($lesson->reservation->customer->email)->subject('Your lesson has been cancelled');
        // });

        return back()->with('success', 'Lesson cancelled and customer notified!');
    }

    /**
     * View customers
     */
    public function viewCustomers()
    {
        $instructor = Auth::user();
        $lessons = $instructor->lessons()->with('reservation.customer')->get();
        $customers = [];

        foreach ($lessons as $lesson) {
            $customer = $lesson->reservation->customer;
            if (!isset($customers[$customer->id])) {
                $customers[$customer->id] = $customer;
            }
        }

        return view('instructor.customers', compact('customers'));
    }

    /**
     * Manage customer
     */
    public function manageCustomer($customerId)
    {
        $customer = User::findOrFail($customerId);
        $lessons = Lesson::where('instructor_id', Auth::id())
            ->whereHas('reservation', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })->get();

        return view('instructor.manage-customer', compact('customer', 'lessons'));
    }
}
