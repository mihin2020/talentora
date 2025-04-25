<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }
    public function update(ProfileUpdateRequest $request)
    {
        // Si la validation passe, les données sont prêtes pour la mise à jour
        $user = Auth::user();

        // Mettre à jour l'utilisateur avec les données validées
        $user->update($request->validated());

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Votre profil a été mis à jour avec succès.');
    }


    /**
     * Met à jour le mot de passe de l'utilisateur authentifié.
     *
     * @param  \App\Http\Requests\UpdatePasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
    
        // Vérifie et met à jour le mot de passe si l'ancien est correct
        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);
            return back()->with('success', 'Mot de passe mis à jour avec succès.');
        }
    
        return back()->withErrors(['current_password' => 'L\'ancien mot de passe est incorrect.']);
    }
}
