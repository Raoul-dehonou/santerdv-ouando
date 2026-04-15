@extends('layouts.app')

@section('title', 'Gestion des Rendez-vous')
@section('header', 'Rendez-vous')

@section('content')
<div class="space-y-6">
    
    <!-- En-tête -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex gap-2">
            <a href="{{ route('admin.rendez-vous.index') }}" 
               class="px-4 py-2 bg-primary text-white rounded-lg transition">
                <i class="fas fa-list"></i> Vue Liste
            </a>
            <a href="{{ route('admin.rendez-vous.calendar') }}" 
               class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-calendar-alt"></i> Vue Calendrier
            </a>
        </div>
        
        <a href="{{ route('admin.rendez-vous.create') }}" 
           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau RDV
        </a>
    </div>
    
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <select id="filterStatut" class="border rounded-lg px-3 py-2">
                <option value="">Tous les statuts</option>
                <option value="en_attente">En attente</option>
                <option value="confirme">Confirmé</option>
                <option value="termine">Terminé</option>
                <option value="annule">Annulé</option>
            </select>
            
            <input type="date" id="filterDate" class="border rounded-lg px-3 py-2" placeholder="Filtrer par date">
            
            <select id="filterMedecin" class="border rounded-lg px-3 py-2">
                <option value="">Tous les médecins</option>
                <option value="1">Dr. Adjanohoun</option>
                <option value="2">Dr. Bio</option>
                <option value="3">Dr. Zinsou</option>
            </select>
        </div>
    </div>
    
    <!-- Tableau des RDV -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Heure</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motif</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="rdvTableBody" class="divide-y">
                    <!-- Mock data -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Mock des rendez-vous
    const mockRdvs = [
        {
            id: 1,
            patient: { user: { name: 'Jean Kouassi' }, telephone: '+229 97 12 34 56' },
            medecin: { user: { name: 'Dr. Adjanohoun' }, specialite: 'Cardiologue' },
            date: '2024-03-15',
            heure: '09:00',
            motif: 'Consultation générale',
            statut: 'confirme'
        },
        {
            id: 2,
            patient: { user: { name: 'Marie Zinsou' }, telephone: '+229 94 56 78 90' },
            medecin: { user: { name: 'Dr. Bio' }, specialite: 'Généraliste' },
            date: '2024-03-15',
            heure: '10:30',
            motif: 'Suivi grossesse',
            statut: 'en_attente'
        },
        {
            id: 3,
            patient: { user: { name: 'Amadou Diallo' }, telephone: '+229 91 23 45 67' },
            medecin: { user: { name: 'Dr. Adjanohoun' }, specialite: 'Cardiologue' },
            date: '2024-03-16',
            heure: '14:00',
            motif: 'Urgence',
            statut: 'confirme'
        },
        {
            id: 4,
            patient: { user: { name: 'Fatima Bello' }, telephone: '+229 97 89 01 23' },
            medecin: { user: { name: 'Dr. Zinsou' }, specialite: 'Pédiatre' },
            date: '2024-03-17',
            heure: '08:30',
            motif: 'Vaccin enfant',
            statut: 'termine'
        }
    ];
    
    const statutColors = {
        'en_attente': 'bg-yellow-100 text-yellow-700',
        'confirme': 'bg-green-100 text-green-700',
        'annule': 'bg-red-100 text-red-700',
        'termine': 'bg-blue-100 text-blue-700'
    };
    
    function renderRdvs() {
        let filtered = [...mockRdvs];
        
        const statut = document.getElementById('filterStatut').value;
        const date = document.getElementById('filterDate').value;
        
        if (statut) {
            filtered = filtered.filter(rdv => rdv.statut === statut);
        }
        if (date) {
            filtered = filtered.filter(rdv => rdv.date === date);
        }
        
        const tbody = document.getElementById('rdvTableBody');
        
        if (filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucun rendez-vous</td></tr>';
            return;
        }
        
        tbody.innerHTML = filtered.map(rdv => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-medium">${rdv.patient.user.name}</p>
                        <p class="text-xs text-gray-500">${rdv.patient.telephone}</p>
                    </div>
                 </td>
                <td class="px-6 py-4">
                    <div>
                        <p>${rdv.medecin.user.name}</p>
                        <p class="text-xs text-gray-500">${rdv.medecin.specialite}</p>
                    </div>
                 </td>
                <td class="px-6 py-4">
                    ${new Date(rdv.date).toLocaleDateString('fr-FR')}<br>
                    <span class="text-xs text-gray-500">${rdv.heure}</span>
                 </td>
                <td class="px-6 py-4">${rdv.motif}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full ${statutColors[rdv.statut]}">
                        ${rdv.statut === 'en_attente' ? 'En attente' : rdv.statut === 'confirme' ? 'Confirmé' : rdv.statut === 'termine' ? 'Terminé' : 'Annulé'}
                    </span>
                 </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="/admin/rendez-vous/${rdv.id}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button onclick="updateStatut(${rdv.id}, 'termine')" class="text-green-600 hover:text-green-800" title="Marquer terminé">
                            <i class="fas fa-check"></i>
                        </button>
                        <button onclick="updateStatut(${rdv.id}, 'annule')" class="text-red-600 hover:text-red-800" title="Annuler">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                 </td>
             </tr>
        `).join('');
    }
    
    function updateStatut(id, newStatut) {
        const rdv = mockRdvs.find(r => r.id === id);
        if (rdv) {
            rdv.statut = newStatut;
            renderRdvs();
            showNotification('Statut mis à jour', 'success');
        }
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
    
    document.getElementById('filterStatut').addEventListener('change', renderRdvs);
    document.getElementById('filterDate').addEventListener('change', renderRdvs);
    
    renderRdvs();
</script>
@endsection