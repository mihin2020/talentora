<?php

namespace App\Livewire\Entreprise;

use App\Http\Requests\StoreEntrepriseRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\BienvenueEntreprise;
use App\Mail\NouvelleEntreprise;

// class InscriptionEntreprise extends Component
// {
//     public $firstname;
//     public $email;
//     public $phone;

//     public function render()
//     {
//         return view('livewire.entreprise.inscription-entreprise')->layout('admin.layouts.main');
//     }

  

//     public function updated($propertyName)
//     {
//         $this->validateOnly($propertyName);
//     }

//     public function storeEntreprise()
//     {
//         $validated = app()->make(StoreEntrepriseRequest::class)->validate();

//         $randomPassword = Str::random(12);

//         $role = Role::where('name', 'Entreprise')->firstOrFail();

//         $entreprise = User::create([
//             'firstname' => $this->firstname,
//             'email' => $this->email,
//             'phone' => $this->phone,
//             'password' => Hash::make($randomPassword),
//             'role_id' => $role->id,
//         ]);

//         $this->notifyAdmin($entreprise);
//         $this->notifyEntreprise($entreprise, $randomPassword);

//         session()->flash('success', 'Votre demande a été enregistrée. Un mail vous a été envoyé.');

//         $this->reset(); // Réinitialiser le formulaire
//     }

//     protected function notifyAdmin($entreprise)
//     {
//         $admins = User::whereHas('role', function ($query) {
//             $query->where('name', 'Administrateur');
//         })->get();

//         foreach ($admins as $admin) {
//             Mail::to($admin->email)->send(new NouvelleEntreprise($entreprise));
//         }
//     }

//     protected function notifyEntreprise($entreprise, $password)
//     {
//         Mail::to($entreprise->email)->send(new BienvenueEntreprise($entreprise, $password));
//     }
// }
