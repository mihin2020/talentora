<div class="row">
    @forelse ($candidatures->sortByDesc('nombre_matchs') as $resultat)

    @if (!$resultat->best_candidate)
    <div class="col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fs-20 card-title">
                    {{ $resultat->firstname ?? 'Prénom non renseigné' }} {{ $resultat->lastname ?? 'Nom non renseigné' }}
                </h4>

                <div class="listline-wrapper mb-4">
                    <span class="item d-block mb-2">
                        <i class="fas fa-envelope me-2 text-muted"></i>
                        {{ $resultat->email ?? 'Email non renseigné' }}
                    </span>
                    <span class="item d-block">
                        <i class="fas fa-phone me-2 text-muted"></i>
                        {{ $resultat->phone ?? 'Téléphone non renseigné' }}
                    </span>
                </div>

                <div class="text-center py-2">
                    <img src="{{ asset('images/entreprise/cv.png') }}" alt="Icône CV" class="img-fluid" style="max-height: 100px;">
                </div>

                <div>
                    <h5 class="fs-16">Mots clés correspondants : {{ $resultat->nombre_matchs }}</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @if (!empty($resultat->matches))
                        @foreach ($resultat->matches as $keyword)
                        <span class="badge bg-success text-white">
                            <i class="fas fa-check-circle me-1"></i>{{ $keyword }}
                        </span>
                        @endforeach

                        <div>
                            <button wire:click="selectCandidate('{{ $resultat->candidature_id ?? $resultat->id ?? '' }}')" type="button" class="btn btn-info light btn-sm mt-2">
                                Selectionner
                            </button>
                        </div>
                        @else
                        <span class="badge bg-danger text-white">
                            <i class="fas fa-times-circle me-1"></i>Aucun mot clé correspondant
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white">
                <div class="d-flex justify-content-center mb-2">
                    @if ($resultat->autre_document && $resultat->autre_document !== 'N/A')
                    <a href="{{ asset('storage/' . $resultat->autre_document) }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-download me-2"></i> Autre document
                    </a>
                    @endif
                    @if ($resultat->cv)
                    <a href="{{ asset('storage/' . $resultat->cv) }}" class="btn btn-primary btn-sm me-2" target="_blank">
                        <i class="fas fa-eye me-2"></i> Voir CV
                    </a>
                    <a href="{{ asset('storage/' . $resultat->cv) }}" download class="btn btn-success btn-sm">
                        <i class="fas fa-download me-2"></i> Télécharger CV
                    </a>
                    @else
                    <span class="btn btn-secondary btn-sm disabled">
                        <i class="fas fa-file-alt me-2"></i> CV non disponible
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center py-4">
            <i class="fas fa-info-circle me-2"></i>
            Aucun candidat trouvé pour cette offre.
        </div>
    </div>
    @endforelse

    
</div>