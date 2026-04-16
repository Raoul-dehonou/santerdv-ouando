@extends('layouts.app')

@section('title', 'Mon Calendrier')
@section('header', 'Calendrier des Rendez-vous')

@section('content')
<div class="space-y-6">
    
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            <a href="{{ route('medecin.rendez-vous.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-list"></i> Vue Liste
            </a>
            <a href="{{ route('medecin.rendez-vous.calendar') }}" class="px-4 py-2 bg-primary text-white rounded-lg transition">
                <i class="fas fa-calendar-alt"></i> Vue Calendrier
            </a>
        </div>
        
        <a href="{{ route('medecin.rendez-vous.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Nouveau RDV
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div id="calendar"></div>
    </div>
</div>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/fr.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
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
            events: [
                {
                    id: 1,
                    title: 'Jean Kouassi',
                    start: '2024-03-15 09:00:00',
                    end: '2024-03-15 09:30:00',
                    backgroundColor: '#0B5E42',
                    extendedProps: { motif: 'Consultation générale', telephone: '+229 97 12 34 56' }
                },
                {
                    id: 2,
                    title: 'Marie Zinsou',
                    start: '2024-03-15 10:30:00',
                    end: '2024-03-15 11:00:00',
                    backgroundColor: '#F59E0B',
                    extendedProps: { motif: 'Suivi grossesse', telephone: '+229 94 56 78 90' }
                }
            ],
            eventClick: function(info) {
                alert(`Patient: ${info.event.title}\nMotif: ${info.event.extendedProps.motif}\nTéléphone: ${info.event.extendedProps.telephone}`);
            }
        });
        
        calendar.render();
    });
</script>
@endsection