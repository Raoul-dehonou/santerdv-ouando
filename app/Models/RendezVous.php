<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RendezVous extends Model
{
    protected $table = 'rendez_vous'; // Spécifie le nom exact de la table

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'date',
        'heure',
        'motif',
        'statut',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'heure' => 'string', // ou datetime selon le format stocké
    ];

    /**
     * Relation avec le patient
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relation avec le médecin
     */
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class);
    }

    /**
     * Relation avec la consultation (si elle a eu lieu)
     */
    public function consultation(): HasOne
    {
        return $this->hasOne(Consultation::class);
    }
}