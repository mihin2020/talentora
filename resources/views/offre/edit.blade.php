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
                <div class="col-md-12">


                    <form action="{{ route('entreprise.offre.update', $offre->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Section 1: Informations générales -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Informations générales</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Titre du poste -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre du poste</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $offre->title) }}">
                                            @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Type de contrat -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type_contrat_id" class="form-label">Type de contrat</label>
                                            <select class="form-select" id="type_contrat_id" name="type_contrat_id" required>
                                                <option value="">-- Sélectionnez un type de contrat --</option>
                                                @foreach ($typeContrats as $typeContrat)
                                                <option value="{{ $typeContrat->id }}" {{ old('type_contrat_id', $offre->type_contrat_id) == $typeContrat->id ? 'selected' : '' }}>
                                                    {{ $typeContrat->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('type_contrat_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Lieu de travail -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="localisation" class="form-label">Lieu de travail</label>
                                            <select class="form-select" id="localisation" name="localisation" required>
                                                <option value="">-- Sélectionnez le lieu de travail --</option>
                                                <option value="teletravail" {{ old('localisation', $offre->localisation) == 'teletravail' ? 'selected' : '' }}>Télétravail</option>
                                                <option value="presentiel" {{ old('localisation', $offre->localisation) == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                                                <option value="hybride" {{ old('localisation', $offre->localisation) == 'hybride' ? 'selected' : '' }}>Hybride</option>
                                            </select>
                                            @error('localisation') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Pays/Ville -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Pays/ville</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $offre->city) }}" required>
                                            @error('city') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Salaire -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salaire</label>
                                            <input type="text" class="form-control" id="salary" name="salaire" value="{{ old('salaire', $offre->salaire) }}" >
                                            @error('salaire') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Date de publication -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="publicationDate" class="form-label">Date de publication</label>
                                            <input type="date" class="form-control" id="publicationDate" name="publicationDate" value="{{ old('publicationDate', $offre->publicationDate ? \Carbon\Carbon::parse($offre->publicationDate)->format('Y-m-d') : '') }}" required>
                                        </div>
                                    </div>

                                    <!-- Date d'expiration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deadline" class="form-label">Date d'expiration</label>
                                            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $offre->deadline->format('Y-m-d')) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Description du poste -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description du poste</label>
                                            <textarea class="form-control" name="description" cols="30" rows="5">{{ old('description', $offre->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Compétences et qualifications -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Compétences et qualifications</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Langue -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="language" class="form-label">Langue</label>
                                            <input type="text" class="form-control" id="language" name="langue" value="{{ old('langue', $offre->langue) }}" >
                                            @error('langue') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Compétences -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Compétences</label>
                                            <textarea class="form-control" name="skills" cols="30" rows="10">{{ old('skills', $offre->skills) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Expérience -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Expérience</label>
                                            <textarea class="form-control" name="experience" cols="30" rows="10">{{ old('experience', $offre->experience) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Formation -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formation" class="form-label">Formation</label>
                                            <textarea class="form-control" name="formation" cols="30" rows="10">{{ old('formation', $offre->formation) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Mission -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="mission" class="form-label">Mission</label>
                                            <textarea class="form-control" name="mission"cols="30" rows="10">{{ old('mission', $offre->mission) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Responsabilités -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Responsabilités</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                        <label for="objective" class="form-label">Objectifs</label>
                                            <textarea class="form-control" name="objective" cols="30" rows="10">{{ old('objective', $offre->objective) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Autres informations -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="otherInformation" class="form-label">Autres informations</label>
                                            <textarea class="form-control" id="otherInformation" name="otherInformation" cols="30" rows="10">{{ old('otherInformation', $offre->otherInformation) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Section 4: Pièces jointes -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Pièces jointes</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Optionnel pour fichier -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Fichier joint (optionnel)</label>
                                            <input type="file" class="form-control" id="file" name="file">
                                            @if ($offre->fiche)
                                            <p class="mt-2 fw-bold text-secondary fs-5">Fichier actuel : <a href="{{ asset('storage/' . $offre->fiche) }}" target="_blank">Télécharger</a></p>
                                            @endif
                                            @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary">Mettre à jour l'offre</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @endsection