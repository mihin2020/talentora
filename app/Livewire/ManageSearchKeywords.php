<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Offre;
use App\Models\SearchKeyword;

class ManageSearchKeywords extends Component
{
    public $offre;
    public $newKeyword = '';

    protected $rules = [
        'newKeyword' => 'required|min:2|max:50',
    ];

    public function mount(Offre $offre)
    {
        $this->offre = $offre;
    }

    public function addKeyword()
    {
        $this->validate();

        $record = SearchKeyword::firstOrCreate(
            ['offre_id' => $this->offre->id],
            ['keyword' => []] // valeur par défaut
        );

        $keywords = $record->keyword ?? [];

        // Vérifier si le mot-clé existe déjà
        if (in_array($this->newKeyword, $keywords)) {
            $this->addError('newKeyword', 'Ce mot-clé existe déjà.');
            return;
        }

        // Ajouter le nouveau mot-clé
        $keywords[] = $this->newKeyword;
        $record->keyword = $keywords;
        $record->save();

        $this->newKeyword = '';
    }

    public function removeKeyword($index)
{
    $searchKeyword = SearchKeyword::where('offre_id', $this->offre->id)->first();

    if ($searchKeyword && isset($searchKeyword->keyword[$index])) {
        $keywords = $searchKeyword->keyword;
        unset($keywords[$index]);
        $searchKeyword->keyword = array_values($keywords); // Re-index le tableau proprement
        $searchKeyword->save();
    }
}

    

    public function render()
{
    $searchKeyword = SearchKeyword::where('offre_id', $this->offre->id)->first();

    return view('livewire.manage-search-keywords', [
        'searchKeyword' => $searchKeyword,
    ]);
}
}


