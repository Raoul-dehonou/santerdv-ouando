@extends('layouts.app')

@section('title', 'Gestion des Patients')
@section('header', 'Liste des Patients')

@section('content')
<div class="space-y-6">
    
    <!-- Barre d'actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <!-- Recherche -->
        <div class="relative w-full sm:w-96">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Rechercher un patient..." 
                   class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
        
        <!-- Bouton Ajouter -->
        <a href="{{ route('admin.patients.create') }}" 
           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau Patient
        </a>
    </div>
    
    <!-- Tableau des patients -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date naissance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernier RDV</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="patientsTableBody" class="divide-y divide-gray-200">
                    <!-- Les données seront chargées via AJAX -->
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                            </div>
                            <p class="mt-2">Chargement des patients...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            <div id="paginationLinks" class="flex justify-between items-center">
                <!-- La pagination sera chargée dynamiquement -->
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let searchTerm = '';
    
    // Charger les patients
    function loadPatients() {
        fetch(`/api/admin/patients?page=${currentPage}&search=${searchTerm}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data.data);
                renderPagination(data);
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('patientsTableBody').innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-red-500">
                            <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                            <p>Erreur lors du chargement des données</p>
                        </td>
                    </tr>
                `;
            });
    }
    
    // Rendre le tableau
    function renderTable(patients) {
        const tbody = document.getElementById('patientsTableBody');
        
        if (!patients || patients.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-user-slash text-2xl mb-2"></i>
                        <p>Aucun patient trouvé</p>
                    </td>
                </tr>
            `;
            return;
        }
        
        tbody.innerHTML = patients.map(patient => `
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm">#${patient.id}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">${patient.user?.name || 'N/A'}</p>
                            <p class="text-xs text-gray-500">${patient.profession || 'Sans profession'}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm">${patient.telephone || 'Non renseigné'}</p>
                    <p class="text-xs text-gray-500">${patient.user?.email || ''}</p>
                </td>
                <td class="px-6 py-4 text-sm">${patient.date_naissance ? new Date(patient.date_naissance).toLocaleDateString('fr-FR') : 'N/A'}</td>
                <td class="px-6 py-4 text-sm">${patient.last_appointment || 'Aucun RDV'}</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="/admin/patients/${patient.id}" 
                           class="text-blue-600 hover:text-blue-800 transition"
                           title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/admin/patients/${patient.id}/edit" 
                           class="text-green-600 hover:text-green-800 transition"
                           title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="deletePatient(${patient.id})" 
                                class="text-red-600 hover:text-red-800 transition"
                                title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }
    
    // Rendre la pagination
    function renderPagination(data) {
        const paginationDiv = document.getElementById('paginationLinks');
        
        if (data.last_page <= 1) {
            paginationDiv.innerHTML = '';
            return;
        }
        
        let pages = '';
        for (let i = 1; i <= data.last_page; i++) {
            pages += `
                <button onclick="goToPage(${i})" 
                        class="px-3 py-1 rounded ${currentPage === i ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'} transition">
                    ${i}
                </button>
            `;
        }
        
        paginationDiv.innerHTML = `
            <div class="text-sm text-gray-500">
                Affichage de ${data.from || 0} à ${data.to || 0} sur ${data.total} patients
            </div>
            <div class="flex gap-2">
                <button onclick="goToPage(${currentPage - 1})" 
                        ${currentPage === 1 ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'}">
                    Précédent
                </button>
                ${pages}
                <button onclick="goToPage(${currentPage + 1})" 
                        ${currentPage === data.last_page ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${currentPage === data.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'}">
                    Suivant
                </button>
            </div>
        `;
    }
    
    // Changer de page
    function goToPage(page) {
        if (page < 1) return;
        currentPage = page;
        loadPatients();
    }
    
    // Supprimer un patient
    function deletePatient(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce patient ? Cette action est irréversible.')) {
            fetch(`/api/admin/patients/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadPatients();
                    showNotification('Patient supprimé avec succès', 'success');
                } else {
                    showNotification('Erreur lors de la suppression', 'error');
                }
            });
        }
    }
    
    // Recherche en temps réel
    document.getElementById('searchInput').addEventListener('input', (e) => {
        searchTerm = e.target.value;
        currentPage = 1;
        loadPatients();
    });
    
    // Notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
    
    // Charger au démarrage
    loadPatients();
</script>
@endsection