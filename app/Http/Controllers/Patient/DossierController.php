<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;
use App\Models\DossierMedical;

class DossierController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        // Si le patient n'a pas encore de dossier, on en crée un vide
        if ($patient && !$patient->dossierMedical) {
            $patient->dossierMedical()->create();
        }
        
        // Récupérer le dossier médical
        $dossierMedical = $patient ? $patient->dossierMedical : null;
        
        // Toutes les consultations pour l'historique
        $consultations = [];
        if ($patient) {
            $consultations = Consultation::where('patient_id', $patient->id)
                ->with('medecin.user')
                ->orderBy('date_consultation', 'desc')
                ->get();
        }
        
        // Dernière consultation pour les constantes
        $derniereConsultation = null;
        if ($patient) {
            $derniereConsultation = Consultation::where('patient_id', $patient->id)
                ->orderBy('date_consultation', 'desc')
                ->first();
        }
        
        // Calcul IMC
        $imc = null;
        if ($derniereConsultation && $derniereConsultation->poids && $derniereConsultation->taille) {
            $tailleM = $derniereConsultation->taille / 100;
            $imc = round($derniereConsultation->poids / ($tailleM * $tailleM), 1);
        }
        
        // Informations patient
        $patientInfo = $patient;
        
        return view('patient.dossier.index', compact(
            'patientInfo',
            'dossierMedical',
            'consultations',
            'derniereConsultation',
            'imc'
        ));
    }
}