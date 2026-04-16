@extends('layouts.app')

@section('title', 'Mes Rendez-vous')
@section('header', 'Mes Rendez-vous')

@section('content')
<div class="space-y-6">
    
   <div class="flex justify-between items-center">
    <div class="flex gap-2">
        <button id="showUpcoming" style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);" class="px-4 py-2 text-white rounded-lg transition shadow-md">
            <i class="fas fa-calendar-day mr-1"></i> À venir
        </button>
        <button id="showPast" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-gray-700">
            <i class="fas fa-history mr-1"></i> Passés
        </button>
    </div>
    
    <a href="{{ route('patient.rendez-vous.create') }}" 
       style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);" 
       class="text-white px-4 py-2 rounded-lg transition flex items-center gap-2 shadow-md hover:shadow-lg">
        <i class="fas fa-plus"></i> Nouveau RDV
    </a>
</div>
    
    <!-- RDV à venir -->
    <div id="upcomingList" class="space-y-3">
        @php
            $upcomingRdvs = $rendezVous->filter(function($rdv) {
                return $rdv->date >= now()->toDateString() && $rdv->statut !== 'annule';
            });
        @endphp
        
        @forelse($upcomingRdvs as $rdv)
        <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                        <i class="fas fa-user-md text-xl text-primary"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">{{ $rdv->medecin->user->name ?? 'Dr. Inconnu' }}</p>
                        <p class="text-sm text-gray-500">{{ $rdv->medecin->specialite ?? 'Généraliste' }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $rdv->motif ?? 'Consultation' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-primary">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $rdv->heure }}</p>
                    @if($rdv->statut === 'confirme')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 mt-1 inline-block">Confirmé</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 mt-1 inline-block">En attente</span>
                    @endif
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('patient.rendez-vous.show', $rdv->id) }}" class="text-primary hover:text-primary-dark">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    @if($rdv->date >= now()->toDateString() && $rdv->statut !== 'annule')
                    <button onclick="cancelRdv({{ $rdv->id }})" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-8 text-center text-gray-500">
            <i class="fas fa-calendar-check text-4xl mb-2 text-gray-300"></i>
            <p>Aucun rendez-vous à venir</p>
            <a href="{{ route('patient.rendez-vous.create') }}" class="mt-3 inline-block text-primary hover:underline">
                Prendre un rendez-vous →
            </a>
        </div>
        @endforelse
    </div>
    
    <!-- RDV passés (caché par défaut) -->
    <div id="pastList" class="space-y-3 hidden">
        @php
            $pastRdvs = $rendezVous->filter(function($rdv) {
                return $rdv->date < now()->toDateString() || $rdv->statut === 'annule';
            });
        @endphp
        
        @forelse($pastRdvs as $rdv)
        <div class="bg-white rounded-xl shadow-lg p-4 opacity-75">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-user-md text-xl text-gray-500"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">{{ $rdv->medecin->user->name ?? 'Dr. Inconnu' }}</p>
                        <p class="text-sm text-gray-500">{{ $rdv->medecin->specialite ?? 'Généraliste' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-gray-500">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $rdv->heure }}</p>
                    @if($rdv->statut === 'termine')
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 mt-1 inline-block">Terminé</span>
                    @elseif($rdv->statut === 'annule')
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 mt-1 inline-block">Annulé</span>
                    @endif
                </div>
                <div>
                    <a href="{{ route('patient.rendez-vous.show', $rdv->id) }}" class="text-primary hover:underline text-sm">Détails</a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-8 text-center text-gray-500">
            <i class="fas fa-history text-4xl mb-2 text-gray-300"></i>
            <p>Aucun historique de rendez-vous</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    document.getElementById('showUpcoming').addEventListener('click', function() {
        document.getElementById('upcomingList').classList.remove('hidden');
        document.getElementById('pastList').classList.add('hidden');
        this.classList.add('bg-primary', 'text-white');
        this.classList.remove('border');
        document.getElementById('showPast').classList.remove('bg-primary', 'text-white');
        document.getElementById('showPast').classList.add('border');
    });
    
    document.getElementById('showPast').addEventListener('click', function() {
        document.getElementById('pastList').classList.remove('hidden');
        document.getElementById('upcomingList').classList.add('hidden');
        this.classList.add('bg-primary', 'text-white');
        this.classList.remove('border');
        document.getElementById('showUpcoming').classList.remove('bg-primary', 'text-white');
        document.getElementById('showUpcoming').classList.add('border');
    });
    
    function cancelRdv(id) {
        if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
            window.location.href = '/patient/rendez-vous/' + id;
        }
    }
</script>
@endsection