<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidature;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser;

class CandidatureAnalyse extends Component
{
    public $offreId;
    public $prompt;
    public $analysisResults;
    public $successMessage;


    protected $rules = [
        'prompt' => 'required|string',
    ];

    public function mount($offreId)
    {
        $this->offreId = $offreId;
        $this->analysisResults = session('analysis_results');
    }

    // public function analyseCvs()
    // {
    //     $this->validate();
    
    //     try {
    //         $candidatures = Candidature::where('offre_id', $this->offreId)
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
    //             // Emission correcte de l'événement
    //             $this->emit('alert', 'Aucun CV valide à analyser');
    //             return;
    //         }
    
    //         $messages = [
    //             [
    //                 "role" => "system",
    //                 "content" => "Tu es un assistant expert en recrutement. Analyse les CV et sélectionne ceux qui correspondent à : " . $this->prompt . " A la fin du traitement, tu devras me donner une liste des candidats retenus avec leurs informations (nom , prenom , email et numero de telephone , et une note sur 10 pour chaque candidat et dire pourquoi ils pourraient correspondre.",
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
    //             $this->emit('alert', 'Erreur API Groq');
    //             return;
    //         }
    
    //         $responseData = $response->json();
    //         if (!isset($responseData['choices'][0]['message']['content'])) {
    //             $this->emit('alert', 'Réponse inattendue de l\'IA');
    //             return;
    //         }
    
    //         $this->analysisResults = [
    //             'success' => true,
    //             'analysis' => $responseData['choices'][0]['message']['content'],
    //             'prompt' => $this->prompt
    //         ];
    
    //         session(['analysis_results' => $this->analysisResults]);
    //         $this->successMessage = 'Analyse terminée avec succès!';
    //     } catch (\Exception $e) {
    //         Log::error('Erreur analyse CV: ' . $e->getMessage());
    //         $this->dispatch('alert', 'Une erreur est survenue');
    //     }
    // }



    public function analyseCvs()
{
    $this->validate();

    try {
        $candidatures = Candidature::where('offre_id', $this->offreId)
            ->with('user')
            ->get();

        $cvsText = [];

        foreach ($candidatures as $candidature) {
            if (!$candidature->user || !$candidature->extract_cv) continue;

            $cvsText[] = [
                'user_id' => $candidature->user->id,
                'firstname' => $candidature->user->firstname,
                'lastname' => $candidature->user->lastname,
                'email' => $candidature->user->email,
                'phone' => $candidature->user->phone,
                'cv_text' => strtolower(preg_replace('/\s+/', ' ', trim($candidature->extract_cv))),
            ];
        }

        if (empty($cvsText)) {
            $this->emit('alert', 'Aucun CV valide à analyser');
            return;
        }

        // Traitement par lots (par exemple, 10 CV par lot)
        $batchSize = 10;
        $batches = collect($cvsText)->chunk($batchSize);
        $results = [];

        foreach ($batches as $index => $batch) {
            $messages = [
                [
                    "role" => "system",
                    "content" => "Tu es un assistant expert en recrutement. Analyse les CV et sélectionne ceux qui correspondent à : " . $this->prompt . " A la fin du traitement, donne une liste des candidats retenus avec leurs informations (nom, prénom, email, téléphone), une note sur 10, et une justification.",
                ],
                [
                    "role" => "user",
                    "content" => "CV à analyser (lot " . ($index + 1) . "):\n\n" . collect($batch)->map(function ($cv) {
                        return "Candidat : {$cv['firstname']} {$cv['lastname']}\nEmail : {$cv['email']}\nTéléphone : {$cv['phone']}\nCV:\n{$cv['cv_text']}";
                    })->implode("\n\n----------\n")
                ]
            ];

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'deepseek-r1-distill-llama-70b',
                    'messages' => $messages,
                    'temperature' => 0.3,
                ]);

            if ($response->failed()) {
                Log::error("Erreur Groq API pour le lot " . ($index + 1), ['response' => $response->body()]);
                continue;
            }

            $responseData = $response->json();
            if (isset($responseData['choices'][0]['message']['content'])) {
                $results[] = $responseData['choices'][0]['message']['content'];
            } else {
                Log::warning("Réponse inattendue de l'IA pour le lot " . ($index + 1));
            }
        }

        if (empty($results)) {
            $this->emit('alert', 'Aucune analyse n’a pu être générée.');
            return;
        }

        // Fusion des résultats
        $this->analysisResults = [
            'success' => true,
            'analysis' => implode("\n\n===========\n\n", $results),
            'prompt' => $this->prompt,
        ];

        session(['analysis_results' => $this->analysisResults]);
        $this->successMessage = 'Analyse terminée avec succès !';

    } catch (\Exception $e) {
        Log::error('Erreur analyse CV: ' . $e->getMessage());
        $this->dispatch('alert', 'Une erreur est survenue lors de l\'analyse.');
    }
}

    
    

public function render()
{
    $candidatures = Candidature::where('offre_id', $this->offreId)
        ->where('best_candidate', false)
        ->with('user')
        ->get();

    return view('livewire.candidature-analyse', [
        'candidatures' => $candidatures
    ]);
}

}
