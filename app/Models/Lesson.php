<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\LessonCancellation;
use Illuminate\Support\Facades\Mail;

class Lesson extends Model
{
    protected $fillable = [
        'reservation_id',
        'instructor_id',
        'location_id',
        'start_time',
        'end_time',
        'status',
        'cancellation_reason',
        'cancellation_type',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the reservation for this lesson.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Get the instructor for this lesson.
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the location for this lesson.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the duo lesson participants.
     */
    public function duoParticipants()
    {
        return $this->hasMany(DuoLessonParticipant::class);
    }

    /**
     * Cancel the lesson
     */
    public function cancel($type, $reason)
    {
        $this->status = 'cancelled';
        $this->cancellation_type = $type;
        $this->cancellation_reason = $reason;
        // Set cancellation_status to pending for customer requests, approved for system cancellations
        $this->cancellation_status = ($type === 'customer_request') ? 'pending' : 'approved';
        $this->save();

        // Only send email for instructor and bad_weather cancellations (not customer requests)
        if (in_array($type, ['instructor_illness', 'bad_weather'])) {
            try {
                $customer = $this->reservation->customer;
                $instructorName = $this->instructor->personalInformation->first_name ?? 'Instructeur';
                Mail::to($customer->email)->send(new LessonCancellation($this, $type, $reason, $instructorName));
                \Log::info('Lesson cancellation email sent to ' . $customer->email . ' for lesson #' . $this->id . ' (' . $type . ')');
            } catch (\Exception $e) {
                \Log::error('Failed to send lesson cancellation email: ' . $e->getMessage());
            }
        }
    }

    /**
     * Mark lesson as completed
     */
    public function markCompleted()
    {
        $this->status = 'completed';
        $this->save();

        // Update reservation sessions_completed
        $reservation = $this->reservation;
        $reservation->sessions_completed += 1;
        if ($reservation->sessions_completed >= $reservation->package->num_sessions) {
            $reservation->status = 'completed';
        }
        $reservation->save();
    }
}
