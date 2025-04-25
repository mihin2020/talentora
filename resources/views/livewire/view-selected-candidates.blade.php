<div>
    <!-- Bouton pour ouvrir le modal -->
    <button wire:click="loadCandidates" class="btn btn-dark ">
        <i class="fas fa-eye"></i>
    </button>

    
    <!-- Modal - Maintenant englobé dans le même div parent -->
    @if($showModal)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Candidats sélectionnés pour: {{ $offreTitle }}</h5>
                       
                    </div>
                    <div class="modal-body">
                        @if(count($candidates) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($candidates as $candidate)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $candidate['lastname'] }}</td>
                                                <td>{{ $candidate['firstname'] }}</td>
                                                <td>{{ $candidate['email'] }}</td>
                                                <td>{{ $candidate['phone'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Aucun candidat sélectionné pour cette offre.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>