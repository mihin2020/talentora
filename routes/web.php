<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Candidat\CandidatController;
use App\Http\Controllers\Entreprise\EntrepriseController;
use App\Http\Controllers\Entreprise\OffreController;
use App\Http\Controllers\Profile\ProfileController;
use App\Livewire\Entreprise\OffreEmploi;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedController::class, 'store'])->name('login.authenticate');
});
Route::get('/guest/entreprise/inscription', [EntrepriseController::class, 'addEntreprise'])->name('entreprise.addEntreprise');
Route::post('/entreprise/inscription', [EntrepriseController::class, 'storeEntreprise'])->name('entreprise.storeEntreprise');
Route::get('/offres/{idSlug}', [OffreController::class, 'share'])->name('entreprise.offre.share');
Route::post('/postuler/{offre_id}', [CandidatController::class, 'postuler'])->name('candidature.postuler');
Route::post('/inscrire', [CandidatController::class, 'inscrireEtPostuler'])->name('candidature.inscrire');
Route::get('/offres/telecharger/{id}', [OffreController::class, 'telechargerFiche'])->name('telecharger.fiche');
Route::get('/postuler/{offre_id}', [CandidatController::class, 'showForm'])->name('candidature.form');

Route::get('trouver', [candidatController::class, 'getBestCandidate'])->name('candidature.trouver');
Route::get('/analyser-cvs/{offreId}', [CandidatController::class, 'analyserCvs'])->name('candidature.analyserCvs');


Route::middleware('auth')->group(function () {
    Route::get('/admin/entreprise/inscription', [EntrepriseController::class, 'addEntreprise'])->name('admin.addEntreprise');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/evolution-candidatures/{offreId}', [DashboardController::class, 'evolutionCandidatures']);
    Route::post('/logout', [AuthenticatedController::class, 'logout'])->name('logout');
    Route::get('admin/edit/profile', [ProfileController::class, 'edit'])->name('edit.profile');
    Route::put('/admin/update/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/admin/entreprise', [EntrepriseController::class, 'index'])->name('entreprise.index');
    Route::get('/admin/entreprises/{id}/edit', [EntrepriseController::class, 'edit'])->name('entreprise.edit');
    Route::put('/admin/entreprises/{id}', [EntrepriseController::class, 'update'])->name('entreprise.update');
    Route::delete('/admin/entreprises/{id}', [EntrepriseController::class, 'destroy'])->name('entreprise.destroy');
    Route::get('/admin/entreprises/{id}', [EntrepriseController::class, 'show'])->name('entreprise.show');
    Route::put('/entreprises/{entreprise}/toggle-status', [EntrepriseController::class, 'toggleStatus'])->name('entreprise.toggleStatus');
   
    // Route::get('/entreprise/offre', OffreEmploi::class)->name('entreprise.offre');
    route::get('/entreprise/offre/create', [OffreController::class, 'create'])->name('entreprise.offre.create');
    Route::get('/entreprise/offre', [OffreController::class, 'index'])->name('entreprise.offre.index');
    Route::post('/entreprise/offre/store', [OffreController::class, 'storeOffre'])->name('entreprise.offre.store');
    Route::get('/entreprise/offre/{id}', [OffreController::class, 'show'])->name('entreprise.offre.show');
    Route::delete('/entreprise/offre/{id}', [OffreController::class, 'destroy'])->name('entreprise.offre.destroy');
    Route::get('/offre/{id}/toggle-status', [OffreController::class, 'toggleStatus'])->name('offre.toggleStatus');
    Route::get('/offre/{id}/edit', [OffreController::class, 'edit'])->name('entreprise.offre.edit');
    Route::put('/offre/{id}', [OffreController::class, 'update'])->name('entreprise.offre.update');
    Route::get('/offre/candidatures', [CandidatController::class, 'mesCandidatures'])->name('candidatures.mesCandidatures');
    Route::get('/offre/candidatures/selectionne', [CandidatController::class, 'mesCandidatureSelectionne'])->name('candidatures.selectionne');
    Route::get('/offre/candidatures/avance/{offreId}', [CandidatController::class, 'candidatureAvance'])->name('candidatures.avance');
    Route::post('/offre/candidatures/analyse/{offreId}', [CandidatController::class, 'analyserCvsAvecIA'])->name('candidatures.analyse');
    Route::get('/offre/candidatures/selectionne/candidat/{id}', [CandidatController::class, 'selectionneCandidate'])->name('candidatures.candidateSelectionne');
});
