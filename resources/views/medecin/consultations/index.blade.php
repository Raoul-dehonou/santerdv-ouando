@extends('layouts.app')

@section('title', 'Mes Consultations')
@section('header', 'Historique des Consultations')

@section('content')
<div class="space-y-6">
    
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex flex-col sm:flex-row gap-4">
            <input type="date" id="filterDate" class="border rounded-lg px-3 py-2" placeholder="Filtrer par date">
            <input type="text" id="searchPatient" placeholder="Rechercher un patient..." class="flex-1 border rounded-lg px-3 py-2">
            <button id="resetFilters" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Réinitialiser</button>
        </div>
    </div>
    
    <!-- Liste des consultations -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Diagnostic</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-6 py-4">15/03/2024</td>
                        <td class="px-6 py-4 font-medium">Jean Kouassi</td>
                        <td class="px-6 py-4">Hypertension artérielle</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('medecin.consultations.show', 1) }}" class="text-primary hover:text-primary-dark">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">10/03/2024</td>
                        <td class="px-6 py-4 font-medium">Marie Zinsou</td>
                        <td class="px-6 py-4">Consultation annuelle - RAS</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('medecin.consultations.show', 2) }}" class="text-primary hover:text-primary-dark">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('resetFilters')?.addEventListener('click', function() {
        document.getElementById('filterDate').value = '';
        document.getElementById('searchPatient').value = '';
    });
</script>
@endsection