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
                            <h4 class="card-title">Editer les informations d'une entreprise</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('entreprise.update', $entreprise->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Affichage de l'image actuelle --}}
                                @if($entreprise->profile && $entreprise->profile->photo)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $entreprise->profile->photo) }}" alt="Photo entreprise" width="150" class="rounded mb-2">
                                </div>
                                @endif

                                {{-- Upload nouvelle image --}}
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Changer la photo</label>
                                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nom de l'entreprise</label>
                                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname', $entreprise->firstname) }}" required>
                                    @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $entreprise->phone) }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Secteur d'activité</label>
                                    <input type="text" name="secteur_activite" class="form-control @error('secteur_activite') is-invalid @enderror" value="{{ old('secteur_activite', $entreprise->profile->secteur_activite ?? '') }}">
                                    @error('secteur_activite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $entreprise->profile->description ?? '') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                <a href="{{ route('entreprise.index') }}" class="btn btn-secondary">Annuler</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection