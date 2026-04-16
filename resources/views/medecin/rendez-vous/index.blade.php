@extends('layouts.app')

@section('title', 'Mes Rendez-vous')
@section('header', 'Gestion des Rendez-vous')

@section('content')
<div class="space-y-6">
    
   <!-- En-tête avec vues -->
<div class="flex flex-col sm:flex-row justify-between items-center gap-4">
    <div class="flex gap-2">
        <a href="{{ route('medecin.rendez-vous.index') }}" class="px-4 py-2 rounded-lg transition" style="background-color: #0B5E42; color: white;">
            <i class="fas fa-list"></i> Vue Liste
        </a>
        <a href="{{ route('medecin.rendez-vous.calendar') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
            <i class="fas fa-calendar-alt"></i> Vue Calendrier
        </a>
    </div>
    
    <a href="{{ route('medecin.rendez-vous.create') }}" class="px-4 py-2 rounded-lg transition flex items-center gap-2" style="background-color: #0B5E42; color: white;">
        <i class="fas fa-plus"></i> Nouveau RDV
    </a>
</div>
    
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <select id="filterStatut" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Tous les statuts</option>
                <option value="en_attente">En attente</option>
                <option value="confirme">Confirmé</option>
                <option value="termine">Terminé</option>
                <option value="annule">Annulé</option>
            </select>
            
            <input type="date" id="filterDate" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
            
            <input type="text" id="searchPatient" placeholder="Rechercher un patient..." class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
            
            <button id="resetFilters" class="border rounded-lg px-3 py-2 hover:bg-gray-50 transition">
                <i class="fas fa-undo-alt"></i> Réinitialiser
            </button>
        </div>
    </div>
    
    <!-- Tableau des RDV -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date & Heure</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Motif</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="rdvTableBody" class="divide-y divide-gray-100">
                    <!-- Les données seront chargées dynamiquement -->
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div id="paginationContainer" class="px-6 py-4 border-t bg-gray-50 flex justify-between items-center flex-wrap gap-4">
            <!-- Pagination dynamique -->
        </div>
    </div>
</div>

