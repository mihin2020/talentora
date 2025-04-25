<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Mail\BienvenueEntreprise;
use App\Mail\NouvelleEntreprise;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EntrepriseController extends Controller
{
    public function index()
{
    // Vérifie le rôle de l'utilisateur connecté
    if (Auth::user()->role->name === 'Administrateur') {
        // Administrateur : toutes les entreprises
        $entreprises = User::whereHas('role', function ($query) {
            $query->where('name', 'Entreprise');
        })->with('profile')->orderBy('created_at', 'desc')->get();
    } else {
        // Entreprise : seulement ses propres infos
        $entreprises = User::where('id', Auth::user()->id)
            ->with('profile')
            ->get();
    }

    return view('entreprise.index', compact('entreprises'));
}




    public function edit($id)
    {
        $entreprise = User::with('profile')->findOrFail($id);
        return view('entreprise.edit', compact('entreprise'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'secteur_activite' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2 Mo max
        ]);
    
        $entreprise = User::findOrFail($id);
    
        // Mise à jour des champs de la table users
        $entreprise->update([
            'firstname' => $request->firstname,
            'phone' => $request->phone,
        ]);
    
        // Préparation des données du profil
        $profileData = [
            'secteur_activite' => $request->secteur_activite,
            'description' => $request->description,
        ];
    
        // Gestion de l'image
        if ($request->hasFile('photo')) {
            // Supprimer l’ancienne photo si elle existe
            if ($entreprise->profile && $entreprise->profile->photo) {
                Storage::disk('public')->delete($entreprise->profile->photo);
            }
    
            // Stocker la nouvelle photo
            $path = $request->file('photo')->store('entreprises', 'public');
            $profileData['photo'] = $path;
        }
    
        // Mise à jour ou création du profil
        $entreprise->profile()->updateOrCreate(
            ['user_id' => $entreprise->id],
            $profileData
        );
    
        return redirect()->route('entreprise.index')->with('success', 'Entreprise mise à jour avec succès.');
    }
    


    public function show($id)
{
    $entreprise = User::with('profile')->findOrFail($id);

    return view('entreprise.show', compact('entreprise'));
}


    public function destroy($id)
    {
        $entreprise = User::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('entreprise.index')->with('success', 'Entreprise supprimée.');
    }


    public function toggleStatus($id)
    {
        $entreprise = User::findOrFail($id);
        $entreprise->update(['statut' => !$entreprise->statut]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    
    public function addEntreprise()
    {
        return view('entreprise.inscriptionEntreprise');
    }

    
    public function storeEntreprise(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:12',
        ]);
    
        // Génération du mot de passe aléatoire
        $randomPassword = Str::random(12);
    
        // Récupération du rôle 'Entreprise'
        $role = Role::where('name', 'Entreprise')->firstOrFail();
    
        // Création de l'entreprise (utilisateur)
        $entreprise = User::create([
            'firstname' => $validated['firstname'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($randomPassword),
            'role_id' => $role->id,
        ]);
    
        // Envoi des mails
        $this->notifyAdmin($entreprise);
        $this->notifyEntreprise($entreprise, $randomPassword);
    
        return redirect()->route('entreprise.addEntreprise')->with('success', 'Votre demande a été enregistrée. Un mail vous a été envoyé.');
    }
    


    protected function notifyAdmin($entreprise)
    {
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'Administrateur');
        })->get();
    
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NouvelleEntreprise($entreprise));
        }
    }
    

protected function notifyEntreprise($entreprise, $password)
{
    Mail::to($entreprise->email)->send(new BienvenueEntreprise($entreprise, $password));
}

}
