<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Assurez-vous que c'est bien géré si nécessaire
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:75',
            'type_contrat_id' => 'required|exists:type_contrats,id',
            'localisation' => 'required|in:teletravail,presentiel,hybride',
            'city' => 'nullable|string|max:50',
            'salaire' => 'nullable|string',
            'publicationDate' => 'required|date',
            'deadline' => 'required|date|after_or_equal:publicationDate',
            'description' => 'required|string',
            'langue' => 'nullable|string|max:255',
            'skills' => 'required|string',
            'experience' => 'nullable|string',
            'formation' => 'required|string',
            'mission' => 'nullable|string',
            'objective' => 'nullable|string',
            'otherInformation' => 'nullable|string',
            'fiche' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

            'link' => 'nullable|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 75 caractères.',
            'type_contrat_id.required' => 'Le type de contrat est obligatoire.',
            'type_contrat_id.exists' => 'Le type de contrat sélectionné est invalide.',
            'localisation.required' => 'La localisation est obligatoire.',
            'localisation.in' => 'La localisation doit être télétravail, présentiel ou hybride.',
            'city.max' => 'La ville ne peut pas dépasser 50 caractères.',
            'publicationDate.required' => 'La date de publication est obligatoire.',
            'publicationDate.date' => 'La date de publication doit être une date valide.',
            'deadline.required' => 'La date limite est obligatoire.',
            'deadline.date' => 'La date limite doit être une date valide.',
            'deadline.after_or_equal' => 'La date limite doit être postérieure ou égale à la date de publication.',
            'description.required' => 'La description est obligatoire.',
            'skills.required' => 'Les compétences sont obligatoires.',
            'formation.required' => 'La formation est obligatoire.',
            'fiche.file' => 'La fiche doit être un fichier.',
            'fiche.mimes' => 'La fiche doit être au format pdf, doc ou docx.',
            'fiche.max' => 'La fiche ne peut pas dépasser 2 Mo.',
            'status.in' => 'Le statut doit être publié ou brouillon.',
        ];
    }
}
