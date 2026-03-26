<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $patient = $user->patient;

        // Prochain rendez-vous (futur)
        $prochainRdv = RendezVous::where('patient_id', $patient->id)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('heure')
            ->first();

        // Nombre total de consultations du patient
        $nombreConsultations = Consultation::where('patient_id', $patient->id)->count();

        // Liste des rendez-vous à venir
        $rendezVousAVenir = RendezVous::where('patient_id', $patient->id)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('heure')
            ->get();

        return view('patient.dashboard', compact('prochainRdv', 'nombreConsultations', 'rendezVousAVenir'));
    }
}