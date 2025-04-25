<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Candidature;

class CandidatureHelper
{
    public static function aDejaPostule($userId, $offreId)
    {
        return Candidature::where('user_id', $userId)
                          ->where('offre_id', $offreId)
                          ->exists();
    }
}
