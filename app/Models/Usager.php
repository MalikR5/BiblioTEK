<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usager extends Model
{
    protected $table = 'usagers';

    protected $fillable = [
        'email',
        'mdp',
    ];

    protected $hidden = [
        'mdp',
    ];

    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class);
    }
}
