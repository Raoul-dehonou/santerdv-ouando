@extends('layouts.app')

@section('title', 'Nouveau Rendez-vous')
@section('header', 'Prendre un rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form id="rdvForm" method="POST">
            @csrf
            
            <!-- Patient -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Patient *</label>
                <select name="patient_id" id="patient_id" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">Sélectionner un patient</option>
                    <option value="1">Jean Kouassi</option>
                    <option value="2">Marie Zinsou</option>
                    <option value="3">Amadou Diallo</option>
                </select>
            </div>
            
            <!-- Médecin -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Médecin *</label>
                <select name="medecin_id" id="medecin_id" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">Sélectionner un médecin</option>
                    <option value="1">Dr. Adjanohoun - Cardiologue</option>
                    <option value="2">Dr. Bio - Généraliste</option>
                    <option value="3">Dr. Zinsou - Pédiatre</option>
                </select>
            </div>
            
            <!-- Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date *</label>
                <input type="date" name="date" id="date" required 
                       min="{{ date('Y-m-d') }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <!-- Heure -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Heure *</label>
                <input type="time" name="heure" id="heure" required 
                       class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <!-- Motif -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Motif</label>
                <textarea name="motif" rows="3" 
                          class="w-full border rounded-lg px-3 py-2" 
                          placeholder="Raison de la consultation..."></textarea>
            </div>
            
            <!-- Notes -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                <textarea name="notes" rows="2" 
                          class="w-full border rounded-lg px-3 py-2" 
                          placeholder="Informations complémentaires..."></textarea>
            </div>
            
            <!-- Boutons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.rendez-vous.index') }}" 
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                    Enregistrer le rendez-vous
                </button>
            </div>
        </form>
    </div>
    
</div>

<script>
    // Récupérer le patient_id depuis l'URL si présent
    const urlParams = new URLSearchParams(window.location.search);
    const patientId = urlParams.get('patient_id');
    if (patientId) {
        document.getElementById('patient_id').value = patientId;
    }
    
    document.getElementById('rdvForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            patient_id: document.getElementById('patient_id').value,
            medecin_id: document.getElementById('medecin_id').value,
            date: document.getElementById('date').value,
            heure: document.getElementById('heure').value,
            motif: document.getElementById('motif').value,
            notes: document.getElementById('notes').value
        };
        
        console.log('RDV à créer:', formData);
        
        showNotification('Rendez-vous créé avec succès (simulation)', 'success');
        
        setTimeout(() => {
            window.location.href = '{{ route("admin.rendez-vous.index") }}';
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