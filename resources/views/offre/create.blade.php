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
                    <form action="{{ route('entreprise.offre.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Section 1: Informations générales -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Informations générales</h4>
                                <div>
                                    NB : Les champs marqués d'un astérisque (<span class="text-danger">*</span>) sont obligatoires.
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Titre du poste -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre du poste <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title" require>
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
                                                <option value="{{ $typeContrat->id }}">{{ $typeContrat->name }}</option>
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
                                                <option value="teletravail">Télétravail</option>
                                                <option value="presentiel">Présentiel</option>
                                                <option value="hybride">Hybride</option>
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
                                            <input type="text" class="form-control" id="city" name="city" required>
                                            @error('city') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Salaire -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salaire</label>
                                            <input type="text" class="form-control" id="salary" name="salaire" >
                                            @error('salaire') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Date de publication -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="publicationDate" class="form-label">Date de publication <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="publicationDate" name="publicationDate" required>
                                        </div>
                                    </div>

                                    <!-- Date d'expiration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deadline" class="form-label">Date d'expiration <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Description du poste -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description du poste <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" require></textarea>
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
                                            <input type="text" class="form-control" id="language" name="langue" >
                                            @error('langue') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Compétences -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Compétences <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="skills" id="skills" cols="30" rows="10" require></textarea>
                                        </div>
                                    </div>

                                    <!-- Expérience -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Expérience</label>
                                            <textarea class="form-control" name="experience" id="experience" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- Formation -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formation" class="form-label">Formation <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="formation" id="formation" cols="30" rows="10" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Mission -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="mission" class="form-label">Mission</label>
                                            <textarea class="form-control" name="mission" id="mission" cols="30" rows="10"></textarea>
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
                                    <!-- Objectif -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="objective" class="form-label">Objectif</label>
                                            <textarea class="form-control" name="objective" id="objective" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Autres informations -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="otherInformation" class="form-label">Autres informations</label>
                                            <textarea class="form-control" id="otherInformation" name="otherInformation" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Document à uploader -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fiche" class="form-label">Document à joindre</label>
                                            <input type="file" class="form-control" id="fiche" name="fiche">
                                        </div>
                                    </div>

                                    <!-- Statut -->
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Statut</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="">-- Sélectionnez le statut --</option>
                                                <option value="brouillon">Brouillon</option>
                                                <option value="publie">Publié</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
