@extends('layouts.app')

@section('title', 'Détail Rendez-vous')
@section('header', 'Fiche Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <h2 class="text-white text-xl font-bold">Rendez-vous #RDV-001</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Patient</p>
                    <p class="font-medium">Jean Kouassi</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date & Heure</p>
                    <p class="font-medium">15/03/2024 à 09:00</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Motif</p>
                    <p class="font-medium">Consultation générale</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Statut</p>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmé</span>
                </div>
            </div>
            
            <div class="flex gap-3 pt-4 border-t">
                <a href="{{ route('medecin.consultations.create') }}" class="flex-1 text-center px-4 py-2 bg-success text-white rounded-lg hover:bg-success-dark">
                    <i class="fas fa-notes-medical"></i> Ajouter consultation
                </a>
                <a href="{{ route('medecin.rendez-vous.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection