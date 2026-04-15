@extends('layouts.app')

@section('title', 'Gestion des Médecins')
@section('header', 'Liste des Médecins')

@section('content')
<div class="space-y-6">
    
    <!-- Barre d'actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="relative w-full sm:w-96">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Rechercher un médecin..." 
                   class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        
        <a href="{{ route('admin.medecins.create') }}" 
           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau Médecin
        </a>
    </div>
    
    <!-- Tableau des médecins -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Spécialité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="medecinsTableBody">
                    <!-- Mock data -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Mock des médecins
    const mockMedecins = [
        {
            id: 1,
            user: { name: 'Dr. Adjanohoun', email: 'dr.adjanohoun@ouando.com' },
            specialite: 'Cardiologue',
            telephone: '+229 97 12 34 56',
            is_active: true
        },
        {
            id: 2,
            user: { name: 'Dr. Bio', email: 'dr.bio@ouando.com' },
            specialite: 'Généraliste',
            telephone: '+229 94 56 78 90',
            is_active: true
        },
        {
            id: 3,
            user: { name: 'Dr. Zinsou', email: 'dr.zinsou@ouando.com' },
            specialite: 'Pédiatre',
            telephone: '+229 91 23 45 67',
            is_active: true
        },
        {
            id: 4,
            user: { name: 'Dr. Houndjo', email: 'dr.houndjo@ouando.com' },
            specialite: 'Gynécologue',
            telephone: '+229 97 89 01 23',
            is_active: false
        }
    ];
    
    function renderMedecins() {
        const tbody = document.getElementById('medecinsTableBody');
        
        tbody.innerHTML = mockMedecins.map(medecin => `
            <tr class="hover:bg-gray-50 border-b">
                <td class="px-6 py-4 text-sm">#${medecin.id}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <i class="fas fa-user-md text-primary"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">${medecin.user.name}</p>
                            <p class="text-xs text-gray-500">${medecin.user.email}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">${medecin.specialite}</span>
                </td>
                <td class="px-6 py-4">${medecin.telephone}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full ${medecin.is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">
                        ${medecin.is_active ? 'Actif' : 'Inactif'}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="/admin/medecins/${medecin.id}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/admin/medecins/${medecin.id}/edit" class="text-green-600 hover:text-green-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="toggleStatus(${medecin.id})" class="text-yellow-600 hover:text-yellow-800">
                            <i class="fas ${medecin.is_active ? 'fa-ban' : 'fa-check-circle'}"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }
    
    function toggleStatus(id) {
        const medecin = mockMedecins.find(m => m.id === id);
        if (medecin) {
            medecin.is_active = !medecin.is_active;
            renderMedecins();
            showNotification(`Médecin ${medecin.is_active ? 'activé' : 'désactivé'} avec succès`, 'success');
        }
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
    
    // Recherche
    document.getElementById('searchInput').addEventListener('input', (e) => {
        const search = e.target.value.toLowerCase();
        const filtered = mockMedecins.filter(m => 
            m.user.name.toLowerCase().includes(search) || 
            m.specialite.toLowerCase().includes(search)
        );
        const tbody = document.getElementById('medecinsTableBody');
        tbody.innerHTML = filtered.map(medecin => `...`).join('');
        renderMedecins();
    });
    
    renderMedecins();
</script>
@endsection