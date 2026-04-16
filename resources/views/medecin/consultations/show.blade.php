@extends('layouts.app')

@section('title', 'Détail Consultation')
@section('header', 'Fiche Consultation')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <h2 class="text-white text-xl font-bold">Consultation du 15/03/2024</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Patient</p>
                    <p class="font-medium">Jean Kouassi</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Médecin</p>
                    <p class="font-medium">Dr. {{ Auth::user()->name }}</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-800">Symptômes</h3>
                    <p class="text-gray-600 mt-1">Fatigue, maux de tête occasionnels</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Examen clinique</h3>
                    <p class="text-gray-600 mt-1">Tension: 120/80, Pouls: 72, Temp: 36.8°C</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Diagnostic</h3>
                    <p class="text-gray-600 mt-1">Hypertension artérielle stable</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Prescription</h3>
                    <p class="text-gray-600 mt-1">Lisinopril 10mg 1x/jour</p>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('medecin.consultations.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Retour</a>
                <button onclick="window.print()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    <i class="fas fa-print"></i> Imprimer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection