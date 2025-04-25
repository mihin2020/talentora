<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntrepriseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // à adapter si besoin
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'secteur_activite' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Le prénom est requis.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'secteur_activite.string' => 'Le secteur d\'activité doit être une chaîne de caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format jpg, jpeg ou png.',
            'photo.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }

}
   

// Compare this snippet from app/Http/Controllers/Auth/AuthenticatedSessionController.php: