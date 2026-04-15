@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Tableau de Bord')

@section('content')
<div class="space-y-6">
    
    <!-- Stats Cards avec dégradés -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Carte Patients -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#0B5E42] to-[#074231] text-white transform hover:scale-105 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Total Patients</p>
                        <p class="text-4xl font-bold">{{ $totalPatients ?? 156 }}</p>
                        <p class="text-xs text-white/60 mt-2">
                            <i class="fas fa-arrow-up"></i> +12% ce mois
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/20">
                    <p class="text-xs text-white/60">Dernier patient ajouté aujourd'hui</p>
                </div>
            </div>
        </div>
        
        <!-- Carte RDV Aujourd'hui -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#F59E0B] to-[#D97706] text-white transform hover:scale-105 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">RDV Aujourd'hui</p>
                        <p class="text-4xl font-bold">{{ $rdvAujourdhui ?? 12 }}</p>
                        <p class="text-xs text-white/60 mt-2">sur {{ $totalRdvsMois ?? 342 }} ce mois</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/20">
                    <p class="text-xs text-white/60">Prochain RDV dans 30 min</p>
                </div>
            </div>
        </div>
        
        <!-- Carte Médecins -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#3B82F6] to-[#2563EB] text-white transform hover:scale-105 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Médecins Actifs</p>
                        <p class="text-4xl font-bold">{{ $medecinsActifs ?? 8 }}</p>
                        <p class="text-xs text-white/60 mt-2">+{{ $nouveauxMedecins ?? 2 }} ce trimestre</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
                        <i class="fas fa-user-md text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/20">
                    <p class="text-xs text-white/60">Disponibles aujourd'hui: 6</p>
                </div>
            </div>
        </div>
        
        <!-- Carte Consultations -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-gradient-to-br from-[#10B981] to-[#059669] text-white transform hover:scale-105 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-sm mb-1">Consultations</p>
                        <p class="text-4xl font-bold">{{ $consultationsMois ?? 89 }}</p>
                        <p class="text-xs text-white/60 mt-2">ce mois</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">
                        <i class="fas fa-notes-medical text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/20">
                    <p class="text-xs text-white/60">Moyenne: 3 consultations/jour</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts & Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Graphique Consultations -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-chart-line text-primary"></i>
                    Consultations par mois
                </h3>
                <select class="text-sm border rounded-lg px-2 py-1 focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option>2028</option>
                    <option>2027</option>
                    <option>2026</option>
                </select>
            </div>
            <canvas id="consultationsChart" height="250"></canvas>
        </div>
        
        <!-- Top Médecins -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-trophy text-yellow-500"></i>
                Top Médecins (RDV)
            </h3>
            <div class="space-y-4">
                @forelse($topMedecins ?? [
                    (object)['name' => 'Dr. Adjanohoun', 'specialite' => 'Cardiologue', 'total_rdv' => 45],
                    (object)['name' => 'Dr. Bio', 'specialite' => 'Généraliste', 'total_rdv' => 38],
                    (object)['name' => 'Dr. Zinsou', 'specialite' => 'Pédiatre', 'total_rdv' => 32],
                    (object)['name' => 'Dr. Houndjo', 'specialite' => 'Gynécologue', 'total_rdv' => 28],
                ] as $index => $medecin)
                <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white
                            {{ $index == 0 ? 'bg-yellow-500' : ($index == 1 ? 'bg-gray-400' : ($index == 2 ? 'bg-amber-600' : 'bg-primary/20 text-primary')) }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <i class="fas fa-user-md text-primary"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $medecin->name }}</p>
                            <p class="text-xs text-gray-500">{{ $medecin->specialite }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-xl text-primary">{{ $medecin->total_rdv }}</p>
                        <p class="text-xs text-gray-500">RDV</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Prochains Rendez-vous -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6 border-b flex justify-between items-center bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-calendar-alt text-primary"></i>
                Prochains Rendez-vous
            </h3>
            <a href="{{ route('admin.rendez-vous.index') }}" class="text-sm text-primary hover:text-primary-dark flex items-center gap-1 transition-colors">
                Voir tout <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Médecin</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Heure</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($prochainsRdvs ?? [
                        (object)['patient' => (object)['user' => (object)['name' => 'Jean Kouassi']], 'medecin' => (object)['user' => (object)['name' => 'Dr. Adjanohoun']], 'date' => '2024-03-15', 'heure' => '09:00', 'statut' => 'confirme'],
                        (object)['patient' => (object)['user' => (object)['name' => 'Marie Zinsou']], 'medecin' => (object)['user' => (object)['name' => 'Dr. Bio']], 'date' => '2024-03-15', 'heure' => '10:30', 'statut' => 'en_attente'],
                        (object)['patient' => (object)['user' => (object)['name' => 'Amadou Diallo']], 'medecin' => (object)['user' => (object)['name' => 'Dr. Adjanohoun']], 'date' => '2024-03-16', 'heure' => '14:00', 'statut' => 'confirme'],
                        (object)['patient' => (object)['user' => (object)['name' => 'Fatima Bello']], 'medecin' => (object)['user' => (object)['name' => 'Dr. Zinsou']], 'date' => '2024-03-17', 'heure' => '08:30', 'statut' => 'termine'],
                    ] as $rdv)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white text-xs font-medium">
                                    {{ substr($rdv->patient->user->name ?? 'N/A', 0, 1) }}
                                </div>
                                <span class="font-medium text-gray-800">{{ $rdv->patient->user->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-stethoscope text-primary text-xs"></i>
                                <span>{{ $rdv->medecin->user->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</span>
                                <span class="text-xs text-gray-500">{{ $rdv->heure }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statutColors = [
                                    'en_attente' => 'bg-yellow-100 text-yellow-700',
                                    'confirme' => 'bg-green-100 text-green-700',
                                    'annule' => 'bg-red-100 text-red-700',
                                    'termine' => 'bg-blue-100 text-blue-700'
                                ];
                                $statutLabels = [
                                    'en_attente' => 'En attente',
                                    'confirme' => 'Confirmé',
                                    'annule' => 'Annulé',
                                    'termine' => 'Terminé'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statutColors[$rdv->statut] ?? 'bg-gray-100 text-gray-700' }}">
                                <i class="fas {{ $rdv->statut == 'confirme' ? 'fa-check-circle' : ($rdv->statut == 'en_attente' ? 'fa-clock' : ($rdv->statut == 'termine' ? 'fa-check-double' : 'fa-times-circle')) }} mr-1"></i>
                                {{ $statutLabels[$rdv->statut] ?? $rdv->statut }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-primary hover:text-primary-dark transition-colors flex items-center gap-1 text-sm">
                                Voir <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-2 text-gray-300"></i>
                            <p>Aucun rendez-vous programmé</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('consultationsChart').getContext('2d');
        
        // Données mockées pour le graphique
        const monthlyData = {{ json_encode($consultationsParMois ?? [25, 28, 32, 30, 35, 32, 28, 30, 34, 36, 32, 30]) }};
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Consultations 2024',
                    data: monthlyData,
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
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleColor: '#fff',
                        bodyColor: '#9CA3AF',
                        borderColor: '#0B5E42',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection