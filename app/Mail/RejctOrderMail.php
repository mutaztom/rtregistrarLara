<?php

namespace App\Mail;

use App\Models\Tblregisterrequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejctOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Tblregisterrequest $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Tblregisterrequest $regreq)
    {
        //
        $this->order = $regreq;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Order Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'emails.rejected-txt',
            with: [
                'order' => $this->order,
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
