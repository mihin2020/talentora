<?php

namespace App\Livewire\Entreprise;

use App\Models\Offre;
use App\Models\TypeContrat;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Component;

class OffreEmploi extends Component
{
    use WithFileUploads;

    public $title, $type_contrat_id, $localisation, $city, $salaire;
    public $publicationDate, $deadline, $description, $langue;
    public $skills, $experience, $formation, $mission, $objective, $otherInformation;
    public $fiche, $status;


    public function save()
    {
      
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'type_contrat_id' => 'required|exists:type_contrats,id',
            'localisation' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'salaire' => 'nullable|string',
            'publicationDate' => 'required|date',
            'deadline' => 'required|date|after_or_equal:publicationDate',
            'description' => 'required|string',
            'langue' => 'required|string|max:255',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'formation' => 'nullable|string',
            'mission' => 'nullable|string',
            'objective' => 'nullable|string',
            'otherInformation' => 'nullable|string',
            'status' => 'required|in:brouillon,publie',
            'fiche' => 'nullable|file|mimes:pdf,doc,docx|max:2048',  // Validation du fichier
            // Fichier uploadé
            // Ajoutez la validation pour le fichier ici si nécessaire
        ]);
       
        DB::beginTransaction();

        try {
            // Gestion du fichier uploadé
            $fichePath = null;
            if ($this->fiche) {
                $fichePath = $this->fiche->store('offre', 'public');
            }

            // Création de l'offre
            Offre::create([
                'title' => $this->title,
                'type_contrat_id' => $this->type_contrat_id,
                'localisation' => $this->localisation,
                'city' => $this->city,
                'salaire' => $this->salaire,
                'publicationDate' => $this->publicationDate,
                'deadline' => $this->deadline,
                'description' => $this->description,
                'langue' => $this->langue,
                'skills' => $this->skills,
                'experience' => $this->experience,
                'formation' => $this->formation,
                'mission' => $this->mission,
                'objective' => $this->objective,
                'otherInformation' => $this->otherInformation,
                'status' => $this->status,
                'fiche' => $fichePath,
                'user_id' => auth()->id(),
            ]);

            DB::commit();

            session()->flash('success', 'Offre créée avec succès !');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.entreprise.offre-emploi', [
            'typeContrats' => TypeContrat::all()
        ])->layout('admin.layouts.main');
    }
}
