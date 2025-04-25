<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use App\Models\Candidature;
use App\Models\SearchKeyword;

// class AnalyseCandidatureService
// {
//     public function analyserCvsParOffre(string $offreId)
//     {
//         // 1. Récupérer tous les mots-clés liés à l'offre
//         $searchKeywords = SearchKeyword::where('offre_id', $offreId)->first();

//         if (!$searchKeywords) {
//             throw new \Exception('Aucun mot-clé trouvé pour cette offre.');
//         }

//         $keywords = array_map('strtolower', $searchKeywords->keyword); // mettre en minuscules

//         // 2. Récupérer toutes les candidatures liées à cette offre
//         $candidatures = Candidature::where('offre_id', $offreId)->get();

//         $parser = new Parser();
//         $resultats = [];

//         foreach ($candidatures as $candidature) {
//             $pathToCv = storage_path('app/' . $candidature->cv);

//             if (!file_exists($pathToCv)) {
//                 continue; // on saute si le fichier CV n'existe pas
//             }

//             $pdf = $parser->parseFile($pathToCv);
//             $text = strtolower($pdf->getText());

//             // 3. Vérifier la présence de chaque mot-clé
//             $matches = [];

//             foreach ($keywords as $keyword) {
//                 if (strpos($text, $keyword) !== false) {
//                     $matches[] = $keyword;
//                 }
//             }

//             // 4. Stocker le résultat pour chaque candidature
//             $resultats[] = [
//                 'candidature_id' => $candidature->id,
//                 'user_id' => $candidature->user_id,
//                 'matches' => $matches,
//                 'nombre_matchs' => count($matches),
//             ];
//         }

//         return $resultats;
//     }
// }
class AnalyseCandidatureService
{
    // public function analyserCvsParOffre(string $offreId)
    // {
    //     // 1. Récupérer tous les mots-clés liés à l'offre
    //     $searchKeywords = SearchKeyword::where('offre_id', $offreId)->first();
       
        

    //     if (!$searchKeywords) {
    //         throw new \Exception('Aucun mot-clé trouvé pour cette offre.');
    //     }

    //     $keywords = array_map('strtolower', $searchKeywords->keyword); // mettre en minuscules


    //     // 2. Récupérer toutes les candidatures liées à cette offre, en chargeant la relation 'user'
    //     $candidatures = Candidature::where('offre_id', $offreId)
    //     ->where('best_candidate', false) // Ajoute cette condition ici
    //     ->with('user')
    //     ->get();

    //     $parser = new Parser();
    //     $resultats = [];

    //     foreach ($candidatures as $candidature) {
    //         // Accéder à l'utilisateur directement depuis la relation
    //         $user = $candidature->user;

    //         // Assure-toi que l'utilisateur est bien présent avant de continuer
    //         if (!$user) {
    //             continue; // Si l'utilisateur n'existe pas, passe à la candidature suivante
    //         }
    //         $pathToCv = storage_path('app/public/' . $candidature->cv);
            
    //         if (!file_exists($pathToCv)) {
    //             continue; // on saute si le fichier CV n'existe pas
    //         }
            
    //         $pdf = $parser->parseFile($pathToCv);
    //         $text = strtolower($pdf->getText());
           

    //         // 3. Vérifier la présence de chaque mot-clé
    //         $matches = [];

    //         foreach ($keywords as $keyword) {
    //             if (strpos($text, $keyword) !== false) {
    //                 $matches[] = $keyword;
    //             }
    //         }

    //         // 4. Stocker le résultat pour chaque candidature
    //         $resultats[] = [
    //             'candidature_id' => $candidature->id,
    //             'user_id' => $user->id, // Utilisation de l'ID de l'utilisateur
    //             'matches' => $matches,
    //             'nombre_matchs' => count($matches),
    //             'firstname' => $user->firstname ?? 'N/A', // Ajouter le prénom
    //             'lastname' => $user->lastname ?? 'N/A',   // Ajouter le nom
    //             'email' => $user->email ?? 'N/A',         // Ajouter l'email
    //             'phone' => $user->phone ?? 'N/A',         // Ajouter le téléphone
    //             'cv' => $candidature->cv ?? 'N/A',  
    //             'autre_document' => $candidature->autre_document ?? 'N/A',  
    //             'best_candidate' => $candidature->best_candidate ?? false, 
    //         ];
    //     }

    //     return $resultats;
    // }


    public function analyserCvsParOffre(string $offreId)
{
    // 1. Récupérer les mots-clés liés à l'offre
    $searchKeywords = SearchKeyword::where('offre_id', $offreId)->first();

    if (!$searchKeywords) {
        throw new \Exception('Aucun mot-clé trouvé pour cette offre.');
    }

    $keywords = array_map('strtolower', $searchKeywords->keyword); // En minuscules

    // 2. Récupérer toutes les candidatures liées à cette offre
    $candidatures = Candidature::where('offre_id', $offreId)
        ->where('best_candidate', false)
        ->with('user')
        ->get();

    $resultats = [];

    foreach ($candidatures as $candidature) {
        $user = $candidature->user;
        if (!$user) continue;

        // ✅ Utiliser le texte extrait déjà stocké
        $text = strtolower($candidature->extract_cv ?? '');

        $matches = [];
        foreach ($keywords as $keyword) {
            if (strpos($text, $keyword) !== false) {
                $matches[] = $keyword;
            }
        }

        $resultats[] = [
            'candidature_id' => $candidature->id,
            'user_id' => $user->id,
            'matches' => $matches,
            'nombre_matchs' => count($matches),
            'firstname' => $user->firstname ?? 'N/A',
            'lastname' => $user->lastname ?? 'N/A',
            'email' => $user->email ?? 'N/A',
            'phone' => $user->phone ?? 'N/A',
            'cv' => $candidature->cv ?? 'N/A',
            'autre_document' => $candidature->autre_document ?? 'N/A',
            'best_candidate' => $candidature->best_candidate ?? false,
        ];
    }

    return $resultats;
}

}
