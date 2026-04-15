@extends('layouts.app')

@section('title', 'Ajouter une Consultation')
@section('header', 'Nouvelle Consultation')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        
        <!-- Infos RDV -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-gray-800 mb-3">Informations du rendez-vous</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Patient :</span>
                    <span class="font-medium ml-2">Jean Kouassi</span>
                </div>
                <div>
                    <span class="text-gray-500">Date :</span>
                    <span class="font-medium ml-2">15 Mars 2024 - 09:00</span>
                </div>
                <div>
                    <span class="text-gray-500">Âge :</span>
                    <span class="font-medium ml-2">38 ans</span>
                </div>
                <div>
                    <span class="text-gray-500">Motif :</span>
                    <span class="font-medium ml-2">Consultation générale</span>
                </div>
            </div>
        </div>
        
        <form id="consultationForm">
            
            <!-- Symptômes / Plaintes -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Symptômes / Plaintes *</label>
                <textarea name="symptomes" rows="3" required 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary"
                          placeholder="Décrivez les symptômes rapportés par le patient..."></textarea>
            </div>
            
            <!-- Examen clinique -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Examen clinique</label>
                <textarea name="examen" rows="3" 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary"
                          placeholder="Température, tension, poids, etc..."></textarea>
            </div>
            
            <!-- Diagnostic -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnostic *</label>
                <textarea name="diagnostic" rows="3" required 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary"
                          placeholder="Diagnostic établi..."></textarea>
            </div>
            
            <!-- Prescription -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Prescription / Traitement</label>
                <textarea name="prescription" rows="4" 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary"
                          placeholder="Médicaments, posologie, durée..."></textarea>
            </div>
            
            <!-- Examens complémentaires -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Examens complémentaires</label>
                <textarea name="examens_complementaires" rows="2" 
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary"
                          placeholder="Analyses, radiologie, etc..."></textarea>
            </div>
            
            <!-- Prochain rendez-vous -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Prochain rendez-vous suggéré</label>
                <input type="date" name="prochain_rdv" 
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
            </div>
            
            <!-- Boutons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('medecin.rendez-vous.index') }}" 
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                    Enregistrer la consultation
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('consultationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        showNotification('Consultation enregistrée avec succès !', 'success');
        
        setTimeout(() => {
            window.location.href = '{{ route("medecin.rendez-vous.index") }}';
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