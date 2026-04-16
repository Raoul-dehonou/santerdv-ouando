<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Patient\RendezVousController as PatientRendezVousController;
use App\Http\Controllers\Patient\DossierController as PatientDossierController;

// ==============================================
// ROUTES PUBLIQUES
// ==============================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==============================================
// DASHBOARD PAR DÉFAUT (REDIRECTION SELON RÔLE)
// ==============================================
Route::get('/dashboard', function () {
    /** @var \App\Models\User|null $user */
    $user = auth()->user();
    
    if ($user && isset($user->role) && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    if ($user && isset($user->role) && $user->role === 'medecin') {
        return redirect()->route('medecin.dashboard');
    }
    
    if ($user && isset($user->role) && $user->role === 'patient') {
        return redirect()->route('patient.dashboard');
    }
    
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================================
// ROUTES PROTÉGÉES PAR AUTHENTIFICATION (PROFIL)
// ==============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============================================
// ROUTES POUR L'ADMINISTRATEUR (VUES UNIQUEMENT)
// ==============================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    
    // Patients
    Route::view('/patients', 'admin.patients.index')->name('patients.index');
    Route::view('/patients/create', 'admin.patients.create')->name('patients.create');
    Route::view('/patients/{id}', 'admin.patients.show')->name('patients.show');
    Route::view('/patients/{id}/edit', 'admin.patients.edit')->name('patients.edit');
    
    // Médecins
    Route::view('/medecins', 'admin.medecins.index')->name('medecins.index');
    Route::view('/medecins/create', 'admin.medecins.create')->name('medecins.create');
    Route::view('/medecins/{id}', 'admin.medecins.show')->name('medecins.show');
    
    // Rendez-vous
    Route::view('/rendez-vous', 'admin.rendez-vous.index')->name('rendez-vous.index');
    Route::view('/rendez-vous/calendar', 'admin.rendez-vous.calendar')->name('rendez-vous.calendar');
    Route::view('/rendez-vous/create', 'admin.rendez-vous.create')->name('rendez-vous.create');
    Route::view('/rendez-vous/{id}', 'admin.rendez-vous.show')->name('rendez-vous.show');
    
    // Consultations
    Route::view('/consultations', 'admin.consultations.index')->name('consultations.index');
    Route::view('/consultations/{id}', 'admin.consultations.show')->name('consultations.show');
    
    // Statistiques
    Route::view('/statistiques', 'admin.statistiques.index')->name('statistiques.index');
});

// ==============================================
// ROUTES POUR LE MÉDECIN (VUES UNIQUEMENT)
// ==============================================
Route::middleware(['auth', 'role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    
    // Dashboard
    Route::view('/dashboard', 'medecin.dashboard')->name('dashboard');
    
    // Rendez-vous
    Route::view('/rendez-vous', 'medecin.rendez-vous.index')->name('rendez-vous.index');
    Route::view('/rendez-vous/calendar', 'medecin.rendez-vous.calendar')->name('rendez-vous.calendar');
    Route::view('/rendez-vous/create', 'medecin.rendez-vous.create')->name('rendez-vous.create');
    Route::view('/rendez-vous/{id}', 'medecin.rendez-vous.show')->name('rendez-vous.show');
    
    // Consultations
    Route::view('/consultations', 'medecin.consultations.index')->name('consultations.index');
    Route::view('/consultations/create', 'medecin.consultations.create')->name('consultations.create');
    Route::view('/consultations/create/{rdv_id}', 'medecin.consultations.create')->name('consultations.create.with.rdv');
    Route::view('/consultations/{id}', 'medecin.consultations.show')->name('consultations.show');
    
    // Patients
    Route::view('/patients', 'medecin.patients.index')->name('patients.index');
    Route::view('/patients/{id}', 'medecin.patients.show')->name('patients.show');
    Route::view('/patients/{id}/dossier', 'medecin.patients.dossier')->name('patients.dossier');
    
    // Disponibilités
    Route::view('/disponibilites', 'medecin.disponibilites.index')->name('disponibilites.index');
});

// ==============================================
// ROUTES POUR LE PATIENT (AVEC CONTROLEURS)
// ==============================================
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    
    // Dashboard (avec contrôleur)
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    
    // Dossier médical (avec son propre contrôleur)
    Route::prefix('dossier')->name('dossier.')->group(function () {
        Route::get('/', [PatientDossierController::class, 'index'])->name('index');
    });
    
    // Rendez-vous (avec contrôleur)
    Route::prefix('rendez-vous')->name('rendez-vous.')->group(function () {
        Route::get('/', [PatientRendezVousController::class, 'index'])->name('index');
        Route::get('/create', [PatientRendezVousController::class, 'create'])->name('create');
        Route::post('/', [PatientRendezVousController::class, 'store'])->name('store');
        Route::get('/{id}', [PatientRendezVousController::class, 'show'])->name('show');
        Route::delete('/{id}', [PatientRendezVousController::class, 'destroy'])->name('destroy');
        Route::delete('/{id}/cancel', [PatientRendezVousController::class, 'destroy'])->name('cancel');
    });
});

require __DIR__.'/auth.php';