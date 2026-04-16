@extends('layouts.app')

@section('title', 'Mes Patients')
@section('header', 'Liste de mes Patients')

@section('content')
<div class="space-y-6">
    
    <!-- Barre de recherche -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Rechercher par nom, prénom ou téléphone..." 
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
            </div>
            <select id="filterDate" class="border rounded-lg px-3 py-2">
                <option value="">Toutes les dates</option>
                <option value="today">Vus aujourd'hui</option>
                <option value="week">Cette semaine</option>
                <option value="month">Ce mois</option>
            </select>
        </div>
    </div>
    
    <!-- Stats rapides -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-primary">128</p>
            <p class="text-sm text-gray-500">Total patients</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-success">24</p>
            <p class="text-sm text-gray-500">Vus ce mois</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-warning">8</p>
            <p class="text-sm text-gray-500">Nouveaux</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-info">42</p>
            <p class="text-sm text-gray-500">Consultations</p>
        </div>
    </div>
    
    <!-- Liste des patients -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Dernière visite</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total RDV</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                                    <span class="text-primary font-bold">JK</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Jean Kouassi</p>
                                    <p class="text-xs text-gray-500">ID: PAT-001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm">+229 97 12 34 56</p>
                            <p class="text-xs text-gray-500">jean@email.com</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm">15/03/2024</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">8 RDV</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="#" class="text-primary hover:text-primary-dark" title="Dossier médical">
                                    <i class="fas fa-folder-medical"></i>
                                </a>
                                <a href="#" class="text-success hover:text-success-dark" title="Nouvelle consultation">
                                    <i class="fas fa-notes-medical"></i>
                                </a>
                                <a href="#" class="text-info hover:text-info-dark" title="Historique">
                                    <i class="fas fa-history"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center">
                                    <span class="text-secondary font-bold">MZ</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Marie Zinsou</p>
                                    <p class="text-xs text-gray-500">ID: PAT-002</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm">+229 94 56 78 90</p>
                            <p class="text-xs text-gray-500">marie@email.com</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm">10/03/2024</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">5 RDV</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="#" class="text-primary hover:text-primary-dark"><i class="fas fa-folder-medical"></i></a>
                                <a href="#" class="text-success hover:text-success-dark"><i class="fas fa-notes-medical"></i></a>
                                <a href="#" class="text-info hover:text-info-dark"><i class="fas fa-history"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 border-t bg-gray-50 flex justify-between items-center">
            <span class="text-sm text-gray-500">Affichage 1-5 sur 128 patients</span>
            <div class="flex gap-2">
                <button class="px-3 py-1 border rounded hover:bg-gray-100">Précédent</button>
                <button class="px-3 py-1 bg-primary text-white rounded">1</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">2</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">3</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">Suivant</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        console.log('Recherche:', e.target.value);
        // Implémenter la recherche AJAX
    });
</script>
@endsection