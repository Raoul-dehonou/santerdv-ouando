@extends('layouts.app')

@section('title', 'Détail Médecin')
@section('header', 'Fiche Médecin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user-md text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-white text-xl font-bold">Dr. Adjanohoun</h2>
                    <p class="text-white/80">Cardiologue</p>
                </div>
            </div>
        </div>
        
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">dr.adjanohoun@ouando.com</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium">+229 97 12 34 56</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Statut</p>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Actif</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date d'ajout</p>
                    <p class="font-medium">15/01/2024</p>
                </div>
            </div>
            
            <div class="pt-4 border-t">
                <h3 class="font-semibold mb-2">Consultations réalisées</h3>
                <p class="text-2xl font-bold text-primary">42</p>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.medecins.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Retour</a>
                <a href="{{ route('admin.medecins.edit', 1) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Modifier</a>
            </div>
        </div>
    </div>
</div>
@endsection