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
            <!-- row -->
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx author-profile m-b30">
                            <div class="card-body">
                                <div class="p-5">
                                    <div class="author-profile">
                                        <div class="author-media">
                                            @php
                                            $photo = Auth::user()->role->name === 'Administrateur'
                                            ? 'images/profile/photo.png'
                                            : (Auth::user()->profile->photo ?? 'images/profile/entreprise.jpg');
                                            @endphp

                                            <img src="{{ asset(Str::startsWith($photo, 'entreprises/') ? 'storage/' . $photo : $photo) }}" alt="Photo de profil">
                                        </div>
                                        <div class="author-info">
                                            <h6 class="title">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h6>
                                            <span>{{Auth::user()->role->name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card  card-bx m-b30">
                        <div class="card-header">
                            <h6 class="title">Editer mon profil</h6>
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
                        @php
                        $user = Auth::user();
                        $isEntreprise = $user->role->name === 'Entreprise';
                        @endphp

                        <form class="profile-form" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">{{ $isEntreprise ? "Nom de l'entreprise" : "Prénom" }}</label>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                            value="{{ old('firstname', $user->firstname) }}" name="firstname">
                                        @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    @unless($isEntreprise)
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Prénom(s)</label>
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                            value="{{ old('lastname', $user->lastname) }}" name="lastname">
                                        @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endunless


                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Téléphone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone) }}" name="phone">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Adresse e-mail</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" name="email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-xl-9 offset-xl-3 col-lg-8 offset-lg-4">
                    <div class="card  card-bx m-b30">
                        <div class="card-header">
                            <h6 class="title">Changer de mot de passe</h6>
                        </div>
                        <form class="profile-form" method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Ancien mot de passe -->
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Ancien Mot de passe</label>
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password"
                                            placeholder="Ancien mot de passe"
                                            required>
                                        @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Nouveau mot de passe -->
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Nouveau Mot de passe</label>
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password"
                                            placeholder="Nouveau mot de passe"
                                            required>
                                        @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Confirmation du mot de passe -->
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Confirmer Mot de passe</label>
                                        <input type="password"
                                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                            name="new_password_confirmation"
                                            placeholder="Confirmez mot de passe"
                                            required>
                                        @error('new_password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @include('admin.components.footer')
    </div>
    @endsection