<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Offre extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'localisation',
        'salaire',
        'type_contrat_id',
        'city',
        'publicationDate',
        'deadline',
        'langue',
        'skills',
        'experience',
        'formation',
        'mission',
        'objective',
        'otherInformation',
        'fiche',
        'status',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($offre) {
            // Si le slug n'est pas déjà défini, on le génère à partir du titre
            if (empty($offre->slug) && !empty($offre->title)) {
                $offre->slug = Str::slug($offre->title);
            }
        });
    }

    public function getLinkAttribute()
    {
        return url('/offres/' . $this->id . '_' . $this->slug);
    }


    public function contrat()
    {
        return $this->belongsTo(TypeContrat::class, 'type_contrat_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

public function searchKeywords()
{
    return $this->hasOne(SearchKeyword::class, 'offre_id');
}

    protected $casts = [
        'deadline' => 'datetime',
    ];
}
