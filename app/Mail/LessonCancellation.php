<?php

namespace App\Mail;

use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LessonCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $lesson;
    public $cancellationType;
    public $cancellationReason;
    public $instructorName;

    /**
     * Create a new message instance.
     */
    public function __construct(Lesson $lesson, $cancellationType, $cancellationReason, $instructorName)
    {
        $this->lesson = $lesson;
        $this->cancellationType = $cancellationType;
        $this->cancellationReason = $cancellationReason;
        $this->instructorName = $instructorName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Les Geannuleerd - Windkracht-12 Kitesurfschool',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lesson-cancellation',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
