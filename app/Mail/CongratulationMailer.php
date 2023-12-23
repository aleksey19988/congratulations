<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use MailerSend\Exceptions\MailerSendAssertException;
use MailerSend\LaravelDriver\MailerSendTrait;

class CongratulationMailer extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    protected string $employeeName;
    protected string $body;

    /**
     * Create a new message instance.
     */
    public function __construct(string $employeeName, string $subject, string $body)
    {
        $this->employeeName = $employeeName;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     * @throws MailerSendAssertException
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailer.body-html',
            with: [
                'body' => $this->body,
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
        return [
//            Attachment::fromStorageDisk('public', 'example.png')
        ];
    }
}
