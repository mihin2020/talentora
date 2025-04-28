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
            <div class="d-flex align-items-center mb-4 flex-wrap">
                <h3 class="me-auto">Liste des candidatures par offre</h3>
                <div>
                    <a href="{{ route('entreprise.offre.create') }}" class="btn btn-primary me-3 btn-sm"><i class="fas fa-plus me-2"></i>Créer une offre</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <strong>yeah !</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table display mb-4 dataTablesCard job-table table-responsive-xl card-table" id="example5">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nombre de candidatures</th>
                                    <th>Titre du poste</th>
                                    <th>Date de publication</th>
                                    <th>Date d'expiration</th>

                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($offres as $key => $offre)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <span class="badge badge-primary">{{ $offre->candidatures_count }} candidatures</span>
                                    </td>
                                    <td>{{ $offre->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($offre->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($offre->deadline)->format('d/m/Y') }}
                                        @if (\Carbon\Carbon::parse($offre->deadline)->isPast())
                                        <span class="badge badge-danger ms-2">Expirée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-lg light {{ \Carbon\Carbon::parse($offre->deadline)->isPast() || $offre->status != 'publie' ? 'badge-danger' : 'badge-success' }}">
                                            {{ \Carbon\Carbon::parse($offre->deadline)->isPast() || $offre->status != 'publie' ? 'Brouillon' : 'Publié' }}
                                        </span>
                                    </td>
                                    <td>
                                    <div class="d-flex">
    @php
        $hasKeywords = false;
        if ($offre->searchKeywords && is_array($offre->searchKeywords->keyword)) {
            $hasKeywords = count(array_filter($offre->searchKeywords->keyword)) > 0;
        }
    @endphp

    @if ($offre->candidatures_count > 0 && $hasKeywords)
        <a href="{{ route('candidature.analyserCvs', ['offreId' => $offre->id]) }}" class="btn btn-dark me-2">
            Filtrer les candidatures
        </a>
    @else
        <button class="btn btn-dark me-2" disabled>
            Filtrer les candidatures 
            @if($offre->candidatures_count == 0)
                (Aucune candidature)
            @elseif(!$hasKeywords)
                (Aucun mot-clé)
            @endif
        </button>
    @endif

    <a href="{{ route('candidatures.avance', ['offreId' => $offre->id]) }}" class="btn btn-primary">
        Recherche avancée
    </a>
</div>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune offre trouvée.</td>
                                </tr>
                                @endforelse
                            </tbody>


                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection