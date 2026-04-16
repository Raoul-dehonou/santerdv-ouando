@extends('layouts.app')

@section('title', 'Détail Rendez-vous')
@section('header', 'Mon Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <h2 class="text-white text-xl font-bold">Rendez-vous #RDV-001</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Médecin</p>
                    <p class="font-medium">Dr. Adjanohoun</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Spécialité</p>
                    <p class="font-medium">Cardiologue</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-medium">15 Mars 2024</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Heure</p>
                    <p class="font-medium">09:00 - 09:30</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Motif</p>
                    <p class="font-medium">Consultation générale</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Statut</p>
                    <span id="statutBadge" class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmé</span>
                </div>
            </div>
            
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-info-circle text-info"></i>
                    <p class="text-sm text-gray-700">Veuillez arriver 10 minutes avant votre rendez-vous.</p>
                </div>
            </div>
            
            <div class="flex gap-3 pt-4 border-t">
                <button id="cancelBtn" class="flex-1 px-4 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition">
                    <i class="fas fa-times"></i> Annuler le rendez-vous
                </button>
                <a href="{{ route('patient.rendez-vous.index') }}" class="flex-1 text-center px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Retour
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'annulation avec motif -->
<div id="cancelModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-fade-in">
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 rounded-full bg-red-100 mx-auto flex items-center justify-center mb-3">
                    <i class="fas fa-calendar-times text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Annuler le rendez-vous</h3>
                <p class="text-gray-500 text-sm mt-1">Veuillez indiquer la raison de l'annulation</p>
            </div>
            
            <textarea id="cancelReason" rows="3" class="w-full border rounded-lg px-3 py-2 mb-4 focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Raison de l'annulation..."></textarea>
            
            <div class="flex gap-3">
                <button onclick="closeCancelModal()" class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 transition">Retour</button>
                <button id="confirmCancelBtn" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Confirmer l'annulation</button>
            </div>
        </div>
    </div>
</div>

<script>
    let cancelReason = '';
    
    function openCancelModal() {
        document.getElementById('cancelModal').classList.remove('hidden');
        document.getElementById('cancelModal').classList.add('flex');
    }
    
    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
        document.getElementById('cancelModal').classList.remove('flex');
        document.getElementById('cancelReason').value = '';
    }
    
    function cancelRdv() {
        const reason = document.getElementById('cancelReason').value;
        
        if (!reason.trim()) {
            showNotification('Veuillez indiquer un motif d\'annulation', 'error');
            return;
        }
        
        // Simulation d'annulation
        showNotification('Rendez-vous annulé avec succès', 'success');
        
        // Mettre à jour le statut dans l'interface
        const statutBadge = document.getElementById('statutBadge');
        statutBadge.textContent = 'Annulé';
        statutBadge.classList.remove('bg-green-100', 'text-green-700');
        statutBadge.classList.add('bg-red-100', 'text-red-700');
        
        // Désactiver le bouton d'annulation
        const cancelBtn = document.getElementById('cancelBtn');
        cancelBtn.disabled = true;
        cancelBtn.classList.add('opacity-50', 'cursor-not-allowed');
        cancelBtn.classList.remove('hover:bg-red-50');
        
        closeCancelModal();
        
        // Rediriger après 2 secondes
        setTimeout(() => {
            window.location.href = '{{ route("patient.rendez-vous.index") }}';
        }, 2000);
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
    
    document.getElementById('cancelBtn').addEventListener('click', openCancelModal);
    document.getElementById('confirmCancelBtn').addEventListener('click', cancelRdv);
    
    // Fermer le modal avec Echap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCancelModal();
        }
    });
</script>
@endsection