<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        // Prochain rendez-vous
        $prochainRdv = null;
        if ($patient) {
            $prochainRdv = RendezVous::where('patient_id', $patient->id)
                ->where('date', '>=', now()->toDateString())
                ->where('statut', '!=', 'annule')
                ->orderBy('date')
                ->orderBy('heure')
                ->first();
        }
        
        // Nombre total de consultations
        $nombreConsultations = 0;
        if ($patient) {
            $nombreConsultations = Consultation::where('patient_id', $patient->id)->count();
        }
        
        // Liste des rendez-vous à venir
        $rendezVousAVenir = collect();
        if ($patient) {
            $rendezVousAVenir = RendezVous::where('patient_id', $patient->id)
                ->where('date', '>=', now()->toDateString())
                ->where('statut', '!=', 'annule')
                ->orderBy('date')
                ->orderBy('heure')
                ->limit(5)
                ->get();
        }
        
        // Dernières consultations
        $dernieresConsultations = collect();
        if ($patient) {
            $dernieresConsultations = Consultation::where('patient_id', $patient->id)
                ->with('medecin.user')
                ->orderBy('date_consultation', 'desc')
                ->limit(3)
                ->get();
        }
        
        return view('patient.dashboard', [
            'prochainRdv' => $prochainRdv,
            'nombreConsultations' => $nombreConsultations,
            'rendezVousAVenir' => $rendezVousAVenir,
            'dernieresConsultations' => $dernieresConsultations,
        ]);
    }
}