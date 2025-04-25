<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactCandidatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $pieceJointePath;
    public $originalFileName;

    public function __construct($messageContent, $pieceJointePath = null, $originalFileName = null)
    {
        $this->messageContent = $messageContent;
        $this->pieceJointePath = $pieceJointePath;
        $this->originalFileName = $originalFileName;
    }

    public function build()
    {
        $email = $this->subject('Message de l\'entreprise')
                      ->view('emails.contact-candidat')
                      ->with([
                          'messageContent' => $this->messageContent,
                      ]);
        
        // Vérifie que la pièce jointe est présente et ajoute le nom original du fichier
        if ($this->pieceJointePath) {
            $email->attach(public_path('storage/' . $this->pieceJointePath), [
                'as' => $this->originalFileName,  // Utilisation du vrai nom du fichier
            ]);
        }

        return $email;
    }
}
