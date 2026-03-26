@extends('layouts.app')

@section('title', 'Tableau de bord - Administration')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Tableau de bord Administrateur</h1>
                <p>Bienvenue sur l'espace administration du Centre de santé de Ouando.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-blue-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Médecins</h3>
                        <p class="text-3xl font-bold">{{ $medecinsCount ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Patients</h3>
                        <p class="text-3xl font-bold">{{ $patientsCount ?? 0 }}</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Rendez-vous aujourd'hui</h3>
                        <p class="text-3xl font-bold">{{ $rendezVousAujourdhui ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection