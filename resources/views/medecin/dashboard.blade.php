@extends('layouts.app')

@section('title', 'Dashboard Médecin')
@section('header', 'Tableau de Bord - Médecin')

@section('content')
<div class="space-y-6">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4" style="border-left-color: var(--primary);">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Mes Patients</p>
                    <p class="text-3xl font-bold text-gray-800" id="totalPatients">0</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                    <i class="fas fa-users text-xl text-primary"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">RDV Aujourd'hui</p>
                    <p class="text-3xl font-bold text-gray-800" id="rdvToday">0</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-xl text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Consultations Mois</p>
                    <p class="text-3xl font-bold text-gray-800" id="consultationsMonth">0</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-notes-medical text-xl text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Taux d'occupation</p>
                    <p class="text-3xl font-bold text-gray-800" id="occupationRate">0%</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphique et Agenda -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Graphique d'activité -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Mes consultations (2024)</h3>
            <canvas id="myActivityChart" height="250"></canvas>
        </div>
        
        <!-- Agenda du jour -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Mon agenda - Aujourd'hui</h3>
            <div id="todaySchedule" class="space-y-3">
                <!-- Mock data -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-12 text-center">
                            <span class="text-sm font-medium">09:00</span>
                        </div>
                        <div>
                            <p class="font-medium">Jean Kouassi</p>
                            <p class="text-xs text-gray-500">Consultation générale</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmé</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-12 text-center">
                            <span class="text-sm font-medium">10:30</span>
                        </div>
                        <div>
                            <p class="font-medium">Marie Zinsou</p>
                            <p class="text-xs text-gray-500">Suivi grossesse</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">En attente</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-12 text-center">
                            <span class="text-sm font-medium">14:00</span>
                        </div>
                        <div>
                            <p class="font-medium">Amadou Diallo</p>
                            <p class="text-xs text-gray-500">Consultation urgente</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmé</span>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('medecin.rendez-vous.calendar') }}" class="text-primary hover:underline text-sm">Voir mon calendrier →</a>
            </div>
        </div>
    </div>
    
    <!-- Dernières consultations -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-semibold text-gray-800">Mes dernières consultations</h3>
            <a href="{{ route('medecin.consultations.index') }}" class="text-sm text-primary hover:underline">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnostic</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-6 py-4">15/03/2024</td>
                        <td class="px-6 py-4 font-medium">Jean Kouassi</td>
                        <td class="px-6 py-4">Hypertension artérielle</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-primary hover:underline text-sm">Voir détails</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">10/03/2024</td>
                        <td class="px-6 py-4 font-medium">Fatima Bello</td>
                        <td class="px-6 py-4">Vaccin enfant</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-primary hover:underline text-sm">Voir détails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique d'activité
    const ctx = document.getElementById('myActivityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Consultations',
                data: [12, 19, 15, 17, 14, 18],
                borderColor: '#0B5E42',
                backgroundColor: 'rgba(11, 94, 66, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    
    // Simuler des stats
    document.getElementById('totalPatients').textContent = '45';
    document.getElementById('rdvToday').textContent = '4';
    document.getElementById('consultationsMonth').textContent = '28';
    document.getElementById('occupationRate').textContent = '75%';
</script>
@endsection