<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser tous les utilisateurs (peut être personnalisé pour vérifier les rôles si besoin)
    }

    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|email|max:255|'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le nom est requis.',
            'lastname.required' => 'Le prénom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
        ];
    }
}
