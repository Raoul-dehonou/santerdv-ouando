<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\Medecin;

class RendezVousController extends Controller
{
    /**
     * Affiche la liste des rendez-vous du patient
     */
    public function index()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $rendezVous = collect();
        if ($patient) {
            $rendezVous = RendezVous::where('patient_id', $patient->id)
                ->with('medecin.user')
                ->orderBy('date', 'desc')
                ->orderBy('heure', 'desc')
                ->get();
        }
        
        return view('patient.rendez-vous.index', [
            'rendezVous' => $rendezVous
        ]);
    }
    
    /**
     * Affiche le formulaire de création de rendez-vous
     */
    public function create()
    {
        $medecins = Medecin::with('user')->where('is_active', true)->get();
        return view('patient.rendez-vous.create', [
            'medecins' => $medecins
        ]);
    }
    
    /**
     * Enregistre un nouveau rendez-vous
     */
    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'motif' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        $user = Auth::user();
        $patient = $user->patient;
        
        RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'heure' => $request->heure,
            'motif' => $request->motif,
            'notes' => $request->notes,
            'statut' => 'en_attente',
        ]);
        
        return redirect()->route('patient.rendez-vous.index')
            ->with('success', 'Rendez-vous pris avec succès !');
    }
    
    /**
     * Affiche les détails d'un rendez-vous
     */
    public function show($id)
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $rdv = RendezVous::where('id', $id)
            ->where('patient_id', $patient->id)
            ->with('medecin.user')
            ->firstOrFail();
        
        return view('patient.rendez-vous.show', [
            'rdv' => $rdv
        ]);
    }
    
    /**
     * Annule un rendez-vous
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $rdv = RendezVous::where('id', $id)
            ->where('patient_id', $patient->id)
            ->firstOrFail();
        
        $rdv->update(['statut' => 'annule']);
        
        return redirect()->route('patient.rendez-vous.index')
            ->with('success', 'Rendez-vous annulé avec succès !');
    }
}