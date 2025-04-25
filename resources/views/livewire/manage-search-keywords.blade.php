<div class="card">
    <div class="card-header">
        <p class="text-muted small mb-0">Ajoutez des mots-clés pour améliorer la recherche</p>
    </div>

    <div class="card-body">
        <div class="form-group">
            <label for="newKeyword">Nouveau mot-clé</label>
            <div class="input-group mb-3">
                <input 
                    type="text" 
                    id="newKeyword" 
                    class="form-control" 
                    wire:model.defer="newKeyword"
                    wire:keydown.enter.prevent="addKeyword"
                    placeholder="Saisissez un mot-clé"
                >
                <button 
                    class="btn btn-primary" 
                    wire:click="addKeyword" 
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Ajouter</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                    </span>
                </button>
            </div>
            @error('newKeyword') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @if($searchKeyword && is_array($searchKeyword->keyword) && count($searchKeyword->keyword) > 0)
    <div class="mt-4">
        <h5>Mots-clés actuels</h5>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach($searchKeyword->keyword as $index => $singleKeyword)
                <div class="badge bg-secondary d-flex align-items-center" style="padding: 0.5rem 1rem;">
                    <span>{{ $singleKeyword }}</span>
                    <button 
                        type="button" 
                        class="btn-close btn-close-white ms-2" 
                        wire:click="removeKeyword({{ $index }})"
                        aria-label="Supprimer"
                    ></button>
                </div>
            @endforeach
        </div>
    </div>
@endif



    </div>
</div>
