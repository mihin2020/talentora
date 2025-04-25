<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer directement l'ID de l'utilisateur entreprise
        $userId = User::where('email', 'royal@gmail.com')->value('id');

        if ($userId) {
            Profile::updateOrCreate(
                ['user_id' => $userId],
                [
                    'secteur_activite' => 'Design graphique & Développement web',
                    'description' => 'Royal Conception est une agence créative spécialisée dans le branding, la création de sites web et le marketing digital. Nous accompagnons les entreprises dans leur transformation numérique avec des solutions innovantes.',
                    'photo' => 'images/entreprise/logo_entreprise.png', 
                ]
            );
        }
    }
}
