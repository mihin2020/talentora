<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticatedController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }



    public function store(LoginRequest $request): RedirectResponse
    {
        // Les informations sont automatiquement validées par LoginRequest
        $credentials = $request->only('email', 'password');

        // Vérification des identifiants
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Récupérer l'utilisateur après l'authentification réussie
            $user = Auth::user();

            // Vérification du statut de l'utilisateur
            if (!$user->statut) { // Si le statut est faux (inactif)
                Auth::logout(); // Déconnexion
                return back()->with([
                    'warning' => 'Votre compte n\'est pas encore activé.',
                ]);
            }

            // Si le statut est ok, on redirige en fonction du rôle
            return match ($user->role->name ?? '') { // Eviter une erreur si le rôle est null
                'Administrateur' => redirect()->route('dashboard'),
                'Entreprise' => redirect()->route('dashboard'),
                'Candidat' => redirect()->route('candidat.dashboard'),
                default => redirect()->route('login')->with('status', 'Accès refusé. Votre rôle n\'est pas reconnu.')
            };
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ])->onlyInput('email');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Vous êtes déconnecté avec succès.');
    }
}
