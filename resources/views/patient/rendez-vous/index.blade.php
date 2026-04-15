@extends('layouts.app')

@section('title', 'Mes Rendez-vous')
@section('header', 'Mes Rendez-vous')

@section('content')
<div class="space-y-6">
    
    <!-- En-tête -->
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            <button id="showUpcoming" class="px-4 py-2 bg-primary text-white rounded-lg">À venir</button>
            <button id="showPast" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Passés</button>
        </div>
        
        <a href="{{ route('patient.rendez-vous.create') }}" 
           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau RDV
        </a>
    </div>
    
    <!-- Liste des RDV à venir -->
    <div id="upcomingList" class="space-y-3">
        <div class="bg-white rounded-xl shadow-sm p-4 flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                    <i class="fas fa-user-md text-xl text-primary"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Dr. Adjanohoun</p>
                    <p class="text-sm text-gray-500">Cardiologue</p>
                    <p class="text-sm text-gray-600 mt-1">Consultation de suivi</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-lg font-bold text-primary">15 Mars 2024</p>
                <p class="text-sm text-gray-500">09:00 - 09:30</p>
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 mt-1 inline-block">Confirmé</span>
            </div>
            <div class="flex gap-2">
                <button class="text-red-600 hover:text-red-800" onclick="cancelRdv(1)">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-4 flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-user-md text-xl text-yellow-600"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Dr. Bio</p>
                    <p class="text-sm text-gray-500">Généraliste</p>
                    <p class="text-sm text-gray-600 mt-1">Consultation générale</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-lg font-bold text-primary">20 Mars 2024</p>
                <p class="text-sm text-gray-500">10:30 - 11:00</p>
                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 mt-1 inline-block">En attente</span>
            </div>
            <div class="flex gap-2">
                <button class="text-red-600 hover:text-red-800" onclick="cancelRdv(2)">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </div>
        </div>
    </div>
    
    <!-- Liste des RDV passés (cachée au début) -->
    <div id="pastList" class="space-y-3 hidden">
        <div class="bg-white rounded-xl shadow-sm p-4 flex flex-wrap justify-between items-center gap-4 opacity-75">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-user-md text-xl text-gray-500"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Dr. Zinsou</p>
                    <p class="text-sm text-gray-500">Pédiatre</p>
                    <p class="text-sm text-gray-600 mt-1">Vaccin enfant</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-lg font-bold text-gray-500">10 Mars 2024</p>
                <p class="text-sm text-gray-500">14:00 - 14:30</p>
                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 mt-1 inline-block">Terminé</span>
            </div>
            <div>
                <a href="#" class="text-primary hover:underline text-sm">Voir détails</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('showUpcoming').addEventListener('click', function() {
        document.getElementById('upcomingList').classList.remove('hidden');
        document.getElementById('pastList').classList.add('hidden');
        this.classList.add('bg-primary', 'text-white');
        this.classList.remove('border');
        document.getElementById('showPast').classList.remove('bg-primary', 'text-white');
        document.getElementById('showPast').classList.add('border');
    });
    
    document.getElementById('showPast').addEventListener('click', function() {
        document.getElementById('pastList').classList.remove('hidden');
        document.getElementById('upcomingList').classList.add('hidden');
        this.classList.add('bg-primary', 'text-white');
        this.classList.remove('border');
        document.getElementById('showUpcoming').classList.remove('bg-primary', 'text-white');
        document.getElementById('showUpcoming').classList.add('border');
    });
    
    function cancelRdv(id) {
        if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
            showNotification('Rendez-vous annulé', 'success');
        }
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }
</script>
@endsection