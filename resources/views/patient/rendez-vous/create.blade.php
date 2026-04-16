@extends('layouts.app')

@section('title', 'Prendre un Rendez-vous')
@section('header', 'Nouveau Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        <!-- En-tête coloré -->
        <div style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);" class="px-6 py-4">
            <h2 class="text-white font-semibold flex items-center gap-2">
                <i class="fas fa-calendar-plus"></i>
                Formulaire de prise de rendez-vous
            </h2>
        </div>
        
        <div class="p-6">
            <form id="rdvForm">
                @csrf
                
                <!-- Type de consultation -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Type de consultation <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="consultation-type border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition-all duration-200 text-center" data-type="generale">
                            <input type="radio" name="type" value="generale" class="hidden" required>
                            <i class="fas fa-stethoscope text-2xl text-primary mb-1"></i>
                            <p class="text-sm font-medium">Générale</p>
                        </label>
                        <label class="consultation-type border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition-all duration-200 text-center" data-type="specialiste">
                            <input type="radio" name="type" value="specialiste" class="hidden">
                            <i class="fas fa-user-md text-2xl text-primary mb-1"></i>
                            <p class="text-sm font-medium">Spécialiste</p>
                        </label>
                        <label class="consultation-type border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition-all duration-200 text-center" data-type="controle">
                            <input type="radio" name="type" value="controle" class="hidden">
                            <i class="fas fa-chart-line text-2xl text-primary mb-1"></i>
                            <p class="text-sm font-medium">Contrôle</p>
                        </label>
                        <label class="consultation-type border rounded-lg p-3 cursor-pointer hover:bg-gray-50 transition-all duration-200 text-center" data-type="urgence">
                            <input type="radio" name="type" value="urgence" class="hidden">
                            <i class="fas fa-ambulance text-2xl text-primary mb-1"></i>
                            <p class="text-sm font-medium">Urgence</p>
                        </label>
                    </div>
                </div>
                
                <!-- Médecin -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Médecin <span class="text-red-500">*</span></label>
                    <select name="medecin_id" id="medecin_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Sélectionner un médecin</option>
                        <option value="1">Dr. Adjanohoun - Cardiologue</option>
                        <option value="2">Dr. Bio - Généraliste</option>
                        <option value="3">Dr. Zinsou - Pédiatre</option>
                        <option value="4">Dr. Houndjo - Gynécologue</option>
                    </select>
                </div>
                
                <!-- Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" required 
                           min="{{ date('Y-m-d') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                
                <!-- Heure -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Heure <span class="text-red-500">*</span></label>
                    <select name="heure" id="heure" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
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
                    <textarea name="motif" id="motif" rows="3" 
                              class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent" 
                              placeholder="Décrivez brièvement votre symptôme ou raison de consultation..."></textarea>
                </div>
                
                <!-- Notes -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes supplémentaires</label>
                    <textarea name="notes" id="notes" rows="2" 
                              class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent" 
                              placeholder="Informations complémentaires..."></textarea>
                </div>
                
                <!-- Boutons -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('patient.rendez-vous.index') }}" 
                       class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit" id="submitBtn"
                            style="background: linear-gradient(135deg, #0B5E42 0%, #074231 100%);"
                            class="text-white px-5 py-2 rounded-lg transition flex items-center gap-2 shadow-md hover:shadow-lg">
                        <i class="fas fa-calendar-check"></i>
                        Confirmer le rendez-vous
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Info -->
    <div class="mt-4 text-center text-sm text-gray-500">
        <i class="fas fa-info-circle"></i> Un email de confirmation vous sera envoyé
    </div>
</div>

<script>
    // Gestion des radios avec style actif
    document.querySelectorAll('.consultation-type').forEach(label => {
        label.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            
            document.querySelectorAll('.consultation-type').forEach(l => {
                l.classList.remove('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary');
            });
            this.classList.add('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary');
        });
    });
    
    // Validation des champs
    function validateForm() {
        const typeSelected = document.querySelector('input[name="type"]:checked');
        const medecin = document.getElementById('medecin_id').value;
        const date = document.getElementById('date').value;
        const heure = document.getElementById('heure').value;
        
        if (!typeSelected) {
            alert('Veuillez sélectionner un type de consultation');
            return false;
        }
        if (!medecin) {
            alert('Veuillez sélectionner un médecin');
            return false;
        }
        if (!date) {
            alert('Veuillez sélectionner une date');
            return false;
        }
        if (!heure) {
            alert('Veuillez sélectionner une heure');
            return false;
        }
        
        return true;
    }
    
    // Soumission avec loader
    document.getElementById('rdvForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) return;
        
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
        
        setTimeout(() => {
            alert('Rendez-vous pris avec succès !');
            window.location.href = '{{ route("patient.rendez-vous.index") }}';
        }, 1000);
    });
</script>

<style>
    .consultation-type {
        transition: all 0.2s ease;
    }
    .consultation-type:active {
        transform: scale(0.98);
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
    }
</style>
@endsection