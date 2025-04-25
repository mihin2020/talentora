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
            <div class="d-flex align-items-center mb-4">
                <h3 class="me-auto">Détails de l'entreprise </h3>
                <div>
                    <a href="mailto:{{ $entreprise->email }}" class="btn btn-secondary btn-sm me-3"> 
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 flex-wrap align-items-start">
                            <div class="col-md-8 ">
                                <div class="user d-sm-flex d-block pe-md-5 pe-0">
                                    <img src="{{ $entreprise->profile && $entreprise->profile->photo ? asset('storage/' . $entreprise->profile->photo) : asset('images/profile/entreprise.jpg') }}"
                                        alt="Logo Entreprise" width="80" class="rounded-circle me-3">
                                    <div class="ms-sm-3 ms-0 me-md-5 md-0">
                                        <h5 class="mb-1 font-w600">
                                            <a href="javascript:void(0);" class="text-black">
                                                {{ $entreprise->firstname }}
                                            </a>
                                        </h5>
                                        <div class="listline-wrapper mb-2">
                                            <span class="item">
                                                <i class="text-primary far fa-envelope"></i>
                                                {{ $entreprise->email }}
                                            </span>
                                            <span class="item ms-3">
                                                <i class="text-primary fas fa-phone-alt"></i>
                                                {{ $entreprise->phone }}
                                            </span>
                                        </div>
                                        <p class="fw-bold">{{ $entreprise->profile->secteur_activite ?? 'Non défini' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <h4 class="fs-20">Description</h4>
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <p class="font-w600 mb-2 d-flex">
                                        <span class="font-w400">
                                            {{ $entreprise->profile->description ?? 'Aucune description fournie.' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center">
                            <div class="mb-md-2 mb-3 exp-del">
                                <span class="d-block mb-1">
                                    <i class="fas fa-circle me-2"></i>
                                    Date d'inscription :
                                    <strong>{{ $entreprise->created_at->format('d/m/Y') }}</strong>
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                @can('access-entreprise')
                                <form action="{{ route('entreprise.toggleStatus', $entreprise->id) }}" method="POST" class="me-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm {{ $entreprise->statut ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ $entreprise->statut ? 'Actif' : 'Inactif' }}
                                    </button>
                                </form>
                                @endcan
                                <a href="{{ route('entreprise.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Retour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection