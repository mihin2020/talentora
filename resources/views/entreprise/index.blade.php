@extends('admin.layouts.main')
@section('content')
<div id="main-wrapper">
    <div class="nav-header">
        @include('admin.components.logo')
        @include('admin.components.header')
    </div>
    @include('admin.components.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            @can('is-admin')
                            <h4 class="card-title">Information sur l'entreprise</h4>
                            @endcan
                            @can('access-entreprise')
                            <h4 class="card-title">Liste des entreprises</h4>
                            @endcan
                        </div>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nom de l'entreprise</th>
                                            <th>Email </th>
                                            <th>Téléphone</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entreprises as $entreprise)
                                        <tr>
                                            <td>
                                                <img class="rounded-circle" width="100" height="100%"
                                                    src="{{ $entreprise->profile && $entreprise->profile->photo 
                                                    ? asset('storage/' . $entreprise->profile->photo) 
                                                    : asset('images/profile/entreprise.jpg') }}"
                                                    alt="photo">

                                            </td>
                                            <td>{{ $entreprise->firstname }} {{ $entreprise->lastname }}</td>
                                            <td>{{ $entreprise->email }}</td>
                                            <td>{{ $entreprise->phone }}</td>
                                            <td>
                                                <span class="badge light {{ $entreprise->statut ? 'badge-success' : 'badge-danger' }}">
                                                    <i class="fa fa-circle {{ $entreprise->statut ? 'text-success' : 'text-danger' }} me-1"></i>
                                                    {{ $entreprise->statut ? 'Activé' : 'Désactivé' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    {{-- Voir --}}
                                                    <a href="{{ route('entreprise.show', $entreprise->id) }}" class="btn btn-info shadow btn-xs sharp me-1" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    {{-- Modifier --}}
                                                    <a href="{{ route('entreprise.edit', $entreprise->id) }}" class="btn btn-primary shadow btn-xs sharp me-1" title="Modifier">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    {{-- Activer / Désactiver --}}
                                                    @if (Auth::user()->role->name !== 'Entreprise')
                                                    <form action="{{ route('entreprise.toggleStatus', $entreprise->id) }}" method="POST" class="me-1">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning shadow btn-xs sharp" title="{{ $entreprise->statut ? 'Désactiver' : 'Activer' }}">
                                                            <i class="fa {{ $entreprise->statut ? 'fa-ban' : 'fa-check' }}"></i>
                                                        </button>
                                                    </form>

                                                    {{-- Supprimer --}}
                                                    <form action="{{ route('entreprise.destroy', $entreprise->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger shadow btn-xs sharp" title="Supprimer">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection