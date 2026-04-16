@extends('layouts.app')

@section('title', 'Mes Ordonnances')
@section('header', 'Mes Ordonnances')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-prescription-bottle text-primary"></i>
                Toutes mes ordonnances
            </h3>
        </div>
        
        <div class="divide-y">
            <div class="p-6 flex justify-between items-center hover:bg-gray-50 transition">
                <div>
                    <p class="font-medium text-gray-800">Ordonnance du 15 Mars 2024</p>
                    <p class="text-sm text-gray-500">Dr. Adjanohoun - Cardiologue</p>
                    <div class="mt-2">
                        <span class="text-sm text-gray-600">Médicaments :</span>
                        <ul class="text-sm text-gray-500 list-disc list-inside">
                            <li>Lisinopril 10mg - 1 comprimé par jour</li>
                        </ul>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="printOrdonnance(1)" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                    <button onclick="downloadOrdonnance(1)" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                        <i class="fas fa-download"></i> PDF
                    </button>
                </div>
            </div>
            
            <div class="p-6 flex justify-between items-center hover:bg-gray-50 transition">
                <div>
                    <p class="font-medium text-gray-800">Ordonnance du 10 Février 2024</p>
                    <p class="text-sm text-gray-500">Dr. Bio - Généraliste</p>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Aucun médicament prescrit</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="printOrdonnance(2)" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                    <button onclick="downloadOrdonnance(2)" class="px-3 py-1 border rounded-lg text-primary hover:bg-gray-50 text-sm">
                        <i class="fas fa-download"></i> PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center">
        <a href="{{ route('patient.dossier.index') }}" class="text-primary hover:underline">
            ← Retour à mon dossier médical
        </a>
    </div>
</div>

<script>
    function printOrdonnance(id) {
        alert('Impression de l\'ordonnance #' + id);
        window.print();
    }
    
    function downloadOrdonnance(id) {
        alert('Téléchargement de l\'ordonnance #' + id);
    }
</script>
@endsection