<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidature;

class CandidatureSelection extends Component
{
    public $candidatures;
    
    public function mount($candidatures)
    {
        $this->candidatures = $candidatures;
    }
    
    // public function selectCandidate($candidateId)
    // {
    //     // Trouver la candidature
    //     $candidature = Candidature::find($candidateId);
        
    //     if ($candidature) {
    //         // Mettre à jour le statut best_candidate
    //         $candidature->update(['best_candidate' => true]);
            
    //         // Rafraîchir les données
    //         $this->candidatures = $this->candidatures->fresh();
    //     }
    // }

    public function selectCandidate($candidateId)
    {
        try {
            // Mise à jour en base
            $updated = Candidature::where('id', $candidateId)
                          ->update(['best_candidate' => true]);
            
            if ($updated) {
                // Mise à jour locale de la collection
                $this->candidatures = $this->candidatures->map(function ($item) use ($candidateId) {
                    // Plusieurs façons d'accéder à l'ID selon la structure
                    $currentId = $item->id ?? $item->candidature_id ?? null;
                    
                    if ($currentId == $candidateId) {
                        $item->best_candidate = true;
                    }
                    return $item;
                });
            }
        } catch (\Exception $e) {
            // Gérer l'erreur (optionnel)
            $this->dispatch('error', message: "Erreur lors de la sélection");
        }
    }
    
    public function render()
    {
        return view('livewire.candidature-selection');
    }
}