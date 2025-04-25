<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    use HasFactory,HasUuids;
    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $primaryKey = 'id';
    // Protéger les champs que vous souhaitez remplir
    protected $fillable = ['name'];

    public function offre()
    {
        return $this->hasOne(Offre::class);
    }
}
