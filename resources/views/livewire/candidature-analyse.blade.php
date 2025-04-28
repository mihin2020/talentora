<div>
    <div>
        @if($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
        @endif

        <div>
            <form wire:submit.prevent="analyseCvs">
                <div class="mb-3">
                    <label for="prompt" class="form-label">Votre prompt :</label>
                    <textarea wire:model="prompt" id="prompt" class="form-control" rows="6" placeholder="Décrivez le profil recherché..."></textarea>
                    @error('prompt') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" @if($candidatures->isEmpty()) disabled @endif>
                    <span wire:loading wire:target="analyseCvs" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Rechercher
                </button>
            </form>
        </div>

        @if($analysisResults && $analysisResults['success'])

        <div class="mt-4 p-4 bg-white rounded shadow-sm border-left border-primary">
            <h4 class="h5 mb-3 text-primary">Résultats de l'analyse</h4>
            <p><strong>Critère recherché :</strong> {{ $analysisResults['prompt'] }}</p>

            <div class="analysis-result p-3 bg-white border rounded" style="background-color: #f8f9fa;">
                {!! nl2br(e($analysisResults['analysis'])) !!}
            </div>
        </div>

        {{-- ✅ Liste des candidatures à afficher uniquement si analyse réussie --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Liste des candidatures pour cette offre <br>
                            NB : Veuillez chercher le ou les candidats correspondants aux résultats ci-dessus et procéder à la sélection.
                            <a href="{{ route('candidatures.selectionne') }}" class="btn btn-primary">
                                Candidats sélectionnés</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Fichier</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($candidatures as $candidature)
                                    <tr>
                                        <td>{{ $candidature->user->lastname ?? 'N/A' }}</td>
                                        <td>{{ $candidature->user->firstname ?? 'N/A' }}</td>
                                        <td>{{ $candidature->user->email ?? 'N/A' }}</td>
                                        <td>{{ $candidature->user->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if($candidature->cv)
                                            <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank" class="btn btn-sm btn-primary">Voir le CV</a>
                                            @else
                                            N/A
                                            @endif

                                            @if($candidature->autre_document)
                                            <a href="{{ asset('storage/' . $candidature->autre_document) }}" target="_blank" class="btn btn-sm btn-secondary">Voir l'autre document</a>
                                            @else
                                            Aucun fichier joint
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('candidatures.candidateSelectionne', $candidature->id) }}"
                                                class="btn btn-info light btn-sm mt-2"
                                                onclick="return confirm('Êtes-vous sûr de vouloir sélectionner ce candidat ?')">
                                                Sélectionner
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col-12 -->
        </div> <!-- row -->

        @endif

    </div>
</div>