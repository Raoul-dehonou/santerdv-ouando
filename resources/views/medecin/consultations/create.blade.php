@extends('layouts.app')

@section('title', 'Ajouter une Consultation')
@section('header', 'Nouvelle Consultation')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <h2 class="text-white font-semibold flex items-center gap-2">
                <i class="fas fa-notes-medical"></i>
                Formulaire de consultation
            </h2>
        </div>
        
        <div class="p-6">
            
            <!-- Infos RDV pré-remplies -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg border">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-info-circle text-primary"></i>
                    Informations du rendez-vous
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Patient :</span>
                        <span class="font-medium">Jean Kouassi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Âge :</span>
                        <span class="font-medium">38 ans</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Date :</span>
                        <span class="font-medium">15 Mars 2024</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Heure :</span>
                        <span class="font-medium">09:00</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Motif :</span>
                        <span class="font-medium">Consultation générale</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 w-24">Médecin :</span>
                        <span class="font-medium">Dr. {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            <form id="consultationForm">
                @csrf
                
                <div class="space-y-6">
                    <!-- Symptômes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Symptômes / Plaintes <span class="text-red-500">*</span>
                        </label>
                        <textarea name="symptomes" rows="3" required 
                                  class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"
                                  placeholder="Décrivez les symptômes rapportés par le patient..."></textarea>
                    </div>
                    
                    <!-- Examen clinique -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Examen clinique</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                            <div>
                                <input type="text" name="temperature" placeholder="Température (°C)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <input type="text" name="tension" placeholder="Tension (mmHg)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <input type="text" name="poids" placeholder="Poids (kg)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <input type="text" name="taille" placeholder="Taille (cm)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <input type="text" name="pouls" placeholder="Pouls (bpm)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <input type="text" name="saturation" placeholder="Saturation O2 (%)" 
                                       class="w-full border rounded-lg px-3 py-2">
                            </div>
                        </div>
                        <textarea name="examen_notes" rows="2" 
                                  class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary"
                                  placeholder="Autres observations..."></textarea>
                    </div>
                    
                    <!-- Diagnostic -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Diagnostic <span class="text-red-500">*</span>
                        </label>
                        <textarea name="diagnostic" rows="3" required 
                                  class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary"
                                  placeholder="Diagnostic établi..."></textarea>
                    </div>
                    
                    <!-- Prescription -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prescription / Traitement</label>
                        <div class="border rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-2 border-b">
                                <button type="button" id="addMedicament" class="text-primary hover:text-primary-dark text-sm">
                                    <i class="fas fa-plus"></i> Ajouter un médicament
                                </button>
                            </div>
                            <div id="medicamentsList" class="divide-y">
                                <div class="p-3 flex gap-2">
                                    <input type="text" name="medicaments[0][nom]" placeholder="Médicament" 
                                           class="flex-1 border rounded px-2 py-1">
                                    <input type="text" name="medicaments[0][posologie]" placeholder="Posologie" 
                                           class="flex-1 border rounded px-2 py-1">
                                    <input type="text" name="medicaments[0][duree]" placeholder="Durée" 
                                           class="w-32 border rounded px-2 py-1">
                                    <button type="button" class="text-red-500 remove-medicament">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Examens complémentaires -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Examens complémentaires</label>
                        <div class="border rounded-lg p-3">
                            <div class="flex flex-wrap gap-2 mb-2">
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="examens[]" value="bilan_sanguin" class="rounded">
                                    <span class="text-sm">Bilan sanguin</span>
                                </label>
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="examens[]" value="radiographie" class="rounded">
                                    <span class="text-sm">Radiographie</span>
                                </label>
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="examens[]" value="echographie" class="rounded">
                                    <span class="text-sm">Échographie</span>
                                </label>
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="examens[]" value="irm" class="rounded">
                                    <span class="text-sm">IRM</span>
                                </label>
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="examens[]" value="scanner" class="rounded">
                                    <span class="text-sm">Scanner</span>
                                </label>
                            </div>
                            <textarea name="examens_autres" rows="2" 
                                      class="w-full border rounded px-3 py-1 text-sm"
                                      placeholder="Autres examens..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Prochain rendez-vous -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prochain rendez-vous suggéré</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="date" name="prochain_date" class="border rounded-lg px-3 py-2">
                            <select name="prochain_motif" class="border rounded-lg px-3 py-2">
                                <option value="">Motif du prochain RDV</option>
                                <option value="controle">Contrôle</option>
                                <option value="resultats">Résultats d'examens</option>
                                <option value="suivi">Suivi</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Remarques -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Remarques supplémentaires</label>
                        <textarea name="remarques" rows="2" 
                                  class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary"
                                  placeholder="Informations complémentaires..."></textarea>
                    </div>
                    
                    <!-- Ordonnance à imprimer -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="generer_ordonnance" checked class="rounded text-primary">
                            <span class="text-sm font-medium">Générer une ordonnance à imprimer</span>
                        </label>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                    <a href="{{ route('medecin.rendez-vous.index') }}" 
                       class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Enregistrer la consultation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Gestion des médicaments
    let medicamentIndex = 1;
    
    document.getElementById('addMedicament').addEventListener('click', function() {
        const container = document.getElementById('medicamentsList');
        const newDiv = document.createElement('div');
        newDiv.className = 'p-3 flex gap-2';
        newDiv.innerHTML = `
            <input type="text" name="medicaments[${medicamentIndex}][nom]" placeholder="Médicament" 
                   class="flex-1 border rounded px-2 py-1">
            <input type="text" name="medicaments[${medicamentIndex}][posologie]" placeholder="Posologie" 
                   class="flex-1 border rounded px-2 py-1">
            <input type="text" name="medicaments[${medicamentIndex}][duree]" placeholder="Durée" 
                   class="w-32 border rounded px-2 py-1">
            <button type="button" class="text-red-500 remove-medicament">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(newDiv);
        medicamentIndex++;
        
        // Ajouter l'événement de suppression
        newDiv.querySelector('.remove-medicament').addEventListener('click', function() {
            newDiv.remove();
        });
    });
    
    // Suppression des médicaments existants
    document.querySelectorAll('.remove-medicament').forEach(btn => {
        btn.addEventListener('click', function() {
            btn.closest('.p-3').remove();
        });
    });
    
    // Soumission du formulaire
    document.getElementById('consultationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        showNotification('Consultation enregistrée avec succès !', 'success');
        
        setTimeout(() => {
            window.location.href = '{{ route("medecin.rendez-vous.index") }}';
        }, 1500);
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