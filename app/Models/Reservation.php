<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\PaymentConfirmation;
use Illuminate\Support\Facades\Mail;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'package_id',
        'location_id',
        'status',
        'payment_received',
        'payment_date',
        'total_price',
        'sessions_completed',
    ];

    protected $casts = [
        'payment_received' => 'boolean',
        'payment_date' => 'date',
    ];

    /**
     * Get the customer (user) for this reservation.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the package for this reservation.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the location for this reservation.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the lessons for this reservation.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Check if payment is pending
     */
    public function isPendingPayment()
    {
        return !$this->payment_received;
    }

    /**
     * Get remaining sessions
     */
    public function getRemainingSessionsAttribute()
    {
        return $this->package->num_sessions - $this->sessions_completed;
    }

    /**
     * Mark payment as received
     */
    public function markPaymentReceived()
    {
        $this->payment_received = true;
        $this->payment_date = now();
        $this->status = 'confirmed';
        $this->save();

        // Send payment confirmation email
        try{
            $lessons = $this->lessons()->orderBy('start_time')->get();
            Mail::send(new PaymentConfirmation($this, $lessons));
        } catch (\Exception $e) {
            \Log::warning('Failed to send payment confirmation email: ' . $e->getMessage());
        }
    }
}
