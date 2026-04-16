@extends('layouts.app')

@section('title', 'Prendre un Rendez-vous')
@section('header', 'Nouveau Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="POST">
            @csrf
            
            <div class="space-y-4">
                <!-- Patient -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Patient *</label>
                    <select name="patient_id" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Sélectionner un patient</option>
                        <option value="1">Jean Kouassi</option>
                        <option value="2">Marie Zinsou</option>
                        <option value="3">Amadou Diallo</option>
                    </select>
                </div>
                
                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date *</label>
                    <input type="date" name="date" required min="{{ date('Y-m-d') }}" class="w-full border rounded-lg px-3 py-2">
                </div>
                
                <!-- Heure -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Heure *</label>
                    <select name="heure" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Sélectionner une heure</option>
                        <option value="08:00">08:00</option>
                        <option value="08:30">08:30</option>
                        <option value="09:00">09:00</option>
                        <option value="09:30">09:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                    </select>
                </div>
                
                <!-- Motif -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motif</label>
                    <textarea name="motif" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Raison de la consultation..."></textarea>
                </div>
                
                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="2" class="w-full border rounded-lg px-3 py-2" placeholder="Informations complémentaires..."></textarea>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('medecin.rendez-vous.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection