@extends('layouts.app')

@section('title', 'Dossier Médical')
@section('header', 'Dossier Médical du Patient')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-notes-medical text-primary"></i>
            Dossier médical - Jean Kouassi
        </h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-medium text-gray-700">Antécédents</h4>
                <p class="text-gray-600 mt-1">Hypertension artérielle (2020)</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700">Allergies</h4>
                <p class="text-gray-600 mt-1">Aucune allergie connue</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700">Traitements en cours</h4>
                <p class="text-gray-600 mt-1">Lisinopril 10mg 1x/jour</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700">Groupe sanguin</h4>
                <p class="text-gray-600 mt-1">O+</p>
            </div>
        </div>
        
        <div class="mt-6 pt-4 border-t">
            <a href="{{ route('medecin.patients.show', 1) }}" class="text-primary hover:underline">← Retour à la fiche patient</a>
        </div>
    </div>
</div>
@endsection