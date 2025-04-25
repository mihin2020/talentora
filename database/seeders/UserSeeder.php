<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Récupération des rôles en une seule requête
    $roles = Role::whereIn('name', ['Administrateur', 'Entreprise', 'Candidat'])
                 ->pluck('id', 'name'); 

    $users = [
        [
            'role_name' => 'Administrateur',
            'firstname' => 'MIHIN',
            'lastname' => 'Hugues Aimé',
            'email' => 'admin@gmail.com',
            'phone' => '70707070',
            'password' => Hash::make('password'),
            'statut' => true,
        ],
        [
            'role_name' => 'Entreprise',
            'firstname' => 'Royal Conception',
            'email' => 'royal@gmail.com',
            'phone' => '60606060',
            'password' => Hash::make('password'),
            'statut' => false,  
        ],
        [
            'role_name' => 'Candidat',
            'firstname' => 'ZOUGBE',
            'lastname' => 'Armand',
            'email' => 'armand@gmail.com',
            'phone' => '50505050',
            'password' => Hash::make('password'),
            'statut' => true,  // Si nécessaire
        ],
    ];

    foreach ($users as $userData) {
        User::firstOrCreate(
            ['email' => $userData['email']],  
            [
                'role_id' => $roles[$userData['role_name']],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'] ?? '', 
                'phone' => $userData['phone'],
                'password' => $userData['password'],
                'statut' => $userData['statut'] ?? false, 
            ]
        );
    }
}

}
