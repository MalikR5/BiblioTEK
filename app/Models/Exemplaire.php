<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exemplaire extends Model
{
    protected $table = 'exemplaires';

    protected $fillable = [
        'mise_en_service',
        'livre_id',
        'statut_id',
    ];

    protected $casts = [
        'mise_en_service' => 'date',
    ];

    public function livre(): BelongsTo
    {
        return $this->belongsTo(Livre::class);
    }

    public function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class);
    }
}
