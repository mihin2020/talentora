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
                <h3 class="me-auto">Liste des candidatures sélectionnées par offre</h3>
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
                                    <th>Candidatures sélectionnées</th>
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
                                        <span class="badge badge-primary">{{ $offre->selected_candidatures_count }} candidatures</span>
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
                                        <div class="d-flex align-items-center">
                                            @livewire('view-selected-candidates', ['offreId' => $offre->id], key($offre->id))
                                            <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#contactModal" wire:click="$emit('setOffre', {{ $offre->id }})">
                                                <i class="fas fa-envelope me-2"></i>
                                            </button>
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

        @livewire('contact-candidats')
    </div>
    @endsection