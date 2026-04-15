@extends('layouts.app')

@section('title', 'Mon Espace Patient')
@section('header', 'Tableau de Bord - Patient')

@section('content')
<div class="space-y-6">
    
    <!-- Bienvenue -->
    <div class="bg-gradient-to-r from-primary to-primary-dark rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Bonjour, Jean 👋</h2>
                <p class="opacity-90 mt-1">Bienvenue sur votre espace santé</p>
            </div>
            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fas fa-user-circle text-3xl text-white"></i>
            </div>
        </div>
    </div>
    
    <!-- Actions rapides -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('patient.rendez-vous.create') }}" class="bg-white rounded-xl shadow-sm p-4 text-center hover:shadow-md transition">
            <div class="w-12 h-12 rounded-full bg-primary/10 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-calendar-plus text-xl text-primary"></i>
            </div>
            <p class="text-sm font-medium">Prendre RDV</p>
        </a>
        
        <a href="{{ route('patient.rendez-vous.index') }}" class="bg-white rounded-xl shadow-sm p-4 text-center hover:shadow-md transition">
            <div class="w-12 h-12 rounded-full bg-yellow-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-calendar-check text-xl text-yellow-600"></i>
            </div>
            <p class="text-sm font-medium">Mes RDV</p>
        </a>
        
        <a href="{{ route('patient.dossier.index') }}" class="bg-white rounded-xl shadow-sm p-4 text-center hover:shadow-md transition">
            <div class="w-12 h-12 rounded-full bg-blue-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-folder-medical text-xl text-blue-600"></i>
            </div>
            <p class="text-sm font-medium">Mon Dossier</p>
        </a>
        
        <a href="{{ route('patient.profil.edit') }}" class="bg-white rounded-xl shadow-sm p-4 text-center hover:shadow-md transition">
            <div class="w-12 h-12 rounded-full bg-green-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-user-edit text-xl text-green-600"></i>
            </div>
            <p class="text-sm font-medium">Mon Profil</p>
        </a>
    </div>
    
    <!-- Prochain RDV -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-calendar-alt text-primary"></i>
                Prochain rendez-vous
            </h3>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                        <i class="fas fa-user-md text-2xl text-primary"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Dr. Adjanohoun</p>
                        <p class="font-bold text-lg">Cardiologue</p>
                        <p class="text-gray-600">Consultation de suivi</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-primary">15 Mars 2024</p>
                    <p class="text-gray-500">09:00 - 09:30</p>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 mt-2 inline-block">Confirmé</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Dernières infos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Dernières consultations -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <h3 class="font-semibold text-gray-800">Dernières consultations</h3>
            </div>
            <div class="divide-y">
                <div class="p-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium">Dr. Bio</p>
                            <p class="text-sm text-gray-500">10 Mars 2024</p>
                        </div>
                        <span class="text-sm text-primary">Voir détails →</span>
                    </div>
                    <p class="text-sm mt-2">Diagnostic : Hypertension artérielle stable</p>
                </div>
                <div class="p-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium">Dr. Zinsou</p>
                            <p class="text-sm text-gray-500">25 Février 2024</p>
                        </div>
                        <span class="text-sm text-primary">Voir détails →</span>
                    </div>
                    <p class="text-sm mt-2">Diagnostic : Consultation pédiatrique</p>
                </div>
            </div>
        </div>
        
        <!-- Informations personnelles -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <h3 class="font-semibold text-gray-800">Informations personnelles</h3>
            </div>
            <div class="p-6 space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nom complet :</span>
                    <span class="font-medium">Jean Kouassi</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Date naissance :</span>
                    <span class="font-medium">15/06/1985</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Téléphone :</span>
                    <span class="font-medium">+229 97 12 34 56</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Groupe sanguin :</span>
                    <span class="font-medium">O+</span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('patient.profil.edit') }}" class="text-primary hover:underline text-sm">Modifier mes informations →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection