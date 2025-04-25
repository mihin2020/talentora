<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienvenueEntreprise extends Mailable
{
    use Queueable, SerializesModels;

    public User $entreprise;
    public string $password;

    /**
     * Create a new message instance.
     */
    public function __construct(User $entreprise, string $password)
    {
        $this->entreprise = $entreprise;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur notre plateforme',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bienvenue_entreprise',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
