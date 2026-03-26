<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $fillable = [
        'rendez_vous_id',
        'patient_id',
        'medecin_id',
        'diagnostic',
        'prescription',
        'remarques',
        'date_consultation',
    ];

    protected $casts = [
        'date_consultation' => 'date',
    ];

    /**
     * Relation avec le rendez-vous correspondant
     */
    public function rendezVous(): BelongsTo
    {
        return $this->belongsTo(RendezVous::class);
    }

    /**
     * Relation avec le patient
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relation avec le médecin qui a effectué la consultation
     */
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class);
    }
}