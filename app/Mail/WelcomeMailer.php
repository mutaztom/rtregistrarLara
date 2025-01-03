<?php

namespace App\Mail;

use App\Models\Tblregistrant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMailer extends Mailable
{
    use Queueable, SerializesModels;

    protected Tblregistrant $registrant;

    /**
     * Create a new message instance.
     */
    public function __construct(Tblregistrant $reg)
    {
        $this->registrant = $reg;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->registrant->email,
            subject: 'Welcome To Engineering Council',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            //view: 'emails.signup',
            text: 'emails.signup-txt',
            with: [
                'registrant' => $this->registrant,
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
