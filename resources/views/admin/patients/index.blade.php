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
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date naissance</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dernier RDV</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="patientsTableBody" class="divide-y divide-gray-100">
                    <!-- Les données seront chargées via AJAX -->
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="loader mx-auto"></div>
                            <p class="mt-3">Chargement des patients...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t bg-gray-50">
            <div id="paginationLinks" class="flex justify-between items-center flex-wrap gap-4">
                <!-- La pagination sera chargée dynamiquement -->
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-fade-in">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 mx-auto flex items-center justify-center mb-4">
                <i class="fas fa-trash-alt text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Confirmer la suppression</h3>
            <p class="text-gray-500 mb-6">Êtes-vous sûr de vouloir supprimer ce patient ? Cette action est irréversible.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 transition">Annuler</button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let searchTerm = '';
    let patientToDelete = null;
    
    // Données mockées pour le développement (à remplacer par API)
    const mockPatients = [
        {
            id: 1,
            user: { name: 'Jean Kouassi', email: 'jean.kouassi@email.com' },
            profession: 'Enseignant',
            telephone: '+229 97 12 34 56',
            date_naissance: '1985-06-15',
            last_appointment: '15/03/2024'
        },
        {
            id: 2,
            user: { name: 'Marie Zinsou', email: 'marie.zinsou@email.com' },
            profession: 'Infirmière',
            telephone: '+229 94 56 78 90',
            date_naissance: '1990-11-22',
            last_appointment: '12/03/2024'
        },
        {
            id: 3,
            user: { name: 'Amadou Diallo', email: 'amadou.diallo@email.com' },
            profession: 'Commerçant',
            telephone: '+229 91 23 45 67',
            date_naissance: '1978-03-30',
            last_appointment: '10/03/2024'
        },
        {
            id: 4,
            user: { name: 'Fatima Bello', email: 'fatima.bello@email.com' },
            profession: 'Médecin',
            telephone: '+229 97 89 01 23',
            date_naissance: '1982-09-05',
            last_appointment: '14/03/2024'
        },
        {
            id: 5,
            user: { name: 'Koffi Amenan', email: 'koffi.amenan@email.com' },
            profession: 'Étudiant',
            telephone: '+229 93 45 67 89',
            date_naissance: '2000-12-18',
            last_appointment: '08/03/2024'
        }
    ];
    
    // Charger les patients (avec mock pour le développement)
    function loadPatients() {
        // Simuler un délai de chargement
        setTimeout(() => {
            let filteredPatients = [...mockPatients];
            
            // Filtre par recherche
            if (searchTerm) {
                filteredPatients = mockPatients.filter(p => 
                    p.user.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    (p.telephone && p.telephone.includes(searchTerm))
                );
            }
            
            // Pagination
            const perPage = 10;
            const start = (currentPage - 1) * perPage;
            const paginatedPatients = filteredPatients.slice(start, start + perPage);
            const total = filteredPatients.length;
            const lastPage = Math.ceil(total / perPage);
            
            renderTable(paginatedPatients);
            renderPagination({
                current_page: currentPage,
                last_page: lastPage,
                total: total,
                from: start + 1,
                to: Math.min(start + perPage, total)
            });
        }, 500);
    }
    
    // Rendre le tableau
    function renderTable(patients) {
        const tbody = document.getElementById('patientsTableBody');
        
        if (!patients || patients.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-user-slash text-4xl mb-3 text-gray-300"></i>
                        <p>Aucun patient trouvé</p>
                    </td>
                </tr>
            `;
            return;
        }
        
        tbody.innerHTML = patients.map(patient => `
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 text-sm font-medium text-gray-800">#${patient.id}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold">
                            ${patient.user.name.charAt(0)}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">${patient.user.name}</p>
                            <p class="text-xs text-gray-500">${patient.profession || 'Sans profession'}</p>
                        </div>
                    </div>
                 </td>
                <td class="px-6 py-4">
                    <p class="text-sm">${patient.telephone || 'Non renseigné'}</p>
                    <p class="text-xs text-gray-500">${patient.user.email}</p>
                 </td>
                <td class="px-6 py-4 text-sm">${patient.date_naissance ? new Date(patient.date_naissance).toLocaleDateString('fr-FR') : 'N/A'}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">${patient.last_appointment || 'Aucun RDV'}</span>
                 </td>
                <td class="px-6 py-4">
                    <div class="flex gap-3">
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
                        <button onclick="openDeleteModal(${patient.id})" 
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
        const maxVisible = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        let endPage = Math.min(data.last_page, startPage + maxVisible - 1);
        
        if (endPage - startPage + 1 < maxVisible) {
            startPage = Math.max(1, endPage - maxVisible + 1);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            pages += `
                <button onclick="goToPage(${i})" 
                        class="px-3 py-1 rounded transition ${currentPage === i ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}">
                    ${i}
                </button>
            `;
        }
        
        paginationDiv.innerHTML = `
            <div class="text-sm text-gray-500">
                Affichage de ${data.from || 0} à ${data.to || 0} sur ${data.total} patients
            </div>
            <div class="flex gap-2 flex-wrap">
                <button onclick="goToPage(${currentPage - 1})" 
                        ${currentPage === 1 ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'} transition">
                    <i class="fas fa-chevron-left"></i> Précédent
                </button>
                ${pages}
                <button onclick="goToPage(${currentPage + 1})" 
                        ${currentPage === data.last_page ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${currentPage === data.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'} transition">
                    Suivant <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        `;
    }
    
    // Changer de page
    function goToPage(page) {
        if (page < 1) return;
        currentPage = page;
        loadPatients();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    // Ouvrir modal de suppression
    function openDeleteModal(patientId) {
        patientToDelete = patientId;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    // Fermer modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        patientToDelete = null;
    }
    
    // Supprimer un patient
    function deletePatient(id) {
        const patient = mockPatients.find(p => p.id === id);
        if (patient) {
            const index = mockPatients.indexOf(patient);
            mockPatients.splice(index, 1);
            loadPatients();
            showNotification('Patient supprimé avec succès', 'success');
        }
        closeDeleteModal();
    }
    
    // Confirmation suppression
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (patientToDelete) {
            deletePatient(patientToDelete);
        }
    });
    
    // Recherche en temps réel
    document.getElementById('searchInput').addEventListener('input', (e) => {
        searchTerm = e.target.value;
        currentPage = 1;
        loadPatients();
    });
    
    // Notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-24 right-4 z-50 px-5 py-3 rounded-xl shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white animate-fade-in flex items-center gap-2`;
        notification.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${message}`;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            notification.style.transition = 'all 0.3s';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Charger au démarrage
    loadPatients();
</script>
@endsection