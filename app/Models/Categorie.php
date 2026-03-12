<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorie extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'categorie',
    ];

    public function livres(): BelongsToMany
    {
        return $this->belongsToMany(Livre::class, 'categorie_livre');
    }
}
