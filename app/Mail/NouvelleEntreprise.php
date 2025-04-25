<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleEntreprise extends Mailable
{
    use Queueable, SerializesModels;

    public User $entreprise;

    /**
     * Create a new message instance.
     */
    public function __construct(User $entreprise)
    {
        $this->entreprise = $entreprise;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle demande d’inscription d’une entreprise',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.nouvelle_entreprise',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
