@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Tableau de bord patient</h1>
                <p>Bienvenue, {{ Auth::user()->name }}.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="bg-teal-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Prochain rendez-vous</h3>
                        <p class="text-lg">{{ $prochainRdv ? $prochainRdv->date.' à '.$prochainRdv->heure : 'Aucun' }}</p>
                    </div>
                    <div class="bg-orange-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">Nombre de consultations</h3>
                        <p class="text-3xl font-bold">{{ $nombreConsultations ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Vos rendez-vous à venir</h2>
                    <ul class="list-disc pl-5 mt-2">
                        @forelse($rendezVousAVenir as $rdv)
                            <li>{{ $rdv->date }} à {{ $rdv->heure }} - {{ $rdv->medecin->user->name ?? 'Médecin' }}</li>
                        @empty
                            <li>Aucun rendez-vous à venir.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection