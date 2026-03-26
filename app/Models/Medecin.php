<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medecin extends Model
{
    protected $fillable = [
        'user_id',
        'specialite',
        'description',
        'is_active',
    ];

    /**
     * Relation avec l'utilisateur associé
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les rendez-vous du médecin
     */
    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class);
    }

    /**
     * Relation avec les consultations effectuées par ce médecin
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}