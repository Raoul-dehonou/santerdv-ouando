@extends('layouts.app')

@section('title', 'Statistiques')
@section('header', 'Tableau de Bord Statistique')

@section('content')
<div class="space-y-6">
    
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex flex-wrap gap-4 items-center">
            <select id="yearSelect" class="border rounded-lg px-3 py-2">
                <option value="2024">2028</option>
                <option value="2023">2027</option>
                <option value="2022">2026</option>
            </select>
            <button id="refreshStats" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                Actualiser
            </button>
        </div>
    </div>
    
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Patients</p>
                    <p class="text-3xl font-bold" id="totalPatients">156</p>
                    <p class="text-xs text-green-600 mt-1">+12% vs 2024</p>
                </div>
                <i class="fas fa-users text-3xl text-primary"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Consultations</p>
                    <p class="text-3xl font-bold" id="totalConsultations">342</p>
                    <p class="text-xs text-green-600 mt-1">+8% vs 2024</p>
                </div>
                <i class="fas fa-notes-medical text-3xl text-blue-500"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Taux d'occupation</p>
                    <p class="text-3xl font-bold" id="occupationRate">78%</p>
                    <p class="text-xs text-green-600 mt-1">+5% vs 2024</p>
                </div>
                <i class="fas fa-chart-line text-3xl text-yellow-500"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Médecins actifs</p>
                    <p class="text-3xl font-bold" id="activeDoctors">8</p>
                    <p class="text-xs text-green-600 mt-1">+2 cette année</p>
                </div>
                <i class="fas fa-user-md text-3xl text-green-500"></i>
            </div>
        </div>
    </div>
    
    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Consultations par mois -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Consultations par mois</h3>
            <canvas id="monthlyChart" height="250"></canvas>
        </div>
        
        <!-- Répartition par spécialité -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Répartition par spécialité</h3>
            <canvas id="specialtyChart" height="250"></canvas>
        </div>
    </div>
    
    <!-- Top Médecins -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-800">Top 5 médecins (consultations)</h3>
        </div>
        <div class="divide-y">
            <div class="p-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center font-bold">1</div>
                    <span class="font-medium">Dr. Adjanohoun</span>
                    <span class="text-sm text-gray-500">Cardiologue</span>
                </div>
                <span class="font-bold text-primary">142 consultations</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center font-bold">2</div>
                    <span class="font-medium">Dr. Bio</span>
                    <span class="text-sm text-gray-500">Généraliste</span>
                </div>
                <span class="font-bold text-primary">98 consultations</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center font-bold">3</div>
                    <span class="font-medium">Dr. Zinsou</span>
                    <span class="text-sm text-gray-500">Pédiatre</span>
                </div>
                <span class="font-bold text-primary">67 consultations</span>
            </div>
        </div>
    </div>
    
    <!-- Export -->
    <div class="flex justify-end">
        <button id="exportBtn" class="border border-primary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition flex items-center gap-2">
            <i class="fas fa-file-excel"></i>
            Exporter en Excel
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique mensuel
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Consultations 2024',
                data: [25, 28, 32, 30, 35, 32, 28, 30, 34, 36, 32, 30],
                backgroundColor: '#0B5E42',
                borderRadius: 8
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
    
    // Graphique des spécialités (camembert)
    const specialtyCtx = document.getElementById('specialtyChart').getContext('2d');
    new Chart(specialtyCtx, {
        type: 'doughnut',
        data: {
            labels: ['Cardiologie', 'Généraliste', 'Pédiatrie', 'Gynécologie', 'Autres'],
            datasets: [{
                data: [142, 98, 67, 45, 30],
                backgroundColor: ['#0B5E42', '#2D8C6A', '#F59E0B', '#3B82F6', '#10B981'],
                borderWidth: 0
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
    
    // Export
    document.getElementById('exportBtn').addEventListener('click', function() {
        showNotification('Export en cours de préparation...', 'success');
    });
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
</script>
@endsection