<!-- Modal de modification de statut -->
<div id="statutModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-fade-in">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-exchange-alt text-primary"></i>
                Modifier le statut
            </h3>
            <select id="newStatut" class="w-full border rounded-lg px-3 py-2 mb-4 focus:ring-2 focus:ring-primary">
                <option value="en_attente">En attente</option>
                <option value="confirme">Confirmé</option>
                <option value="termine">Terminé</option>
                <option value="annule">Annulé</option>
            </select>
            <div class="flex gap-3">
                <button onclick="closeStatutModal()" class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 transition">Annuler</button>
                <button id="confirmStatutBtn" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let currentRdvId = null;
    let filters = {
        statut: '',
        date: '',
        patient: ''
    };
    
    // Données mockées
    const mockRdvs = [
        {
            id: 1,
            patient: { nom: 'Kouassi', prenom: 'Jean', telephone: '+229 97 12 34 56' },
            date: '2024-03-15',
            heure: '09:00',
            motif: 'Consultation générale',
            statut: 'confirme'
        },
        {
            id: 2,
            patient: { nom: 'Zinsou', prenom: 'Marie', telephone: '+229 94 56 78 90' },
            date: '2024-03-15',
            heure: '10:30',
            motif: 'Suivi grossesse',
            statut: 'confirme'
        },
        {
            id: 3,
            patient: { nom: 'Diallo', prenom: 'Amadou', telephone: '+229 91 23 45 67' },
            date: '2024-03-16',
            heure: '14:00',
            motif: 'Urgence',
            statut: 'en_attente'
        },
        {
            id: 4,
            patient: { nom: 'Bello', prenom: 'Fatima', telephone: '+229 97 89 01 23' },
            date: '2024-03-17',
            heure: '08:30',
            motif: 'Contrôle',
            statut: 'confirme'
        },
        {
            id: 5,
            patient: { nom: 'Amenan', prenom: 'Koffi', telephone: '+229 93 45 67 89' },
            date: '2024-03-18',
            heure: '15:30',
            motif: 'Vaccin',
            statut: 'termine'
        }
    ];
    
    const statutLabels = {
        'en_attente': 'En attente',
        'confirme': 'Confirmé',
        'termine': 'Terminé',
        'annule': 'Annulé'
    };
    
    const statutColors = {
        'en_attente': 'bg-yellow-100 text-yellow-700',
        'confirme': 'bg-green-100 text-green-700',
        'termine': 'bg-blue-100 text-blue-700',
        'annule': 'bg-red-100 text-red-700'
    };
    
    function loadRdvs() {
        let filtered = [...mockRdvs];
        
        if (filters.statut) {
            filtered = filtered.filter(rdv => rdv.statut === filters.statut);
        }
        if (filters.date) {
            filtered = filtered.filter(rdv => rdv.date === filters.date);
        }
        if (filters.patient) {
            filtered = filtered.filter(rdv => 
                rdv.patient.nom.toLowerCase().includes(filters.patient.toLowerCase()) ||
                rdv.patient.prenom.toLowerCase().includes(filters.patient.toLowerCase())
            );
        }
        
        const perPage = 5;
        const start = (currentPage - 1) * perPage;
        const paginated = filtered.slice(start, start + perPage);
        const total = filtered.length;
        const lastPage = Math.ceil(total / perPage);
        
        renderTable(paginated);
        renderPagination(currentPage, lastPage, total, start, perPage);
    }
    
    function renderTable(rdvs) {
        const tbody = document.getElementById('rdvTableBody');
        
        if (!rdvs || rdvs.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                        <p>Aucun rendez-vous trouvé</p>
                    </td>
                </tr>
            `;
            return;
        }
        
        tbody.innerHTML = rdvs.map(rdv => `
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-bold text-xs">
                            ${rdv.patient.prenom.charAt(0)}${rdv.patient.nom.charAt(0)}
                        </div>
                        <span class="font-medium text-gray-800">${rdv.patient.prenom} ${rdv.patient.nom}</span>
                    </div>
                  </td>
                <td class="px-6 py-4 text-sm">${rdv.patient.telephone}</td>
                <td class="px-6 py-4">
                    <span class="font-medium">${new Date(rdv.date).toLocaleDateString('fr-FR')}</span><br>
                    <span class="text-xs text-gray-500">${rdv.heure} - ${parseInt(rdv.heure.split(':')[0]) + 1}:${rdv.heure.split(':')[1]}</span>
                  </td>
                <td class="px-6 py-4 text-sm">${rdv.motif}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statutColors[rdv.statut]}">
                        ${statutLabels[rdv.statut]}
                    </span>
                  </td>
                <td class="px-6 py-4">
                    <div class="flex gap-3">
                        <a href="/medecin/rendez-vous/${rdv.id}" class="text-primary hover:text-primary-dark transition" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/medecin/consultations/create/${rdv.id}" class="text-success hover:text-success-dark transition" title="Ajouter consultation">
                            <i class="fas fa-notes-medical"></i>
                        </a>
                        <button onclick="openStatutModal(${rdv.id}, '${rdv.statut}')" class="text-warning hover:text-warning-dark transition" title="Modifier statut">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>
                  </td>
              </tr>
        `).join('');
    }
    
    function renderPagination(current, last, total, start, perPage) {
        const container = document.getElementById('paginationContainer');
        
        if (last <= 1) {
            container.innerHTML = '';
            return;
        }
        
        let pages = '';
        const maxVisible = 5;
        let startPage = Math.max(1, current - Math.floor(maxVisible / 2));
        let endPage = Math.min(last, startPage + maxVisible - 1);
        
        if (endPage - startPage + 1 < maxVisible) {
            startPage = Math.max(1, endPage - maxVisible + 1);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            pages += `
                <button onclick="goToPage(${i})" 
                        class="px-3 py-1 rounded transition ${current === i ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}">
                    ${i}
                </button>
            `;
        }
        
        container.innerHTML = `
            <div class="text-sm text-gray-500">
                Affichage de ${start + 1} à ${Math.min(start + perPage, total)} sur ${total} rendez-vous
            </div>
            <div class="flex gap-2 flex-wrap">
                <button onclick="goToPage(${current - 1})" 
                        ${current === 1 ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${current === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'} transition">
                    <i class="fas fa-chevron-left"></i> Précédent
                </button>
                ${pages}
                <button onclick="goToPage(${current + 1})" 
                        ${current === last ? 'disabled' : ''}
                        class="px-3 py-1 rounded bg-gray-200 text-gray-700 ${current === last ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-300'} transition">
                    Suivant <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        `;
    }
    
    function goToPage(page) {
        if (page < 1) return;
        currentPage = page;
        loadRdvs();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    function openStatutModal(rdvId, currentStatut) {
        currentRdvId = rdvId;
        document.getElementById('newStatut').value = currentStatut;
        document.getElementById('statutModal').classList.remove('hidden');
        document.getElementById('statutModal').classList.add('flex');
    }
    
    function closeStatutModal() {
        document.getElementById('statutModal').classList.add('hidden');
        document.getElementById('statutModal').classList.remove('flex');
        currentRdvId = null;
    }
    
    function updateStatut() {
        const newStatut = document.getElementById('newStatut').value;
        const rdv = mockRdvs.find(r => r.id === currentRdvId);
        if (rdv) {
            rdv.statut = newStatut;
            loadRdvs();
            showNotification('Statut mis à jour avec succès', 'success');
        }
        closeStatutModal();
    }
    
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
    
    function applyFilters() {
        filters.statut = document.getElementById('filterStatut').value;
        filters.date = document.getElementById('filterDate').value;
        filters.patient = document.getElementById('searchPatient').value;
        currentPage = 1;
        loadRdvs();
    }
    
    function resetFilters() {
        document.getElementById('filterStatut').value = '';
        document.getElementById('filterDate').value = '';
        document.getElementById('searchPatient').value = '';
        filters.statut = '';
        filters.date = '';
        filters.patient = '';
        currentPage = 1;
        loadRdvs();
    }
    
    document.getElementById('filterStatut').addEventListener('change', applyFilters);
    document.getElementById('filterDate').addEventListener('change', applyFilters);
    document.getElementById('searchPatient').addEventListener('input', applyFilters);
    document.getElementById('resetFilters').addEventListener('click', resetFilters);
    document.getElementById('confirmStatutBtn').addEventListener('click', updateStatut);
    
    // Chargement initial
    loadRdvs();
</script>
@endsection