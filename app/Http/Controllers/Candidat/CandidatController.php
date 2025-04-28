<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use App\Models\Role;
use App\Models\User;
use App\Services\AnalyseCandidatureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;

class CandidatController extends Controller
{


    // Afficher le formulaire pour saisir les infos
    public function showForm($offre_id)
    {
        return view('candidature.inscription', [
            'offre_id' => $offre_id
        ]);
    }
    public function postuler(Request $request, $offre_id)
    {
        // Vérifie si l'email est fourni
        if (!$request->has('email')) {
            return redirect()->back()->withErrors(['email' => 'Email requis pour postuler.']);
        }

        // Chercher l'utilisateur avec cet email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Si utilisateur inexistant, afficher la vue pour remplir ses infos
            return view('candidature.inscription', [
                'email' => $request->email,
                'offre_id' => $offre_id
            ]);
        }

        // Vérifier si l'utilisateur a déjà postulé pour cette offre
        $existingCandidature = Candidature::where('user_id', $user->id)
            ->where('offre_id', $offre_id)
            ->first();

        if ($existingCandidature) {
            return 'Vous avez déjà postulé pour cette offre.';
        }

        // Si utilisateur existe et n'a pas postulé, créer la candidature
        return $this->creerCandidature($request, $offre_id, $user->id);
    }


    protected function creerCandidature(Request $request, $offre_id, $user_id)
    {
        // Validation rapide des fichiers
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'autre_document' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Sauvegarde des fichiers
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $autreDocPath = $request->hasFile('autre_document')
            ? $request->file('autre_document')->store('autre_documents', 'public')
            : null;


        // Création de la candidature
        Candidature::create([
            'user_id' => $user_id,
            'offre_id' => $offre_id,
            'cv' => $cvPath,
            'autre_document' => $autreDocPath,
            'best_candidate' => false,
        ]);

        return 'Votre candidature a été enregistrée.';
    }


    // ancienne methode sans extraction de cv:



    // nouvelle methode avce extraction de cv


    public function inscrireEtPostuler(Request $request)
    {
        // 1. Validation
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'autre_document' => 'nullable|file|mimes:pdf,doc,docx',
            'offre_id' => 'required|exists:offres,id',
        ]);
    
        // 2. Rôle
        $role = Role::where('name', 'Candidat')->first();
        if (!$role) {
            return back()->with('error', 'Le rôle Candidat est introuvable.');
        }
    
        // 3. Vérifier si l'utilisateur existe déjà via l'email
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Vérifier si l'utilisateur a déjà postulé à cette offre
            $existingCandidature = Candidature::where('user_id', $user->id)
                ->where('offre_id', $request->offre_id)
                ->first();
    
            if ($existingCandidature) {
                return back()->with('error', 'Vous avez déjà postulé pour cette offre.');
            }
        } else {
            // Créer l'utilisateur s'il n'existe pas
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $role->id,
                'statut' => true,
            ]);
        }
    
        // 4. Upload fichiers
        $cvFile = $request->file('cv');
        $cvPath = $cvFile->store('cvs', 'public');
    
        $autreDocumentPath = null;
        if ($request->hasFile('autre_document')) {
            $autreDocumentPath = $request->file('autre_document')->store('documents', 'public');
        }
    
        // 5. Extraction du texte du CV (PDF uniquement)
        $extractCvText = '';
        $extension = $cvFile->getClientOriginalExtension();
        $filePath = storage_path("app/public/" . $cvPath);
    
        if (strtolower($extension) === 'pdf') {
            try {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf = $parser->parseFile($filePath);
                $extractCvText = $pdf->getText();
            } catch (\Exception $e) {
                Log::error("Erreur lors de l'extraction du CV PDF : " . $e->getMessage());
                $extractCvText = '';
            }
        }
    
        // 6. Créer la candidature
        Candidature::create([
            'user_id' => $user->id,
            'offre_id' => $request->offre_id,
            'cv' => $cvPath,
            'autre_document' => $autreDocumentPath,
            'extract_cv' => $extractCvText,
        ]);
    
        // 7. Succès
        return back()->with('success', 'Votre inscription et votre candidature ont été enregistrées avec succès.');
    }
    



    public function getBestCandidate()
    {
        return view('candidature.trouver');
    }

    protected $analyseService;

    public function __construct(AnalyseCandidatureService $analyseService)
    {
        $this->analyseService = $analyseService;
    }

    public function analyserCvs(string $offreId)
    {
        try {
            // Récupérer les résultats d'analyse de CV
            $resultats = $this->analyseService->analyserCvsParOffre($offreId);

            // Convertir chaque résultat en un objet si ce n'est pas déjà le cas
            $candidatures = collect($resultats)->map(function ($resultat) {
                // Vérifie si l'élément est un tableau et convertit en objet
                return (object) $resultat;
            });

            // Retourner la vue avec les candidatures et l'ID de l'offre
            return view('candidature.resultat', [
                'candidatures' => $candidatures,
                'offreId' => $offreId,
            ]);
        } catch (\Exception $e) {
            // En cas d'erreur, rediriger avec un message d'erreur
            return redirect()->back()->with('error', $e->getMessage());
        }
    }









    public function mesCandidatures()
    {
        $offres = Offre::where('user_id', Auth::id())
            ->withCount('candidatures') // Compte les candidatures
            ->with(['candidatures']) // Si tu veux accéder aux candidatures
            ->get();

        return view('candidature.mes_candidatures', compact('offres'));
    }


    public function mesCandidatureSelectionne()
    {
        // Récupérer les offres de l'utilisateur connecté avec les candidatures sélectionnées
        $offres = Offre::where('user_id', auth()->id())
            ->with(['candidatures' => function ($query) {
                $query->where('best_candidate', true);
            }])
            ->withCount(['candidatures as selected_candidatures_count' => function ($query) {
                $query->where('best_candidate', true);
            }])
            ->get();

        return view('candidature.selectionne', compact('offres'));
    }

    public function candidatureAvance($offreId)
    {
        // Récupérer les résultats s'ils existent en session
        $results = session('analysis_results');

        return view('candidature.candidature_avance', [
            'offreId' => $offreId,
            'analysisResults' => $results
        ]);
    }


    // public function analyserCvsAvecIA(Request $request, string $offreId)
    // {
    //     try {
    //         $prompt = $request->input('prompt');
    //         if (!$prompt) {
    //             return response()->json(['error' => 'Prompt requis'], 400);
    //         }

    //         $candidatures = Candidature::where('offre_id', $offreId)
    //             ->with('user')
    //             ->get();

    //         $parser = new Parser();
    //         $cvsText = [];

    //         foreach ($candidatures as $candidature) {
    //             if (!$candidature->user) continue;

    //             $pathToCv = storage_path('app/public/' . $candidature->cv);
    //             if (!file_exists($pathToCv)) continue;

    //             try {
    //                 $pdf = $parser->parseFile($pathToCv);
    //                 $text = strtolower($pdf->getText());

    //                 $cvsText[] = [
    //                     'user_id' => $candidature->user->id,
    //                     'firstname' => $candidature->user->firstname,
    //                     'lastname' => $candidature->user->lastname,
    //                     'email' => $candidature->user->email,
    //                     'phone' => $candidature->user->phone,
    //                     'cv_text' => $text,
    //                 ];
    //             } catch (\Exception $e) {
    //                 Log::error("Erreur CV {$pathToCv}: " . $e->getMessage());
    //             }
    //         }

    //         if (empty($cvsText)) {
    //             return response()->json(['error' => 'Aucun CV valide à analyser'], 400);
    //         }

    //         $messages = [
    //             [
    //                 "role" => "system",
    //                 "content" => "Tu es un assistant expert en recrutement. Analyse les CV et sélectionne ceux qui correspondent à : " . $prompt .
    //                     "A la fin du traitement, tu devras me donner une liste des candidats seulement retenus avec leurs informations (nom, prénom, email, téléphone) et une note sur 10 pour chaque candidat 
    //                 et pourquoi ils ont été retenus . Il faut que le rendu soit toujours en français",
    //             ],
    //             [
    //                 "role" => "user",
    //                 "content" => "CV à analyser :\n\n" . collect($cvsText)->map(function ($cv) {
    //                     return "Candidat : {$cv['firstname']} {$cv['lastname']}\nCV:\n{$cv['cv_text']}";
    //                 })->implode("\n\n----------\n")
    //             ]
    //         ];

    //         $response = Http::withoutVerifying()
    //             ->withHeaders([
    //                 'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
    //                 'Content-Type' => 'application/json',
    //             ])
    //             ->post('https://api.groq.com/openai/v1/chat/completions', [
    //                 'model' => 'deepseek-r1-distill-llama-70b',
    //                 'messages' => $messages,
    //                 'temperature' => 0.3,
    //             ]);

    //         if ($response->failed()) {
    //             Log::error('Erreur Groq API', ['response' => $response->body()]);
    //             return response()->json(['error' => 'Erreur API Groq'], 500);
    //         }

    //         $responseData = $response->json();
    //         if (!isset($responseData['choices'][0]['message']['content'])) {
    //             return response()->json(['error' => 'Réponse inattendue de l\'IA'], 500);
    //         }


    //         return redirect()
    //             ->route('candidatures.avance', ['offreId' => $offreId])
    //             ->with('analysis_results', [
    //                 'success' => true,
    //                 'analysis' => $responseData['choices'][0]['message']['content'],
    //                 'prompt' => $prompt
    //             ]);
    //     } catch (\Exception $e) {
    //         Log::error('Erreur analyse CV: ' . $e->getMessage());
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function selectionneCandidate($id)
    {
        $candidature = Candidature::findOrFail($id);
        $candidature->update(['best_candidate' => true]);
    
        return back()->with('success', 'Candidature sélectionnée avec succès.');
    }
    
}
