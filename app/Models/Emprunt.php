<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprunt extends Model
{
    protected $table = 'emprunts';

    protected $fillable = [
        'date_emprunt',
        'date_retour_prevue',
        'date_retour',
        'usager_id',
        'exemplaire_id',
    ];

    protected $casts = [
        'date_emprunt' => 'date',
        'date_retour_prevue' => 'date',
        'date_retour' => 'date',
    ];

    public function usager(): BelongsTo
    {
        return $this->belongsTo(Usager::class);
    }

    public function exemplaire(): BelongsTo
    {
        return $this->belongsTo(Exemplaire::class);
    }
}
