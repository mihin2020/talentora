<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory,HasUlids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'offre_id',
        'cv',
        'autre_document',
        'best_candidate',
        'extract_cv',
    ];

    // Relations si tu veux
 public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}
