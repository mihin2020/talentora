<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Candidature;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactCandidatMail;

class ContactCandidats extends Component
{
    use WithFileUploads;

    public $offreId;
    public $candidats = [];
    public $selectedCandidats = [];
    public $message;
    public $pieceJointe;
    public $selectAll = false;
    public $loading = false; 

    protected $rules = [
        'selectedCandidats' => 'required|array|min:1',
        'message' => 'required|string',
        'pieceJointe' => 'nullable|file|max:2048',
    ];

    public function mount($offreId = null)
    {
        $this->offreId = $offreId;
    
        // Ne prendre que les candidatures sélectionnées pour cette offre précise
        $this->candidats = Candidature::where('best_candidate', true)
            ->where('offre_id', $this->offreId)
            ->with('user')
            ->get();
    }
    

    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedCandidats = [];
            $this->selectAll = false;
        } else {
            $this->selectedCandidats = $this->candidats->pluck('id')->toArray();
            $this->selectAll = true;
        }
    }

    
    public function sendEmail()
    {
        $this->validate();
    
        try {
            foreach ($this->selectedCandidats as $candidatId) {
                $candidat = Candidature::findOrFail($candidatId);
    
                $originalFileName = null;
                $pieceJointePath = null;
    
                if ($this->pieceJointe) {
                    // Récupère le nom original du fichier
                    $originalFileName = $this->pieceJointe->getClientOriginalName();
    
                    // Stocke la pièce jointe avec son nom original dans le dossier 'public/pieces_jointes'
                    $pieceJointePath = $this->pieceJointe->storeAs('pieces_jointes', $originalFileName, 'public');
                }
    
                // Envoie l'email avec la pièce jointe (ou sans si null)
                Mail::to($candidat->user->email)->send(
                    new ContactCandidatMail($this->message, $pieceJointePath, $originalFileName)
                );
            }
    
            // ✅ Message de succès après l'envoi de tous les emails
            session()->flash('success', 'Les emails ont été envoyés avec succès.');
    
        } catch (\Exception $e) {
            // 🚫 Message d'erreur
            session()->flash('error', 'Erreur lors de l\'envoi des emails : ' . $e->getMessage());
        }
    }
    

    


    public function render()
    {
        return view('livewire.contact-candidats');
    }
}
