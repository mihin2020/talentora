<?php


namespace App\Livewire;

use App\Models\Candidature;
use Livewire\Component;
use App\Models\Offre;

class ViewSelectedCandidates extends Component
{
    public $offreId;
    public $showModal = false;
    public $candidates = [];
    public $offreTitle; 

    public function mount($offreId)
    {
        $this->offreId = $offreId;
    }

    public function loadCandidates()
    {
        $offre = Offre::with(['candidatures' => function($query) {
            $query->where('best_candidate', true)
                  ->with('user'); // Assurez-vous que la relation user existe
        }])->find($this->offreId);

        $this->offreTitle = $offre->title;
        $this->candidates = $offre->candidatures->map(function($candidature) {
            return [
                'firstname' => $candidature->user->firstname,
                'lastname' => $candidature->user->lastname,
                'email' => $candidature->user->email,
                'phone' => $candidature->user->phone,
            ];
        });

        $this->showModal = true;
    }

//     public function loadCandidates()
// {
//     $offre = Offre::find($this->offreId);

//     if (!$offre) {
//         $this->offreTitle = 'Offre introuvable';
//         $this->candidates = [];
//         return;
//     }

//     // Filtrer uniquement les candidatures liées à CETTE offre et sélectionnées
//     $candidatures = Candidature::where('offre_id', $offre->id)
//         ->where('best_candidate', true)
//         ->with('user')
//         ->get();

//     $this->offreTitle = $offre->title;

//     $this->candidates = $candidatures->map(function($candidature) {
//         return [
//             'firstname' => $candidature->user->firstname,
//             'lastname' => $candidature->user->lastname,
//             'email' => $candidature->user->email,
//             'phone' => $candidature->user->phone,
//         ];
//     });

//     $this->showModal = true;
// }


    public function render()
    {
        return view('livewire.view-selected-candidates');
    }
}