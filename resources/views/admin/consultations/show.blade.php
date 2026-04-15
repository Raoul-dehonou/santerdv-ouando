@extends('layouts.app')

@section('title', 'Détail Consultation')
@section('header', 'Fiche Consultation')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        
        <!-- En-tête -->
        <div class="text-center mb-6">
            <div class="w-20 h-20 rounded-full bg-primary/20 mx-auto flex items-center justify-center mb-3">
                <i class="fas fa-notes-medical text-3xl text-primary"></i>
            </div>
            <h2 class="text-xl font-bold">Consultation du 15 Mars 2024</h2>
            <p class="text-gray-500">Dr. Adjanohoun - Cardiologue</p>
        </div>
        
        <!-- Infos patient -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-gray-800 mb-3">Informations patient</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nom complet</p>
                    <p class="font-medium">Jean Kouassi</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Âge</p>
                    <p class="font-medium">38 ans</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium">+229 97 12 34 56</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Groupe sanguin</p>
                    <p class="font-medium">O+</p>
                </div>
            </div>
        </div>
        
        <!-- Consultation -->
        <div class="space-y-4">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Symptômes / Plaintes</h3>
                <p class="text-gray-600">Patient se plaint de fatigue et de maux de tête occasionnels.</p>
            </div>
            
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Examen clinique</h3>
                <p class="text-gray-600">Tension: 120/80, Pouls: 72, Température: 36.8°C</p>
            </div>
            
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Diagnostic</h3>
                <p class="text-gray-600">Hypertension artérielle stable, bon contrôle sous traitement actuel.</p>
            </div>
            
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Prescription</h3>
                <p class="text-gray-600">Maintenir Lisinopril 10mg 1x/jour. Contrôle dans 1 mois.</p>
            </div>
            
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Examens complémentaires</h3>
                <p class="text-gray-600">Bilan sanguin à faire dans 2 semaines.</p>
            </div>
        </div>
        
        <!-- Boutons -->
        <div class="flex justify-between gap-3 mt-6 pt-4 border-t">
            <a href="{{ route('admin.consultations.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                Retour à la liste
            </a>
            <button onclick="window.print()" class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition">
                <i class="fas fa-print"></i> Imprimer
            </button>
        </div>
    </div>
</div>
@endsection