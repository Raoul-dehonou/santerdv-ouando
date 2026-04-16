@extends('layouts.app')

@section('title', 'Mes Consultations')
@section('header', 'Historique des Consultations')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-notes-medical text-primary"></i>
                Toutes mes consultations
            </h3>
        </div>
        
        <div class="divide-y">
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium text-gray-800">Dr. Adjanohoun - Cardiologue</p>
                        <p class="text-sm text-gray-500">15 Mars 2024</p>
                        <p class="text-sm mt-2 text-gray-600">Diagnostic : Hypertension artérielle stable</p>
                        <p class="text-sm text-gray-500 mt-1">Prescription : Lisinopril 10mg 1x/jour</p>
                    </div>
                    <a href="#" class="text-primary hover:underline text-sm">
                        Détails <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium text-gray-800">Dr. Bio - Généraliste</p>
                        <p class="text-sm text-gray-500">10 Février 2024</p>
                        <p class="text-sm mt-2 text-gray-600">Diagnostic : Consultation annuelle - RAS</p>
                        <p class="text-sm text-gray-500 mt-1">Prescription : Aucune</p>
                    </div>
                    <a href="#" class="text-primary hover:underline text-sm">
                        Détails <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center">
        <a href="{{ route('patient.dossier.index') }}" class="text-primary hover:underline">
            ← Retour à mon dossier médical
        </a>
    </div>
</div>
@endsection