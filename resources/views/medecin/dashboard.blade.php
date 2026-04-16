@extends('layouts.app')

@section('title', 'Dashboard Médecin')
@section('header', 'Tableau de Bord - Médecin')

@section('content')
<div class="space-y-6">
    
   <!-- Bienvenue personnalisée -->
<div style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);" class="rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">Bonjour, Dr. {{ Auth::user()->name }}</h2>
            <p class="text-white font-medium mt-1">Voici votre activité du jour</p>
            <div class="mt-3 flex items-center gap-2 text-sm text-white">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ now()->format('l d F Y') }}</span>
                <i class="fas fa-clock ml-2"></i>
                <span>{{ now()->format('H:i') }}</span>
            </div>
        </div>
        <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
            <i class="fas fa-user-md text-3xl text-white"></i>
        </div>
    </div>
</div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Carte Patients -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#0B5E42] to-[#074231] text-white transform hover:scale-105 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Mes Patients</p>
                        <p class="text-4xl font-bold">{{ $totalPatients ?? 128 }}</p>
                        <p class="text-xs text-white/60 mt-2">
                            <i class="fas fa-user-plus"></i> +8 ce mois
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carte RDV Aujourd'hui -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#F59E0B] to-[#D97706] text-white transform hover:scale-105 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">RDV Aujourd'hui</p>
                        <p class="text-4xl font-bold">{{ $rdvAujourdhui ?? 6 }}</p>
                        <p class="text-xs text-white/60 mt-2">
                            <i class="fas fa-clock"></i> Prochain dans 30 min
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carte Consultations Mois -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#3B82F6] to-[#2563EB] text-white transform hover:scale-105 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Consultations</p>
                        <p class="text-4xl font-bold">{{ $consultationsMois ?? 42 }}</p>
                        <p class="text-xs text-white/60 mt-2">ce mois</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-notes-medical text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carte Taux Occupation -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#10B981] to-[#059669] text-white transform hover:scale-105 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Taux d'occupation</p>
                        <p class="text-4xl font-bold">{{ $tauxOccupation ?? 78 }}%</p>
                        <p class="text-xs text-white/60 mt-2">aujourd'hui</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Agenda et Graphique -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Agenda du jour -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-calendar-day text-primary"></i>
                    Mon agenda - Aujourd'hui
                    <span class="ml-auto text-xs text-gray-500">{{ now()->format('d/m/Y') }}</span>
                </h3>
            </div>
            <div class="divide-y max-h-96 overflow-y-auto">
                @forelse($rdvAujourdhuiList ?? [
                    (object)['heure' => '08:30', 'patient' => (object)['nom' => 'Jean Kouassi', 'prenom' => 'Jean'], 'motif' => 'Consultation générale', 'statut' => 'confirme'],
                    (object)['heure' => '09:30', 'patient' => (object)['nom' => 'Zinsou', 'prenom' => 'Marie'], 'motif' => 'Suivi grossesse', 'statut' => 'confirme'],
                    (object)['heure' => '10:30', 'patient' => (object)['nom' => 'Diallo', 'prenom' => 'Amadou'], 'motif' => 'Urgence', 'statut' => 'en_attente'],
                    (object)['heure' => '14:00', 'patient' => (object)['nom' => 'Bello', 'prenom' => 'Fatima'], 'motif' => 'Contrôle', 'statut' => 'confirme'],
                    (object)['heure' => '15:30', 'patient' => (object)['nom' => 'Amenan', 'prenom' => 'Koffi'], 'motif' => 'Vaccin', 'statut' => 'confirme'],
                ] as $rdv)
                <div class="p-4 hover:bg-gray-50 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-14 text-center">
                                <span class="text-lg font-bold text-primary">{{ substr($rdv->heure, 0, 5) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $rdv->patient->prenom }} {{ $rdv->patient->nom }}</p>
                                <p class="text-sm text-gray-500">{{ $rdv->motif }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-2 py-1 text-xs rounded-full {{ $rdv->statut == 'confirme' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $rdv->statut == 'confirme' ? 'Confirmé' : 'En attente' }}
                            </span>
                            <a href="#" class="text-primary hover:text-primary-dark">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-calendar-check text-4xl mb-2 text-gray-300"></i>
                    <p>Aucun rendez-vous aujourd'hui</p>
                </div>
                @endforelse
            </div>
            <div class="p-4 bg-gray-50 border-t text-center">
                <a href="{{ route('medecin.rendez-vous.calendar') }}" class="text-primary hover:underline text-sm flex items-center justify-center gap-1">
                    Voir mon calendrier complet <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
        
        <!-- Graphique d'activité -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-chart-line text-primary"></i>
                    Mon activité (2024)
                </h3>
                <select class="text-sm border rounded-lg px-2 py-1 focus:ring-2 focus:ring-primary">
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>
            <canvas id="activityChart" height="250"></canvas>
            <div class="mt-4 pt-3 border-t text-center text-sm text-gray-500">
                <i class="fas fa-chart-simple"></i> Évolution de vos consultations
            </div>
        </div>
    </div>
    
    <!-- Prochains Rendez-vous et Actions rapides -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Prochains RDV (cette semaine) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-calendar-week text-primary"></i>
                    Prochains rendez-vous (cette semaine)
                </h3>
                <a href="{{ route('medecin.rendez-vous.index') }}" class="text-sm text-primary hover:underline">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Patient</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Heure</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Motif</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr>
                            <td class="px-6 py-4">15/03/2024</td>
                            <td class="px-6 py-4 font-medium">Jean Kouassi</td>
                            <td class="px-6 py-4">09:00</td>
                            <td class="px-6 py-4">Consultation générale</td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">16/03/2024</td>
                            <td class="px-6 py-4 font-medium">Marie Zinsou</td>
                            <td class="px-6 py-4">10:30</td>
                            <td class="px-6 py-4">Suivi grossesse</td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">17/03/2024</td>
                            <td class="px-6 py-4 font-medium">Amadou Diallo</td>
                            <td class="px-6 py-4">14:00</td>
                            <td class="px-6 py-4">Urgence</td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-bolt text-primary"></i>
                Actions rapides
            </h3>
            <div class="space-y-3">
                <a href="{{ route('medecin.rendez-vous.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all duration-200 group">
                    <i class="fas fa-calendar-plus w-5 group-hover:text-white"></i>
                    <span>Prendre un rendez-vous</span>
                    <i class="fas fa-arrow-right ml-auto text-sm"></i>
                </a>
                <a href="{{ route('medecin.consultations.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-secondary/10 text-secondary hover:bg-secondary hover:text-white transition-all duration-200 group">
                    <i class="fas fa-notes-medical w-5 group-hover:text-white"></i>
                    <span>Ajouter une consultation</span>
                    <i class="fas fa-arrow-right ml-auto text-sm"></i>
                </a>
                <a href="{{ route('medecin.patients.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-info/10 text-info hover:bg-info hover:text-white transition-all duration-200 group">
                    <i class="fas fa-users w-5 group-hover:text-white"></i>
                    <span>Voir mes patients</span>
                    <i class="fas fa-arrow-right ml-auto text-sm"></i>
                </a>
                <a href="{{ route('medecin.disponibilites.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-success/10 text-success hover:bg-success hover:text-white transition-all duration-200 group">
                    <i class="fas fa-clock w-5 group-hover:text-white"></i>
                    <span>Gérer mes disponibilités</span>
                    <i class="fas fa-arrow-right ml-auto text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Mes consultations',
                    data: [8, 12, 15, 18, 22, 25, 28, 30, 32, 35, 38, 42],
                    borderColor: '#0B5E42',
                    backgroundColor: 'rgba(11, 94, 66, 0.05)',
                    borderWidth: 3,
                    pointBackgroundColor: '#0B5E42',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true }
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleColor: '#fff',
                        bodyColor: '#9CA3AF'
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { drawBorder: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection