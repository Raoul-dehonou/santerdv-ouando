@extends('layouts.app')

@section('title', 'Mon Dossier Médical')
@section('header', 'Dossier Médical')

@section('content')
<div class="space-y-6">
    
    <!-- Navigation interne -->
    <div class="flex gap-2 border-b pb-2">
        <a href="#info" class="text-primary font-medium">Informations</a>
        <a href="#consultations" class="text-gray-500 hover:text-primary">Consultations</a>
        <a href="#ordonnances" class="text-gray-500 hover:text-primary">Ordonnances</a>
        <a href="#allergies" class="text-gray-500 hover:text-primary">Allergies & Antécédents</a>
    </div>
    
    <!-- Section 1 : Informations personnelles -->
    <div id="info" class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-user-circle text-primary"></i>
                Informations personnelles
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nom complet</p>
                <p class="font-medium">Jean Kouassi</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date de naissance</p>
                <p class="font-medium">15 Juin 1985 (38 ans)</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Téléphone</p>
                <p class="font-medium">+229 97 12 34 56</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">jean.kouassi@email.com</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Adresse</p>
                <p class="font-medium">Cotonou, Bénin</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Contact urgence</p>
                <p class="font-medium">+229 90 12 34 56</p>
            </div>
        </div>
    </div>
    
    <!-- Section 2 : Groupe sanguin et infos médicales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-tint text-red-500"></i>
                Groupe sanguin
            </h3>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-100">
                    <span class="text-3xl font-bold text-red-600">O+</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-heartbeat text-primary"></i>
                Constantes récentes
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Tension artérielle :</span>
                    <span class="font-medium">120/80 mmHg</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Poids :</span>
                    <span class="font-medium">75 kg</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Taille :</span>
                    <span class="font-medium">1.78 m</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">IMC :</span>
                    <span class="font-medium">23.7 (Normal)</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section 3 : Antécédents et Allergies -->
    <div id="allergies" class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                Antécédents & Allergies
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Antécédents médicaux</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Hypertension artérielle (diagnostiqué en 2020)</li>
                    <li>Cholestérol modéré</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Allergies connues</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Aucune allergie connue</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Traitements en cours</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Lisinopril 10mg - 1x/jour</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Vaccinations</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>COVID-19 (3 doses)</li>
                    <li>Tétanos (2022)</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Section 4 : Historique des consultations -->
    <div id="consultations" class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-notes-medical text-primary"></i>
                Historique des consultations
            </h3>
            <a href="{{ route('patient.dossier.consultations') }}" class="text-sm text-primary hover:underline">Voir tout</a>
        </div>
        <div class="divide-y">
            <div class="p-6 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium">Dr. Adjanohoun - Cardiologue</p>
                        <p class="text-sm text-gray-500">15 Mars 2024</p>
                        <p class="text-sm mt-2">Diagnostic : Hypertension stable, bon contrôle sous traitement</p>
                        <p class="text-sm text-gray-600 mt-1">Prescription : Maintenir Lisinopril 10mg</p>
                    </div>
                    <a href="#" class="text-primary hover:underline text-sm">Détails →</a>
                </div>
            </div>
            <div class="p-6 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium">Dr. Bio - Généraliste</p>
                        <p class="text-sm text-gray-500">10 Février 2024</p>
                        <p class="text-sm mt-2">Diagnostic : Consultation annuelle - RAS</p>
                        <p class="text-sm text-gray-600 mt-1">Prescription : Aucune</p>
                    </div>
                    <a href="#" class="text-primary hover:underline text-sm">Détails →</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section 5 : Ordonnances -->
    <div id="ordonnances" class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-prescription-bottle text-primary"></i>
                Ordonnances
            </h3>
            <a href="{{ route('patient.dossier.ordonnances') }}" class="text-sm text-primary hover:underline">Voir tout</a>
        </div>
        <div class="divide-y">
            <div class="p-6 flex justify-between items-center">
                <div>
                    <p class="font-medium">Ordonnance du 15 Mars 2024</p>
                    <p class="text-sm text-gray-500">Dr. Adjanohoun</p>
                </div>
                <a href="#" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                    <i class="fas fa-download"></i> Télécharger
                </a>
            </div>
            <div class="p-6 flex justify-between items-center">
                <div>
                    <p class="font-medium">Ordonnance du 10 Février 2024</p>
                    <p class="text-sm text-gray-500">Dr. Bio</p>
                </div>
                <a href="#" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                    <i class="fas fa-download"></i> Télécharger
                </a>
            </div>
        </div>
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
            }
        });
    });
</script>
@endsection