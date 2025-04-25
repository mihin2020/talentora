<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOffreRequest;
use App\Models\Offre;
use App\Models\TypeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OffreController extends Controller
{


    public function index()
    {
        $offres = Offre::where('user_id', auth()->id())->get();
        return view('offre.index', compact('offres'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('offre.create', [
            'typeContrats' => TypeContrat::all(),
        ]);
    }

    public function show($id)
    {
        $offre = Offre::findOrFail($id);
        return view('offre.show', compact('offre'));
    }

    // public function share($idSlug)
    // {
    //     [$id, $slug] = explode('_', $idSlug, 2);

    //     $offre = Offre::findOrFail($id);

    //     // Vérifie si le statut est "publie"
    //     if ($offre->status !== 'publie') {
    //         return view('offre.share', [
    //             'offre' => $offre,
    //             'message' => 'Offre non publiée'
    //         ]);
    //     }

    //     // Vérifie si la date d'expiration est dépassée
    //     if ($offre->deadline && $offre->deadline->isPast()) {
    //         return view('offre.share', [
    //             'offre' => $offre,
    //             'message' => 'Offre expirée'
    //         ]);
    //     }

    //     return view('offre.share', compact('offre'));
    // }


    public function share($idSlug)
{
    // Récupère l'ID et le slug à partir du paramètre
    [$id, $slug] = explode('_', $idSlug, 2);

    // Récupère l'offre avec son profil d'entreprise
    $offre = Offre::with('user.profile')->findOrFail($id);

    // Vérifie si le statut est "publie"
    if ($offre->status !== 'publie') {
        return view('offre.share', [
            'offre' => $offre,
            'message' => 'Offre non publiée'
        ]);
    }

    // Vérifie si la date d'expiration est dépassée
    if ($offre->deadline && $offre->deadline->isPast()) {
        return view('offre.share', [
            'offre' => $offre,
            'message' => 'Offre expirée'
        ]);
    }

    // Récupérer le profil de l'entreprise
    $profilEntreprise = $offre->user->profile;

    // Retourne la vue avec les informations de l'offre et du profil de l'entreprise
    return view('offre.share', compact('offre', 'profilEntreprise'));
}


    public function edit($id)
    {
        $offre = Offre::findOrFail($id);
        $typeContrats = TypeContrat::all();
        return view('offre.edit', compact('offre', 'typeContrats'));
    }

    public function update(StoreOffreRequest $request, $id)
    {
        $offre = Offre::findOrFail($id);

        $data = $request->validated();

        // Gestion du fichier uploadé
        if ($request->hasFile('fiche')) {
            // Supprimer l'ancien fichier si nécessaire
            if ($offre->fiche) {
                Storage::disk('public')->delete($offre->fiche);
            }

            $data['fiche'] = $request->file('fiche')->store('offre', 'public');
        }

        $offre->update($data);

        return redirect()->route('entreprise.offre.index')->with('success', 'Offre mise à jour avec succès.');
    }


    public function storeOffre(StoreOffreRequest $request)
    {
        $data = $request->validated();

        // Gestion du fichier uploadé
        if ($request->hasFile('fiche')) {
            $data['fiche'] = $request->file('fiche')->store('offre', 'public');
        }

        // Ajout de l'utilisateur connecté
        $data['user_id'] = auth()->id();

        // Création de l'offre
        Offre::create($data);

        // Retourner à la liste des offres avec un message de succès
        return redirect()->route('entreprise.offre.index')->with('success', 'Offre créée avec succès.');
    }


    public function destroy($id)
    {
        $offre = Offre::findOrFail($id);
        $offre->delete();
        return redirect()->route('entreprise.offre.index')->with('success', 'Offre supprimée avec succès.');
    }


    public function toggleStatus($id)
    {
        $offre = Offre::findOrFail($id);

        // Toggle status
        $offre->status = $offre->status === 'publie' ? 'brouillon' : 'publie';
        $offre->save();

        return redirect()->back()->with('success', 'Statut de l\'offre mis à jour avec succès.');
    }

    public function telechargerFiche($id)
    {
        $offre = Offre::findOrFail($id);

        if (!$offre->fiche || !Storage::disk('public')->exists($offre->fiche)) {
            abort(404, 'Fichier introuvable');
        }

        return response()->download(
            storage_path('app/public/' . $offre->fiche),
            'offre_' . Str::slug($offre->title) . '.' . pathinfo($offre->fiche, PATHINFO_EXTENSION)
        );
    }
}
