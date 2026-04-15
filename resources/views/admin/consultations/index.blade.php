@extends('layouts.app')

@section('title', 'Gestion des Consultations')
@section('header', 'Liste des Consultations')

@section('content')
<div class="space-y-6">
    
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input type="date" id="filterDate" class="border rounded-lg px-3 py-2" placeholder="Filtrer par date">
            <select id="filterMedecin" class="border rounded-lg px-3 py-2">
                <option value="">Tous les médecins</option>
                <option value="1">Dr. Adjanohoun</option>
                <option value="2">Dr. Bio</option>
                <option value="3">Dr. Zinsou</option>
            </select>
            <button id="resetFilters" class="border rounded-lg px-3 py-2 hover:bg-gray-50">Réinitialiser</button>
        </div>
    </div>
    
    <!-- Tableau des consultations -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnostic</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="consultationsTableBody" class="divide-y">
                    <!-- Mock data -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Mock des consultations
    const mockConsultations = [
        {
            id: 1,
            date_consultation: '2024-03-15',
            patient: { user: { name: 'Jean Kouassi' } },
            medecin: { user: { name: 'Dr. Adjanohoun' }, specialite: 'Cardiologue' },
            diagnostic: 'Hypertension artérielle stable'
        },
        {
            id: 2,
            date_consultation: '2024-03-10',
            patient: { user: { name: 'Marie Zinsou' } },
            medecin: { user: { name: 'Dr. Bio' }, specialite: 'Généraliste' },
            diagnostic: 'Consultation annuelle - RAS'
        },
        {
            id: 3,
            date_consultation: '2024-03-05',
            patient: { user: { name: 'Amadou Diallo' } },
            medecin: { user: { name: 'Dr. Adjanohoun' }, specialite: 'Cardiologue' },
            diagnostic: 'Douleurs thoraciques'
        },
        {
            id: 4,
            date_consultation: '2024-02-28',
            patient: { user: { name: 'Fatima Bello' } },
            medecin: { user: { name: 'Dr. Zinsou' }, specialite: 'Pédiatre' },
            diagnostic: 'Vaccin enfant'
        }
    ];
    
    function renderConsultations() {
        const tbody = document.getElementById('consultationsTableBody');
        
        tbody.innerHTML = mockConsultations.map(consult => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">${new Date(consult.date_consultation).toLocaleDateString('fr-FR')}</td>
                <td class="px-6 py-4 font-medium">${consult.patient.user.name}</td>
                <td class="px-6 py-4">
                    ${consult.medecin.user.name}<br>
                    <span class="text-xs text-gray-500">${consult.medecin.specialite}</span>
                </td>
                <td class="px-6 py-4">${consult.diagnostic}</td>
                <td class="px-6 py-4">
                    <a href="/admin/consultations/${consult.id}" class="text-primary hover:underline text-sm">
                        <i class="fas fa-eye"></i> Détails
                    </a>
                </td>
            </tr>
        `).join('');
    }
    
    renderConsultations();
</script>
@endsection