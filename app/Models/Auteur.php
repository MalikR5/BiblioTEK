<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auteur extends Model
{
    protected $table = 'auteurs';

    protected $fillable = [
        'nom',
    ];

    public function livres(): HasMany
    {
        return $this->hasMany(Livre::class);
    }
}
