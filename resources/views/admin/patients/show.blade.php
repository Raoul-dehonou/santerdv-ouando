@extends('layouts.app')

@section('title', 'Détail du Patient')
@section('header', 'Fiche Patient')

@section('content')
<div class="space-y-6">
    
    <!-- Navigation rapide -->
    <div class="flex gap-2">
        <a href="{{ route('admin.patients.index') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Colonne gauche : Infos patient -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Carte d'identité -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-4">
                    <div class="w-24 h-24 rounded-full bg-primary/20 mx-auto flex items-center justify-center mb-3">
                        <i class="fas fa-user-circle text-5xl text-primary"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800" id="patientName">Chargement...</h2>
                    <p class="text-gray-500" id="patientProfession">-</p>
                </div>
                
                <div class="space-y-3 border-t pt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID Patient :</span>
                        <span class="font-medium" id="patientId">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date naissance :</span>
                        <span class="font-medium" id="patientBirth">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Téléphone :</span>
                        <span class="font-medium" id="patientPhone">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email :</span>
                        <span class="font-medium" id="patientEmail">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Adresse :</span>
                        <span class="font-medium" id="patientAddress">-</span>
                    </div>
                </div>
            </div>
            
            <!-- Dossier médical -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-folder-medical text-primary"></i>
                    Dossier Médical
                </h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-500">Groupe sanguin :</span>
                        <p class="font-medium" id="bloodGroup">-</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Allergies :</span>
                        <p class="text-sm" id="allergies">-</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Antécédents :</span>
                        <p class="text-sm" id="antecedents">-</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Traitements actuels :</span>
                        <p class="text-sm" id="traitements">-</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne droite : RDV et Consultations -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Bouton Prendre RDV -->
            <div class="flex justify-end">
                <a href="{{ route('admin.rendez-vous.create') }}?patient_id={{ $id ?? '' }}" 
                   class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
                    <i class="fas fa-calendar-plus"></i>
                    Prendre un rendez-vous
                </a>
            </div>
            
            <!-- Historique des RDV -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-calendar-check text-primary"></i>
                        Historique des rendez-vous
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motif</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody id="appointmentsTable" class="divide-y">
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Historique des Consultations -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-notes-medical text-primary"></i>
                        Consultations
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnostic</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody id="consultationsTable" class="divide-y">
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const patientId = window.location.pathname.split('/').pop();
    
    // Mock data
    const mockPatient = {
        id: patientId,
        user: {
            name: 'Jean Kouassi',
            email: 'jean.kouassi@email.com'
        },
        profession: 'Enseignant',
        telephone: '+229 97 12 34 56',
        date_naissance: '1985-06-15',
        adresse: 'Cotonou, Bénin',
        dossier_medical: {
            groupe_sanguin: 'O+',
            allergies: 'Aucune',
            antecedents: 'Hypertension artérielle',
            traitements_actuels: 'Lisinopril 10mg/jour'
        }
    };
    
    const mockAppointments = [
        {
            id: 1,
            date: '2024-03-10',
            heure: '09:00',
            medecin: { user: { name: 'Dr. Adjanohoun' } },
            motif: 'Consultation générale',
            statut: 'termine'
        },
        {
            id: 2,
            date: '2024-03-15',
            heure: '14:30',
            medecin: { user: { name: 'Dr. Bio' } },
            motif: 'Suivi hypertension',
            statut: 'confirme'
        }
    ];
    
    const mockConsultations = [
        {
            id: 1,
            date_consultation: '2024-03-10',
            medecin: { user: { name: 'Dr. Adjanohoun' } },
            diagnostic: 'Hypertension artérielle stable',
            prescription: 'Lisinopril 10mg, contrôle dans 1 mois'
        }
    ];
    
    function loadPatient() {
        // Afficher les infos patient
        document.getElementById('patientName').textContent = mockPatient.user.name;
        document.getElementById('patientProfession').textContent = mockPatient.profession || '-';
        document.getElementById('patientId').textContent = mockPatient.id;
        document.getElementById('patientBirth').textContent = mockPatient.date_naissance || '-';
        document.getElementById('patientPhone').textContent = mockPatient.telephone || '-';
        document.getElementById('patientEmail').textContent = mockPatient.user.email;
        document.getElementById('patientAddress').textContent = mockPatient.adresse || '-';
        
        // Dossier médical
        document.getElementById('bloodGroup').textContent = mockPatient.dossier_medical?.groupe_sanguin || '-';
        document.getElementById('allergies').textContent = mockPatient.dossier_medical?.allergies || '-';
        document.getElementById('antecedents').textContent = mockPatient.dossier_medical?.antecedents || '-';
        document.getElementById('traitements').textContent = mockPatient.dossier_medical?.traitements_actuels || '-';
    }
    
    function loadAppointments() {
        const tbody = document.getElementById('appointmentsTable');
        
        if (mockAppointments.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucun rendez-vous</td></tr>';
            return;
        }
        
        const statutColors = {
            'en_attente': 'bg-yellow-100 text-yellow-700',
            'confirme': 'bg-green-100 text-green-700',
            'annule': 'bg-red-100 text-red-700',
            'termine': 'bg-blue-100 text-blue-700'
        };
        
        tbody.innerHTML = mockAppointments.map(rdv => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    ${new Date(rdv.date).toLocaleDateString('fr-FR')}<br>
                    <span class="text-xs text-gray-500">${rdv.heure}</span>
                 </td>
                <td class="px-6 py-4">${rdv.medecin.user.name}</td>
                <td class="px-6 py-4">${rdv.motif}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full ${statutColors[rdv.statut] || 'bg-gray-100'}">
                        ${rdv.statut}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="/admin/rendez-vous/${rdv.id}" class="text-primary hover:underline text-sm">Voir</a>
                </td>
            </tr>
        `).join('');
    }
    
    function loadConsultations() {
        const tbody = document.getElementById('consultationsTable');
        
        if (mockConsultations.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Aucune consultation</td></tr>';
            return;
        }
        
        tbody.innerHTML = mockConsultations.map(consult => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">${new Date(consult.date_consultation).toLocaleDateString('fr-FR')}</td>
                <td class="px-6 py-4">${consult.medecin.user.name}</td>
                <td class="px-6 py-4">${consult.diagnostic.substring(0, 50)}...</td>
                <td class="px-6 py-4">
                    <a href="/admin/consultations/${consult.id}" class="text-primary hover:underline text-sm">Détail</a>
                </td>
            </tr>
        `).join('');
    }
    
    // Chargement
    loadPatient();
    loadAppointments();
    loadConsultations();
</script>
@endsection