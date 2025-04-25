@extends('admin.layouts.main')
@section('content')
<div id="main-wrapper">
    <div class="nav-header">
        @include('admin.components.logo')
        @include('admin.components.header')
    </div>
    @include('admin.components.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-8 col-xxl-8 col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-block">
                                    <h4 class="fs-20 d-block"><a href="#" class="text-black">{{ $offre->title }}</a></h4>
                                    <div class="d-block">
                                        <span class="me-2"><a href="#"><i class="text-primary fas fa-briefcase me-2"></i>{{ $offre->contrat->name }}</a></span>
                                        <span class="me-2">
                                            <a href="#">
                                                <i class="text-primary fas fa-map-marker-alt me-2"></i>
                                                {{ $offre->city ?? '<span class="badge bg-primary">Non renseigné</span>' }}
                                                {{ $offre->localisation ?? '<span class="badge bg-primary">Non renseigné</span>' }}
                                            </a>
                                        </span>
                                        <span class="me-2">
                                            <a href="#">
                                                <i class="text-primary fas fa-dollar-sign me-2"></i>
                                                {{ $offre->salaire ?? '<span class="badge bg-primary">Non renseigné</span>' }}
                                            </a>
                                        </span>
                                        <span class="me-2">
                                            <a href="#">
                                                <i class="text-primary fas fa-language me-2"></i>
                                                {{ $offre->langue ?? '<span class="badge bg-primary">Non renseigné</span>' }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <h4 class="fs-20 mb-3">Description du poste</h4>
                                    <div>
                                        <p>
                                            {!! $offre->description !!}
                                        </p>
                                    </div>
                                    <hr>
                                    <h4 class="fs-20 mb-3">Compétences</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->skills ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>
                                    <hr>
                                    <h4 class="fs-20 mb-3">Expériences</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->experience ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>
                                    <hr>
                                    <h4 class="fs-20 mb-3">Formations</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->formation ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>
                                    <hr>
                                    <h4 class="fs-20 mb-3">Missions</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->mission ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>

                                    <hr>
                                    <h4 class="fs-20 mb-3">Objectifs</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->objective ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>

                                    <hr>
                                    <h4 class="fs-20 mb-3">Autres Informations</h4>
                                    <div class="row mb-3">
                                        <p>
                                            {!! $offre->otherInformation ?? '<span class="badge bg-primary">Non renseigné</span>' !!}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between py-4 border-bottom border-top flex-wrap">
                                        <a href="{{ $offre->fiche ? asset('storage/' . $offre->fiche) : 'javascript:void(0);' }}"
                                            target="{{ $offre->fiche ? '_blank' : '_self' }}"
                                            class="btn btn-primary btn-sm me-2 {{ $offre->fiche ? '' : 'disabled' }}">
                                            <i class="far fa-check-circle me-2"></i>
                                            {{ $offre->fiche ? 'Voir le fichier joint' : 'Fichier Non renseigné' }}
                                        </a>
                                        <span class="fw-bold">Créer le {{ $offre->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex align-items-center">
                                        <button class="btn {{ $offre->status === 'publie' ? 'btn-secondary' : 'btn-dark' }} btn-sm me-3">
                                            <i class="{{ $offre->status === 'publie' ? 'fas fa-check-circle me-2' : 'fas fa-pencil-alt me-2' }}"></i>
                                            {{ $offre->status === 'publie' ? 'Publié' : 'Brouillon' }}
                                        </button>
                                        <input type="text" id="offerLink" value="{{ $offre->link }}" class="border rounded px-3 py-2 flex-grow-1 me-3" readonly>
                                        <button onclick="copyLink()" class="btn btn-dark px-4 py-2">
                                            Copier le lien
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-4">
                    <div class="card">
                        <livewire:manage-search-keywords :offre="$offre" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection



<script>
    function copyLink() {
        const copyText = document.getElementById("offerLink");
        copyText.select();
        document.execCommand("copy");
        alert("Lien copié !");
    }
</script>