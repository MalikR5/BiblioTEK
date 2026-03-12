<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livre extends Model
{
    protected $table = 'livres';

    protected $fillable = [
        'titre',
        'auteur_id',
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(Auteur::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Categorie::class, 'categorie_livre');
    }

    public function exemplaires(): HasMany
    {
        return $this->hasMany(Exemplaire::class);
    }
}
