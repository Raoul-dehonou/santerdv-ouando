@extends('layouts.app')

@section('title', 'Détail Patient')
@section('header', 'Fiche Patient')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Infos patient -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-white text-xl font-bold">Jean Kouassi</h2>
                    <p class="text-white/80">ID: PAT-001</p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium">+229 97 12 34 56</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">jean@email.com</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date naissance</p>
                    <p class="font-medium">15/06/1985</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Groupe sanguin</p>
                    <p class="font-medium">O+</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="flex gap-3">
        <a href="{{ route('medecin.consultations.create') }}" class="flex-1 text-center px-4 py-2 bg-success text-white rounded-lg hover:bg-success-dark">
            <i class="fas fa-notes-medical"></i> Nouvelle consultation
        </a>
        <a href="{{ route('medecin.patients.dossier', 1) }}" class="flex-1 text-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
            <i class="fas fa-folder-medical"></i> Dossier médical
        </a>
    </div>
    
    <!-- Dernières consultations -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="font-semibold text-gray-800">Dernières consultations</h3>
        </div>
        <div class="divide-y">
            <div class="p-4 flex justify-between items-center">
                <div>
                    <p class="font-medium">15/03/2024</p>
                    <p class="text-sm text-gray-500">Hypertension artérielle</p>
                </div>
                <a href="#" class="text-primary hover:underline">Voir détails</a>
            </div>
        </div>
    </div>
</div>
@endsection