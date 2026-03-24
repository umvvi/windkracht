<?php

namespace App\Mail;

use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CancellationRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $lesson;
    public $rejectionReason;

    /**
     * Create a new message instance.
     */
    public function __construct(Lesson $lesson, $rejectionReason)
    {
        $this->lesson = $lesson;
        $this->rejectionReason = $rejectionReason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Annulering Afgewezen - Windkracht-12',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cancellation-rejected',
            with: [
                'lesson' => $this->lesson,
                'customerName' => $this->lesson->reservation->customer->personalInformation?->first_name ?? 'Klant',
                'lessonDate' => $this->lesson->start_time->format('d-m-Y H:i'),
                'rejectionReason' => $this->rejectionReason,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
