@extends('layouts.app')

@section('title', 'Mon Dossier Médical')
@section('header', 'Dossier Médical')

@section('content')
<div class="space-y-6">
    
    <!-- Navigation interne -->
    <div class="flex flex-wrap gap-2 border-b pb-2">
        <a href="#info" class="text-primary font-medium px-3 py-1 rounded-lg hover:bg-gray-100">📋 Informations</a>
        <a href="#consultations" class="text-gray-500 hover:text-primary px-3 py-1 rounded-lg hover:bg-gray-100">🏥 Consultations</a>
        <a href="#ordonnances" class="text-gray-500 hover:text-primary px-3 py-1 rounded-lg hover:bg-gray-100">💊 Ordonnances</a>
        <a href="#allergies" class="text-gray-500 hover:text-primary px-3 py-1 rounded-lg hover:bg-gray-100">⚠️ Allergies & Antécédents</a>
    </div>
    
    <!-- Section 1 : Informations personnelles -->
    <div id="info" class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-user-circle text-primary"></i>
                Informations personnelles
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nom complet</p>
                <p class="font-medium">{{ Auth::user()->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ Auth::user()->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Téléphone</p>
                <p class="font-medium">{{ $patientInfo->telephone ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date de naissance</p>
                <p class="font-medium">{{ $patientInfo->date_naissance ? \Carbon\Carbon::parse($patientInfo->date_naissance)->format('d/m/Y') : 'Non renseignée' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Adresse</p>
                <p class="font-medium">{{ $patientInfo->adresse ?? 'Non renseignée' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Profession</p>
                <p class="font-medium">{{ $patientInfo->profession ?? 'Non renseignée' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Contact urgence</p>
                <p class="font-medium">{{ $patientInfo->contact_urgence ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">N° Sécurité sociale</p>
                <p class="font-medium">{{ $patientInfo->num_secu_sociale ?? 'Non renseigné' }}</p>
            </div>
        </div>
    </div>
    
    <!-- Section 2 : Groupe sanguin -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-tint text-red-500"></i>
                Groupe sanguin
            </h3>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-100">
                    <span class="text-3xl font-bold text-red-600">{{ $dossierMedical->groupe_sanguin ?? 'Non défini' }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-heartbeat text-primary"></i>
                Dernières constantes
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Tension artérielle :</span>
                    <span class="font-medium">{{ $derniereConsultation->tension ?? 'Non mesurée' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Poids :</span>
                    <span class="font-medium">{{ $derniereConsultation->poids ?? 'Non mesuré' }} kg</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Taille :</span>
                    <span class="font-medium">{{ $derniereConsultation->taille ?? 'Non mesurée' }} cm</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">IMC :</span>
                    <span class="font-medium">{{ $imc ?? 'Non calculé' }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section 3 : Antécédents et Allergies -->
    <div id="allergies" class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                Antécédents & Allergies
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Antécédents médicaux</h4>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-gray-600">{{ $dossierMedical->antecedents ?? 'Aucun antécédent renseigné' }}</p>
                </div>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Allergies connues</h4>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-gray-600">{{ $dossierMedical->allergies ?? 'Aucune allergie connue' }}</p>
                </div>
            </div>
            <div class="md:col-span-2">
                <h4 class="font-medium text-gray-700 mb-2">Traitements en cours</h4>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-gray-600">{{ $dossierMedical->traitements_actuels ?? 'Aucun traitement' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section 4 : Historique des consultations -->
    <div id="consultations" class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-notes-medical text-primary"></i>
                Historique des consultations
            </h3>
            <a href="#" class="text-sm text-primary hover:underline">Voir tout</a>
        </div>
        <div class="divide-y">
            @forelse($consultations as $consultation)
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start flex-wrap gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-user-md text-primary text-sm"></i>
                            </div>
                            <p class="font-medium text-gray-800">{{ $consultation->medecin->user->name ?? 'Dr. Inconnu' }}</p>
                            <span class="text-xs text-gray-400">•</span>
                            <p class="text-sm text-gray-500">{{ $consultation->medecin->specialite ?? 'Généraliste' }}</p>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y à H:i') }}
                        </p>
                        <p class="text-sm text-gray-700 bg-gray-50 p-2 rounded-lg">
                            <strong class="text-primary">Diagnostic :</strong> {{ Str::limit($consultation->diagnostic ?? 'Sans diagnostic', 100) }}
                        </p>
                        @if($consultation->prescription)
                        <p class="text-sm text-gray-600 mt-2">
                            <strong>Prescription :</strong> {{ Str::limit($consultation->prescription, 80) }}
                        </p>
                        @endif
                    </div>
                    <button onclick="showConsultationDetails({{ $consultation->id }})" class="text-primary hover:text-primary-dark text-sm border border-primary rounded-lg px-3 py-1 hover:bg-primary hover:text-white transition">
                        Détails →
                    </button>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-notes-medical text-4xl mb-2 text-gray-300"></i>
                <p>Aucune consultation pour le moment</p>
            </div>
            @endforelse
        </div>
    </div>
    
  <!-- Section 5 : Ordonnances (optionnel - à activer plus tard) -->
<div id="ordonnances" class="bg-white rounded-xl shadow-lg">
    <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-prescription-bottle text-primary"></i>
            Ordonnances
        </h3>
    </div>
    <div class="p-8 text-center text-gray-500">
        <i class="fas fa-prescription-bottle text-4xl mb-2 text-gray-300"></i>
        <p>Fonctionnalité à venir</p>
    </div>
</div>

<script>
    // Navigation smooth
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Mise à jour active des onglets
                document.querySelectorAll('#navigation a').forEach(link => {
                    link.classList.remove('text-primary', 'font-medium');
                    link.classList.add('text-gray-500');
                });
                this.classList.remove('text-gray-500');
                this.classList.add('text-primary', 'font-medium');
            }
        });
    });
    
    function showConsultationDetails(id) {
        alert('Affichage des détails de la consultation #' + id);
    }
    
    function viewOrdonnance(id) {
        alert('Affichage de l\'ordonnance #' + id);
    }
    
    function downloadOrdonnance(id) {
        alert('Téléchargement de l\'ordonnance #' + id);
    }
</script>
@endsection