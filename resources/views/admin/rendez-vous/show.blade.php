@extends('layouts.app')

@section('title', 'Détail Rendez-vous')
@section('header', 'Fiche Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <h2 class="text-white text-xl font-bold">Rendez-vous #RDV-001</h2>
        </div>
        
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Patient</p>
                    <p class="font-medium">Jean Kouassi</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Médecin</p>
                    <p class="font-medium">Dr. Adjanohoun</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-medium">15/03/2024</p>
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
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Confirmé</span>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.rendez-vous.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Retour</a>
                <a href="#" class="px-4 py-2 bg-warning text-white rounded-lg hover:bg-warning-dark">Modifier statut</a>
            </div>
        </div>
    </div>
</div>
@endsection