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
                    <form wire:submit.prevent="save" >
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
                                            <input type="text" class="form-control" id="title" wire:model="title" >
                                            @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Type de contrat -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type_contrat_id" class="form-label">Type de contrat</label>
                                            <select class="form-select" id="type_contrat_id" wire:model="type_contrat_id" required>
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
                                            <select class="form-select" id="localisation" wire:model="localisation" required>
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
                                            <input type="text" class="form-control" id="city" wire:model="city" required>
                                            @error('city') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Salaire -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salaire</label>
                                            <input type="text"  class="form-control" id="salary" wire:model="salaire" required>
                                            @error('salaire') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Date de publication -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="publicationDate" class="form-label">Date de publication</label>
                                            <input type="date" class="form-control" id="publicationDate" wire:model="publicationDate" required>
                                        </div>
                                    </div>

                                    <!-- Date d'expiration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deadline" class="form-label">Date d'expiration</label>
                                            <input type="date" class="form-control" id="deadline" wire:model="deadline" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Description du poste -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description du poste</label>
                                            <!-- <div id="description" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="description-input" wire:model="description"> -->
                                            <textarea class="form-control" wire:model="description" id="" cols="30" rows="10"></textarea>
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
                                            <input type="text" class="form-control" id="language" wire:model="langue" required>
                                            @error('langue') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Compétences -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="skills" class="form-label">Compétences</label>
                                            <!-- <div id="skills" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="skills-input" wire:model="skills"> -->
                                            <textarea class="form-control" wire:model="skills" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- Expérience -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Expérience</label>
                                            <!-- <div id="experience" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="experience-input" wire:model="experience"> -->
                                            <textarea class="form-control" wire:model="experience"id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- Formation -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formation" class="form-label">Formation</label>
                                            <!-- <div id="formation" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="formation-input" wire:model="formation"> -->
                                            <textarea class="form-control" wire:model="formation" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- Mission -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="mission" class="form-label">Mission</label>
                                            <!-- <div id="mission" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="mission-input" wire:model="mission"> -->
                                            <textarea class="form-control" wire:model="mission" id="" cols="30" rows="10"></textarea>
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
                                            <!-- <div id="objective" class="quill-editor" style="height: 250px;"></div>
                                            <input type="hidden" id="objective-input" wire:model="objective"> -->
                                            <textarea class="form-control" wire:model="objective" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Autres informations -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="otherInformation" class="form-label">Autres informations</label>
                                            <textarea class="form-control" id="otherInformation" wire:model="otherInformation" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Document à uploader -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fiche" class="form-label">Document à uploader</label>
                                            <input type="file" class="form-control" id="fiche" wire:model="fiche">
                                        </div>
                                    </div>

                                    <!-- Statut -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Statut</label>
                                            <select class="form-select" id="status" wire:model="status" >
                                                <option value="">-- Sélectionnez le statut --</option>
                                                <option value="brouillon">Brouillon</option>
                                                <option value="publie">Publié</option>
                                            </select>
                                        </div>
                                    </div>
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

   