@extends('layouts.app')

@section('title', 'Prendre un Rendez-vous')
@section('header', 'Nouveau Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form id="rdvForm" method="POST">
            @csrf
            
            <!-- Type de consultation -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Type de consultation *</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition text-center">
                        <input type="radio" name="type" value="generale" class="hidden" required>
                        <i class="fas fa-stethoscope text-2xl text-primary mb-1"></i>
                        <p class="text-sm font-medium">Générale</p>
                    </label>
                    <label class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition text-center">
                        <input type="radio" name="type" value="specialiste" class="hidden">
                        <i class="fas fa-user-md text-2xl text-primary mb-1"></i>
                        <p class="text-sm font-medium">Spécialiste</p>
                    </label>
                    <label class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition text-center">
                        <input type="radio" name="type" value="controle" class="hidden">
                        <i class="fas fa-chart-line text-2xl text-primary mb-1"></i>
                        <p class="text-sm font-medium">Contrôle</p>
                    </label>
                    <label class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition text-center">
                        <input type="radio" name="type" value="urgence" class="hidden">
                        <i class="fas fa-ambulance text-2xl text-primary mb-1"></i>
                        <p class="text-sm font-medium">Urgence</p>
                    </label>
                </div>
            </div>
            
            <!-- Médecin -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Médecin *</label>
                <select name="medecin_id" id="medecin_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
                    <option value="">Sélectionner un médecin</option>
                    <option value="1">Dr. Adjanohoun - Cardiologue</option>
                    <option value="2">Dr. Bio - Généraliste</option>
                    <option value="3">Dr. Zinsou - Pédiatre</option>
                    <option value="4">Dr. Houndjo - Gynécologue</option>
                </select>
            </div>
            
            <!-- Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date *</label>
                <input type="date" name="date" id="date" required 
                       min="{{ date('Y-m-d') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
            </div>
            
            <!-- Heure -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Heure *</label>
                <select name="heure" id="heure" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
                    <option value="">Sélectionner une heure</option>
                    <option value="08:00">08:00</option>
                    <option value="08:30">08:30</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                </select>
            </div>
            
            <!-- Motif -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Motif de la consultation</label>
                <textarea name="motif" rows="3" 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary" 
                          placeholder="Décrivez brièvement votre symptôme ou raison de consultation..."></textarea>
            </div>
            
            <!-- Notes -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                <textarea name="notes" rows="2" 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary" 
                          placeholder="Informations complémentaires..."></textarea>
            </div>
            
            <!-- Boutons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('patient.rendez-vous.index') }}" 
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                    Confirmer le rendez-vous
                </button>
            </div>
        </form>
    </div>
    
    <!-- Info -->
    <div class="mt-4 text-center text-sm text-gray-500">
        <i class="fas fa-info-circle"></i> Un email de confirmation vous sera envoyé
    </div>
</div>

<script>
    // Gestion des radios
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[type="radio"]').forEach(r => {
                r.closest('label').classList.remove('border-primary', 'bg-primary/5');
            });
            if (this.checked) {
                this.closest('label').classList.add('border-primary', 'bg-primary/5');
            }
        });
    });
    
    // Soumission
    document.getElementById('rdvForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulation
        showNotification('Rendez-vous pris avec succès !', 'success');
        
        setTimeout(() => {
            window.location.href = '{{ route("patient.rendez-vous.index") }}';
        }, 1500);
    });
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
</script>
@endsection