@extends('layouts.app')

@section('title', 'Calendrier des Rendez-vous')
@section('header', 'Calendrier')

@section('content')
<div class="space-y-6">
    
    <!-- Vue : Calendrier ou Liste -->
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            <a href="{{ route('admin.rendez-vous.index') }}" 
               class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-list"></i> Vue Liste
            </a>
            <a href="{{ route('admin.rendez-vous.calendar') }}" 
               class="px-4 py-2 bg-primary text-white rounded-lg transition">
                <i class="fas fa-calendar-alt"></i> Vue Calendrier
            </a>
        </div>
        
        <a href="{{ route('admin.rendez-vous.create') }}" 
           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau RDV
        </a>
    </div>
    
    <!-- Calendrier -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div id="calendar"></div>
    </div>
</div>

<!-- FullCalendar CSS & JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/fr.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        // Mock des événements
        const events = [
            {
                id: 1,
                title: 'Jean Kouassi - Consultation',
                start: '2024-03-15 09:00:00',
                end: '2024-03-15 09:30:00',
                backgroundColor: '#0B5E42',
                borderColor: '#0B5E42',
                extendedProps: {
                    medecin: 'Dr. Adjanohoun',
                    statut: 'confirme',
                    telephone: '+229 97 12 34 56'
                }
            },
            {
                id: 2,
                title: 'Marie Zinsou - Suivi',
                start: '2024-03-15 10:30:00',
                end: '2024-03-15 11:00:00',
                backgroundColor: '#F59E0B',
                borderColor: '#F59E0B',
                extendedProps: {
                    medecin: 'Dr. Bio',
                    statut: 'en_attente',
                    telephone: '+229 94 56 78 90'
                }
            },
            {
                id: 3,
                title: 'Amadou Diallo - Urgence',
                start: '2024-03-16 14:00:00',
                end: '2024-03-16 14:30:00',
                backgroundColor: '#DC2626',
                borderColor: '#DC2626',
                extendedProps: {
                    medecin: 'Dr. Adjanohoun',
                    statut: 'confirme',
                    telephone: '+229 91 23 45 67'
                }
            },
            {
                id: 4,
                title: 'Fatima Bello - Contrôle',
                start: '2024-03-17 08:30:00',
                end: '2024-03-17 09:00:00',
                backgroundColor: '#10B981',
                borderColor: '#10B981',
                extendedProps: {
                    medecin: 'Dr. Zinsou',
                    statut: 'termine',
                    telephone: '+229 97 89 01 23'
                }
            },
            {
                id: 5,
                title: 'Koffi Amenan - Vaccin',
                start: '2024-03-18 15:30:00',
                end: '2024-03-18 16:00:00',
                backgroundColor: '#3B82F6',
                borderColor: '#3B82F6',
                extendedProps: {
                    medecin: 'Dr. Bio',
                    statut: 'confirme',
                    telephone: '+229 93 45 67 89'
                }
            }
        ];
        
        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            allDaySlot: false,
            slotDuration: '00:30:00',
            events: events,
            eventClick: function(info) {
                const event = info.event;
                const props = event.extendedProps;
                
                // Modal d'information
                const modalHtml = `
                    <div id="eventModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
                        <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
                            <div class="p-6 border-b">
                                <h3 class="text-lg font-semibold">${event.title}</h3>
                            </div>
                            <div class="p-6 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Date & Heure :</span>
                                    <span>${event.start.toLocaleString('fr-FR')}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Médecin :</span>
                                    <span>${props.medecin || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Téléphone :</span>
                                    <span>${props.telephone || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Statut :</span>
                                    <span class="px-2 py-1 rounded-full text-xs ${props.statut === 'confirme' ? 'bg-green-100 text-green-700' : props.statut === 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100'}">
                                        ${props.statut || '-'}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 border-t flex justify-end gap-3">
                                <button onclick="closeModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                                    Fermer
                                </button>
                                <a href="/admin/rendez-vous/${event.id}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                
                // Supprimer l'ancien modal s'il existe
                const oldModal = document.getElementById('eventModal');
                if (oldModal) oldModal.remove();
                
                // Ajouter le modal
                document.body.insertAdjacentHTML('beforeend', modalHtml);
            },
            eventDidMount: function(info) {
                // Ajouter un tooltip
                info.el.setAttribute('title', `${info.event.title} - ${info.event.extendedProps.medecin || ''}`);
            }
        });
        
        calendar.render();
    });
    
    function closeModal() {
        const modal = document.getElementById('eventModal');
        if (modal) modal.remove();
    }
</script>

<style>
    .fc-event {
        cursor: pointer;
        transition: transform 0.2s;
    }
    .fc-event:hover {
        transform: scale(1.02);
        filter: brightness(1.05);
    }
    .fc-day-today {
        background-color: rgba(11, 94, 66, 0.05) !important;
    }
    .fc .fc-button-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }
    .fc .fc-button-primary:hover {
        background-color: var(--primary-dark) !important;
    }
    .fc .fc-button-primary:focus {
        box-shadow: none !important;
    }
</style>
@endsection