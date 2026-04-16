@extends('layouts.app')

@section('title', 'Mon Espace Patient')
@section('header', 'Tableau de Bord')

@section('content')
<div class="space-y-6">
    
   <!-- Bienvenue -->
<div style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%); border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);" class="p-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">Bonjour, {{ Auth::user()->name }} 👋</h2>
            <p class="text-white font-medium mt-1">Bienvenue sur votre espace santé</p>
            <div class="mt-3 flex items-center gap-2 text-sm text-white">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ now()->format('l d F Y') }}</span>
                <i class="fas fa-clock ml-2"></i>
                <span>{{ now()->format('H:i') }}</span>
            </div>
        </div>
        <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
            <i class="fas fa-user-injured text-3xl text-white"></i>
        </div>
    </div>
</div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="relative overflow-hidden rounded-xl shadow-lg" style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);">
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Mes RDV</p>
                        <p class="text-4xl font-bold text-white">{{ $rendezVousAVenir->count() ?? 0 }}</p>
                        <p class="text-xs text-white/60 mt-2">à venir</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-hidden rounded-xl shadow-lg" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Consultations</p>
                        <p class="text-4xl font-bold text-white">{{ $nombreConsultations ?? 0 }}</p>
                        <p class="text-xs text-white/60 mt-2">total</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-notes-medical text-xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-hidden rounded-xl shadow-lg" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Prochain RDV</p>
                        @if($prochainRdv)
                            <p class="text-xl font-bold text-white">{{ \Carbon\Carbon::parse($prochainRdv->date)->format('d/m') }}</p>
                            <p class="text-xs text-white/60 mt-1">{{ $prochainRdv->heure }}</p>
                        @else
                            <p class="text-xl font-bold text-white">---</p>
                            <p class="text-xs text-white/60 mt-1">Aucun</p>
                        @endif
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-clock text-xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-hidden rounded-xl shadow-lg" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Dossier médical</p>
                        <p class="text-4xl font-bold text-white">✓</p>
                        <p class="text-xs text-white/60 mt-2">complet</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-folder-medical text-xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions rapides -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('patient.rendez-vous.create') }}" class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-full bg-primary/10 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-calendar-plus text-xl text-primary"></i>
            </div>
            <p class="text-sm font-medium text-gray-700">Prendre RDV</p>
        </a>
        
        <a href="{{ route('patient.rendez-vous.index') }}" class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-full bg-yellow-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-calendar-check text-xl text-yellow-600"></i>
            </div>
            <p class="text-sm font-medium text-gray-700">Mes RDV</p>
        </a>
        
        <a href="{{ route('patient.dossier.index') }}" class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-full bg-blue-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-folder-medical text-xl text-blue-600"></i>
            </div>
            <p class="text-sm font-medium text-gray-700">Mon Dossier</p>
        </a>
        
        <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-full bg-green-100 mx-auto flex items-center justify-center mb-2">
                <i class="fas fa-user-edit text-xl text-green-600"></i>
            </div>
            <p class="text-sm font-medium text-gray-700">Mon Profil</p>
        </a>
    </div>
    
    <!-- Prochain RDV et dernières consultations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Prochain rendez-vous -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    Prochain rendez-vous
                </h3>
            </div>
            <div class="p-6">
                @if($prochainRdv)
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-user-md text-2xl text-primary"></i>
                            </div>
                            <div>
                                <p class="font-bold text-lg text-gray-800">{{ $prochainRdv->medecin->user->name ?? 'Dr. Inconnu' }}</p>
                                <p class="text-sm text-gray-500">{{ $prochainRdv->medecin->specialite ?? 'Généraliste' }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $prochainRdv->motif ?? 'Consultation' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-primary">{{ \Carbon\Carbon::parse($prochainRdv->date)->format('d/m/Y') }}</p>
                            <p class="text-gray-500">{{ $prochainRdv->heure }}</p>
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 mt-2 inline-block">
                                {{ $prochainRdv->statut === 'confirme' ? 'Confirmé' : 'En attente' }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Aucun rendez-vous programmé</p>
                        <a href="{{ route('patient.rendez-vous.create') }}" class="mt-3 inline-block text-primary hover:underline">
                            Prendre un rendez-vous →
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Dernières consultations -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-notes-medical text-primary"></i>
                    Dernières consultations
                </h3>
               <a href="{{ route('patient.dossier.index') }}" class="text-sm text-primary hover:underline">Voir tout</a>
            </div>
            <div class="divide-y">
                @forelse($dernieresConsultations as $consultation)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">{{ $consultation->medecin->user->name ?? 'Dr. Inconnu' }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($consultation->diagnostic ?? 'Sans diagnostic', 50) }}</p>
                        </div>
                        <a href="#" class="text-primary hover:underline text-sm">Détails →</a>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-notes-medical text-3xl text-gray-300 mb-2"></i>
                    <p>Aucune consultation</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Informations rapides -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-info-circle text-primary"></i>
            Informations importantes
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-phone text-primary w-5"></i>
                <span>Urgence: <strong class="text-primary">+229 97 12 34 56</strong></span>
            </div>
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-clock text-primary w-5"></i>
                <span>Horaires: <strong>Lun-Ven: 08h-18h | Sam: 08h-13h</strong></span>
            </div>
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-location-dot text-primary w-5"></i>
                <span>Adresse: <strong>Cotonou, Bénin</strong></span>
            </div>
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-envelope text-primary w-5"></i>
                <span>Email: <strong>contact@ouandosante.bj</strong></span>
            </div>
        </div>
    </div>
</div>
@endsection