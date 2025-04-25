<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // autorise tous les utilisateurs authentifiés
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Veuillez saisir votre ancien mot de passe.',
            'new_password.required' => 'Veuillez entrer un nouveau mot de passe.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 12 caractères.',
            'new_password.confirmed' => 'La confirmation ne correspond pas au nouveau mot de passe.',
        ];
    }
}
