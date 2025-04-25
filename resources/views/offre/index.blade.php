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
                <h3 class="me-auto">Liste de mes offres</h3>
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
                                    <th>Titre du poste</th>
                                    <th>Date de publication</th>
                                    <th>Date d'expiration</th>
                                    <th>Fichier joint</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($offres as $index => $offre)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $offre->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($offre->publicationDate)->format('d-m-Y') }}</td>
                                    <td class="{{ \Carbon\Carbon::parse($offre->deadline)->isPast() ? 'bg-danger text-primary' : '' }}">
                                        {{ \Carbon\Carbon::parse($offre->deadline)->format('d-m-Y') }}
                                        @if (\Carbon\Carbon::parse($offre->deadline)->isPast())
                                            <span class="badge badge-danger ms-2">Expirée</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($offre->fiche)
                                        <a href="{{ asset('storage/' . $offre->fiche) }}" target="_blank">Voir le fichier</a>
                                        @else
                                        Aucun fichier
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-lg light {{ \Carbon\Carbon::parse($offre->deadline)->isPast() || $offre->status != 'publie' ? 'badge-danger' : 'badge-success' }}">
                                            {{ \Carbon\Carbon::parse($offre->deadline)->isPast() || $offre->status != 'publie' ? 'Brouillon' : 'Publié' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons d-flex justify-content-end">

                                            <a href="{{ route('offre.toggleStatus', $offre->id) }}" class="btn btn-success light mr-2">
                                                @if ($offre->status == 'publie')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 12l2 2l4 -4"></path>
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                                @endif
                                            </a>

                                            {{-- Voir détail --}}
                                            <a href="{{  route('entreprise.offre.show',$offre->id) }}" class="btn btn-success light mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px" height="24px" viewBox="0 0 32 32">
                                                    <g data-name="Layer 21">
                                                        <path d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z" fill="#000000"></path>
                                                        <circle cx="16" cy="16" r="3" fill="#000000"></circle>
                                                    </g>
                                                </svg>
                                            </a>
                                            {{-- Éditer --}}
                                            <a href="{{ route('entreprise.offre.edit',$offre->id) }}" class="btn btn-secondary light mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="svg-main-icon">
                                                    <g stroke="none" fill="none">
                                                        <rect width="24" height="24"></rect>
                                                        <path d="M8,17.91V5.97c0-.4.16-.79.45-1.07l2.52-2.47a1.002,1.002,0,011.42,0l2.49,2.36c.29.27.47.65.47,1.05V17.91c0,.83-.67,1.5-1.5,1.5h-5c-.83,0-1.5-.67-1.5-1.5Z" fill="#000000" transform="rotate(-135 12 10.71)"></path>
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
                                                    </g>
                                                </svg>
                                            </a>
                                            {{-- Supprimer --}}
                                            <form action="{{ route('entreprise.offre.destroy',$offre->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="svg-main-icon">
                                                        <g stroke="none" fill="none">
                                                            <rect width="24" height="24"></rect>
                                                            <path d="M6,8V20.5A1.5,1.5,0,0,0,7.5,22h9A1.5,1.5,0,0,0,18,20.5V8Z" fill="#000000"></path>
                                                            <path d="M14,4.5V4a1,1,0,0,0-1-1H11a1,1,0,0,0-1,1v.5H5.5A.5.5,0,0,0,5,5v.5a.5.5,0,0,0,.5.5H18.5a.5.5,0,0,0,.5-.5V5a.5.5,0,0,0-.5-.5Z" fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune offre disponible.</td>
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