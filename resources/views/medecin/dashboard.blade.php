@extends('layouts.app')

@section('title', 'Tableau de bord - Médecin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Tableau de bord Médecin</h1>
                <p>Bienvenue, Dr. {{ Auth::user()->name }}.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="bg-purple-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Rendez-vous aujourd'hui</h3>
                        <p class="text-3xl font-bold">{{ $rendezVousAujourdhui ?? 0 }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Prochains rendez-vous</h3>
                        <p class="text-3xl font-bold">{{ $prochainsRdv ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Liste des patients à consulter</h2>
                    <ul class="list-disc pl-5 mt-2">
                        @forelse($patientsDuJour ?? [] as $patient)
                            <li>{{ $patient->user->name }} - {{ $patient->rendezVous->first()->heure ?? '' }}</li>
                        @empty
                            <li>Aucun patient pour aujourd'hui.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection