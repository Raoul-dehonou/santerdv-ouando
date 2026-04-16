@extends('layouts.app')

@section('title', 'Mes Disponibilités')
@section('header', 'Gestion des Disponibilités')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Info -->
    <div class="bg-blue-50 border-l-4 border-info rounded-lg p-4">
        <div class="flex items-center gap-3">
            <i class="fas fa-info-circle text-info text-xl"></i>
            <div>
                <p class="text-sm text-gray-700">Définissez vos créneaux de disponibilité pour que les patients puissent prendre rendez-vous.</p>
                <p class="text-xs text-gray-500 mt-1">Les créneaux non disponibles seront bloqués dans le calendrier.</p>
            </div>
        </div>
    </div>
    
    <!-- Formulaire d'ajout -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-plus-circle text-primary"></i>
            Ajouter une disponibilité
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select id="jour" class="border rounded-lg px-3 py-2">
                <option value="">Sélectionner un jour</option>
                <option value="lundi">Lundi</option>
                <option value="mardi">Mardi</option>
                <option value="mercredi">Mercredi</option>
                <option value="jeudi">Jeudi</option>
                <option value="vendredi">Vendredi</option>
                <option value="samedi">Samedi</option>
            </select>
            
            <input type="time" id="heure_debut" class="border rounded-lg px-3 py-2" placeholder="Heure début">
            
            <input type="time" id="heure_fin" class="border rounded-lg px-3 py-2" placeholder="Heure fin">
            
            <button id="ajouterDispo" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                <i class="fas fa-plus"></i> Ajouter
            </button>
        </div>
    </div>
    
    <!-- Liste des disponibilités -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-clock text-primary"></i>
                Mes créneaux habituels
            </h3>
        </div>
        
        <div class="divide-y">
            <div class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-24 font-medium text-gray-800">Lundi</div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-start text-primary"></i> 08:00 - 12:00
                    </div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-end text-primary"></i> 14:00 - 17:00
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-24 font-medium text-gray-800">Mardi</div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-start text-primary"></i> 08:00 - 12:00
                    </div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-end text-primary"></i> 14:00 - 17:00
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-24 font-medium text-gray-800">Mercredi</div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-start text-primary"></i> 08:00 - 12:00
                    </div>
                    <div class="text-gray-600">
                        <i class="fas fa-hourglass-end text-primary"></i> 14:00 - 17:00
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Congés exceptionnels -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-umbrella-beach text-warning"></i>
                Congés exceptionnels
            </h3>
            <button id="ajouterConges" class="text-primary hover:text-primary-dark text-sm">
                <i class="fas fa-plus"></i> Ajouter un congé
            </button>
        </div>
        <div class="p-6 text-center text-gray-500">
            <i class="fas fa-calendar-day text-3xl mb-2 text-gray-300"></i>
            <p>Aucun congé programmé</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('ajouterDispo').addEventListener('click', function() {
        const jour = document.getElementById('jour').value;
        const debut = document.getElementById('heure_debut').value;
        const fin = document.getElementById('heure_fin').value;
        
        if (!jour || !debut || !fin) {
            showNotification('Veuillez remplir tous les champs', 'error');
            return;
        }
        
        showNotification('Disponibilité ajoutée avec succès', 'success');
        
        // Réinitialiser
        document.getElementById('jour').value = '';
        document.getElementById('heure_debut').value = '';
        document.getElementById('heure_fin').value = '';
    });
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white animate-fade-in`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
</script>
@endsection